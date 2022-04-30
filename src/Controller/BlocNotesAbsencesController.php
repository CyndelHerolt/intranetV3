<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Controller/BlocNotesAbsencesController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 26/10/2021 10:36
 */

namespace App\Controller;

use App\Classes\Etudiant\EtudiantAbsences;
use App\Classes\Etudiant\EtudiantNotes;
use App\Classes\Matieres\TypeMatiereManager;
use App\Classes\Previsionnel\PrevisionnelManager;
use App\Classes\StatsAbsences;
use Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BlocNotesAbsencesController.
 */
class BlocNotesAbsencesController extends BaseController
{
    public function personnel(PrevisionnelManager $myPrevisionnel): Response
    {
        $previsionnels = [];

        foreach ($this->getDataUserSession()->getSemestresActifs() as $semestre) {
            $previsionnels[$semestre->getId()] = $myPrevisionnel->getPrevisionnelPersonnelSemestre($this->getUser(),
                $semestre, $this->dataUserSession->getAnneePrevisionnel());
        }

        return $this->render('bloc_notes_absences/personnel.html.twig', [
            'previsionnels' => $previsionnels,
        ]);
    }

    /**
     * @throws Exception
     */
    public function etudiantAbsences(
        TypeMatiereManager $typeMatiereManager,
        EtudiantAbsences $etudiantAbsences,
        StatsAbsences $statsAbsences
    ): Response {
        $etudiantAbsences->setEtudiant($this->getUser());
        $matieres = $typeMatiereManager->findBySemestreArray($this->getEtudiantSemestre());
        $absences = $etudiantAbsences->getAbsencesParSemestresEtAnneeUniversitaire($matieres,
            $this->getAnneeUniversitaire());
        $statistiquesAbsences = $statsAbsences->calculStatistiquesAbsencesEtudiant($absences);

        return $this->render('bloc_notes_absences/etudiant_absences.html.twig', [
            'absences' => $absences,
            'etudiant' => $this->getUser(),
            'statistiquesAbsences' => $statistiquesAbsences,
            'matieres' => $matieres,
        ]);
    }

    public function etudiantNotes(TypeMatiereManager $typeMatiereManager, EtudiantNotes $etudiantNotes): Response
    {
        $matieres = $typeMatiereManager->findBySemestreArray($this->getEtudiantSemestre());
        $etudiantNotes->setEtudiant($this->getUser());
        $notes = $etudiantNotes->getNotesParSemestresEtAnneeUniversitaire($matieres,
            $this->getAnneeUniversitaire());

        return $this->render('bloc_notes_absences/etudiant_notes.html.twig', [
            'notes' => $notes,
            'matieres' => $matieres,
        ]);
    }

    public function mccSemestre(TypeMatiereManager $typeMatiereManager): Response
    {
        return $this->render('bloc_notes_absences/mcc.html.twig', [
            'matieres' => $typeMatiereManager->findBySemestre($this->getEtudiantSemestre()),
            'apc' => $this->getUser()?->getSemestre()?->getDiplome()?->getTypeDiplome()?->getApc(),
        ]);
    }
}
