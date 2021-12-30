<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Controller/appPersonnel/NoteController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 08/10/2021 06:57
 */

namespace App\Controller\appPersonnel;

use App\Classes\Etudiant\EtudiantNotes;
use App\Classes\Matieres\TypeMatiereManager;
use App\Classes\MyEvaluation;
use App\Classes\MyEvaluations;
use App\Classes\MyExport;
use App\Classes\MyUpload;
use App\Controller\BaseController;
use App\Entity\Constantes;
use App\Entity\Evaluation;
use App\Exception\MatiereNotFoundException;
use App\Exception\SemestreNotFoundException;
use App\Form\EvaluationType;
use App\Repository\EtudiantRepository;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NotesController.
 *
 * @Route("/application/personnel/note")
 *
 * @IsGranted("ROLE_PERMANENT")
 */
class NoteController extends BaseController
{
    /**
     * @Route("/saisie/etape-1/{matiere}", name="application_personnel_note_saisie")
     *
     * @return RedirectResponse|Response
     *
     * @throws Exception
     */
    public function saisie(TypeMatiereManager $typeMatiereManager, Request $request, string $matiere)
    {
        $mat = $typeMatiereManager->getMatiereFromSelect($matiere);

        if (null === $mat) {
            throw new MatiereNotFoundException();
        }
        $this->denyAccessUnlessGranted('CAN_ADD_NOTE', $mat);

        $evaluation = new Evaluation($this->getUser(), $mat);
        $form = $this->createForm(
            EvaluationType::class,
            $evaluation,
            [
                'departement' => $this->dataUserSession->getDepartement(),
                'semestre' => $mat->semestre,
                'matiereDisabled' => false,
                'personnelDisabled' => true,
                'autorise' => true,
                'locale' => $request->getLocale(),
//                'attr' => [
//                    'data-provide' => 'validation',
//                ],
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $evaluation->setAnneeUniversitaire($this->dataUserSession->getAnneeUniversitaire());
            $this->entityManager->persist($evaluation);
            $this->entityManager->flush();
            $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'evaluation.add.success.flash');

            return $this->redirectToRoute(
                'application_personnel_note_saisie_2',
                ['uuid' => $evaluation->getUuidString()]
            );
        }

        return $this->render('appPersonnel/note/saisie.html.twig', [
            'matiere' => $mat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/saisie/etape-2/{uuid}", name="application_personnel_note_saisie_2",
     *                                        requirements={"matiere"="\d+"})
     *
     * @ParamConverter("evaluation", options={"mapping": {"uuid": "uuid"}})
     */
    public function saisieNotes(
        TypeMatiereManager $typeMatiereManager,
        MyEvaluation $myEvaluation,
        Evaluation $evaluation
    ): Response
    {
        $matiere = $typeMatiereManager->getMatiere($evaluation->getIdMatiere(), $evaluation->getTypeMatiere());
        $this->denyAccessUnlessGranted('CAN_ADD_NOTE', $matiere); //todo: vérifier s'il est autorisé dans l'évaluation

        $notes = $myEvaluation->setEvaluation($evaluation)->getNotesTableau();

        return $this->render('appPersonnel/note/saisie_2.html.twig', [
            'evaluation' => $evaluation,
            'matiere' => $matiere,
            'notes' => $notes,
            'autorise' => true,
        ]);
    }

    /**
     * @throws Exception
     *
     * @ParamConverter("evaluation", options={"mapping": {"uuid": "uuid"}})
     *
     * @Route("/sauvegarde/{uuid}",
     *     name="application_personnel_note_ajax_saisie",
     *     methods={"POST|GET"},
     *     options={"expose":true})
     */
    public function enregistreNoteAction(
        EtudiantNotes $etudiantNotes,
        EtudiantRepository $etudiantRepository,
        Request $request,
        Evaluation $evaluation
    ): Response {
        $tnote = $request->request->get('notes')['notes'];

        foreach ($tnote as $iValue) {
            $etudiant = $etudiantRepository->find($iValue['id']);
            if (null !== $etudiant) {
                $etudiantNotes->setEtudiant($etudiant);
                $etudiantNotes->addNote($evaluation, $iValue, $this->getUser());
            }
        }

        return new Response();
    }

    /**
     * @Route("/import/{evaluation}", name="application_personnel_note_import", requirements={"evaluation"="\d+"})
     *
     * @throws Exception
     */
    public function import(
        TypeMatiereManager $typeMatiereManager,
        Request $request,
        MyUpload $myUpload,
        MyEvaluation $myEvaluation,
        Evaluation $evaluation
    ): Response
    {
        //upload
        $fichier = $myUpload->upload($request->files->get('fichier_import'), 'temp/');
        $matiere = $typeMatiereManager->getMatiere($evaluation->getIdMatiere(), $evaluation->getTypeMatiere());
        $this->denyAccessUnlessGranted('CAN_ADD_NOTE', $matiere);

        if (null === $matiere) {
            throw new MatiereNotFoundException();
        }

        //traitement de l'import des notes.
        $myEvaluation->importEvaluation($evaluation, $fichier, $matiere->semestre);
        $this->addFlashBag('success', 'import_note_a_verifier');

        return $this->redirectToRoute('administration_evaluation_show', ['uuid' => $evaluation->getUuidString()]);
    }

    /**
     * @Route("/modele-import/{evaluation}", name="application_personnel_note_import_modele", methods="GET")
     */
    public function modeleImport(
        TypeMatiereManager $typeMatiereManager,
        MyExport $myExport,
        Evaluation $evaluation
    ): ?Response
    {
        $matiere = $typeMatiereManager->getMatiere($evaluation->getIdMatiere(), $evaluation->getTypeMatiere());
        $this->denyAccessUnlessGranted('CAN_ADD_NOTE', $matiere);

        if (null === $matiere) {
            throw new MatiereNotFoundException();
        }

        return $myExport->genereModeleImportNote($matiere->semestre);
    }

    /**
     * @Route("/{matiere}/{index}", name="application_personnel_note_index")
     */
    public function index(
        TypeMatiereManager $typeMatiereManager,
        MyEvaluations $myEvaluations,
        string $matiere,
        int $index = 0
    ): Response {
        $mat = $typeMatiereManager->getMatiereFromSelect($matiere);
        $this->denyAccessUnlessGranted('CAN_ADD_NOTE', $mat);

        if (null === $mat) {
            throw new MatiereNotFoundException();
        }

        if (null === $mat->semestre) {
            throw new SemestreNotFoundException();
        }

        $myEvaluations->setMatiere($mat);
        $myEvaluations->getEvaluationsMatiere($this->dataUserSession->getAnneeUniversitaire());

        return $this->render('appPersonnel/note/index.html.twig', [
            'matiere' => $mat,
            'evaluations' => $myEvaluations,
            'indexEval' => $index,
        ]);
    }
}
