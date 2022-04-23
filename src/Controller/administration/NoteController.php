<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Controller/administration/NoteController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 07/10/2021 12:14
 */

namespace App\Controller\administration;

use App\Classes\Matieres\TypeMatiereManager;
use App\Classes\MyEvaluations;
use App\Classes\Semestre\NotesExport;
use App\Controller\BaseController;
use App\Entity\Note;
use App\Entity\Semestre;
use App\Repository\NoteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NoteController.
 */
#[Route(path: '/administration/note')]
class NoteController extends BaseController
{
    #[Route(path: '/semestre/{semestre}', name: 'administration_notes_semestre_index')]
    public function index(MyEvaluations $myEvaluations, Semestre $semestre): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_NOTE', $semestre);
        $myEvaluations->setSemestre($semestre);

        return $this->render('administration/notes/index.html.twig', [
            'semestre' => $semestre,
            'matieres' => $myEvaluations->getMatieresSemestre(),
            'evaluations' => $myEvaluations->getEvaluationsSemestre($semestre,
                $this->dataUserSession->getAnneeUniversitaire()),
        ]);
    }

    /**
     * @return Response
     */
    #[Route(path: '/all/semestre/{semestre}/export.{_format}', name: 'administration_all_notes_export', requirements: ['_format' => 'csv|xlsx|pdf'], methods: 'GET')]
    public function exportAllNotes(NotesExport $notesExport, Semestre $semestre, $_format): ?Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_NOTE', $semestre);

        return $notesExport->exportXlsToutesLesNotes($semestre, $this->dataUserSession->getAnneeUniversitaire());
    }

    public function analyse(
        TypeMatiereManager $typeMatiereManager,
        NoteRepository $noteRepository,
        Semestre $semestre
    ): Response {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_NOTE', $semestre);

        $matieres = $typeMatiereManager->findBySemestre($semestre);
        $notesAvecAbsence = $noteRepository->findBySemestreNoteAvecAbsence($matieres,
            $this->getDataUserSession()->getAnneeUniversitaire());
        $notesIncoherentes = $noteRepository->findBySemestreErreur($matieres,
            $this->getDataUserSession()->getAnneeUniversitaire());

        return $this->render('administration/notes/analyse.html.twig', [
            'notesAvecAbsence' => $notesAvecAbsence,
            'notesIncoherentes' => $notesIncoherentes,
        ]);
    }

    #[Route(path: '/ajax/{note}/{action}', name: 'administration_note_corrige_ajax', options: ['expose' => true], methods: ['POST'])]
    public function corrigeNote(Note $note, string $action): Response
    {
        // $this->denyAccessUnlessGranted('MINIMAL_ROLE_NOTE', $note->getEtudiant()?->getSemestre());
        switch ($action) {
            case 'absent':
                $note->setAbsenceJustifie(true);
                break;
            case 'zero':
                $note->setNote(0);
                break;
            case 'suppr-absence':
                $note->setAbsenceJustifie(false);
                break;
        }
        $this->entityManager->flush();

        return $this->json($note->getId());
    }
}
