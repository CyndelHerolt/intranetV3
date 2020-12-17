<?php
// Copyright (c) 2020. | David Annebicque | IUT de Troyes  - All Rights Reserved
// @file /Users/davidannebicque/htdocs/intranetV3/src/Controller/administration/NoteController.php
// @author davidannebicque
// @project intranetV3
// @lastUpdate 17/12/2020 14:06

namespace App\Controller\administration;

use App\Classes\Semestre\NotesExport;
use App\Controller\BaseController;
use App\Entity\Semestre;
use App\Classes\MyEvaluations;
use App\Classes\MyExport;
use App\Repository\NoteRepository;
use PhpOffice\PhpSpreadsheet\Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NoteController
 * @package App\Controller\administration
 * @Route("/administration/note")
 */
class NoteController extends BaseController
{
    /**
     * @Route("/semestre/{semestre}", name="administration_notes_semestre_index")
     * @param MyEvaluations $myEvaluations
     * @param Semestre      $semestre
     *
     * @return Response
     */
    public function index(MyEvaluations $myEvaluations, Semestre $semestre): Response
    {
        $myEvaluations->setSemestre($semestre);

        return $this->render('administration/notes/index.html.twig', [
            'semestre'    => $semestre,
            'matieres'    => $myEvaluations->getMatieresSemestre(),
            'evaluations' => $myEvaluations->getEvaluationsSemestre($semestre,
                $this->dataUserSession->getAnneeUniversitaire()),
        ]);
    }

    /**
     * @Route("/all/semestre/{semestre}/export.{_format}", name="administration_all_notes_export", methods="GET",
     *                             requirements={"_format"="csv|xlsx|pdf"})
     * @param NotesExport    $notesExport
     * @param Semestre       $semestre
     * @param                $_format
     *
     * @return Response
     */
    public function exportAllNotes(
        NotesExport $notesExport,
        Semestre $semestre,
        $_format
    ): ?Response {
        return $notesExport->exportXlsToutesLesNotes($semestre, $this->dataUserSession->getAnneeUniversitaire());
    }


}
