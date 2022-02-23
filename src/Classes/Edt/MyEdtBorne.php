<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Classes/Edt/MyEdtBorne.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 25/10/2021 11:54
 */

/*
 * Pull your hearder here, for exemple, Licence header.
 */

namespace App\Classes\Edt;

use App\Classes\Matieres\TypeMatiereManager;
use App\Entity\AnneeUniversitaire;
use App\Entity\Semestre;
use App\Exception\SemestreNotFoundException;
use App\Repository\CalendrierRepository;
use App\Repository\EdtPlanningRepository;
use App\Repository\GroupeRepository;
use App\Repository\SemestreRepository;

class MyEdtBorne
{
    public array $data = [];

    private CalendrierRepository $calendrierRepository;
    private GroupeRepository $groupeRepository;

    private EdtManager $edtManager;
    private SemestreRepository $semestreRepository;
    private EdtPlanningRepository $edtPlanningRepository; //todo: passer par EvenementCollection pour gérer tous les cas??

    /**
     * MyEdtBorne constructor.
     */
    public function __construct(
        CalendrierRepository $calendrierRepository,
        GroupeRepository $groupeRepository,
        EdtManager $edtManager,
        SemestreRepository $semestreRepository,
        EdtPlanningRepository $edtPlanningRepository,
    ) {
        $this->calendrierRepository = $calendrierRepository;
        $this->groupeRepository = $groupeRepository;
        $this->edtManager = $edtManager;
        $this->semestreRepository = $semestreRepository;
        $this->edtPlanningRepository = $edtPlanningRepository;
    }

    public function init(): void
    {
        $this->data['semaine'] = (int) date('W');
        $this->data['njour'] = (int) date('d');
        $this->data['jsem'] = (int) date('N');
    }

    public function getData(): array
    {
        return $this->data;
    }

    /** @deprecated */
    public function calculSemestre(
        Semestre $semestre1,
        Semestre $semestre2,
        AnneeUniversitaire $anneeUniversitaire,
        TypeMatiereManager $typeMatiereManager
    ): void {
        $semaine = $this->calendrierRepository->findOneBy([
            'semaineReelle' => $this->data['semaine'],
            'anneeUniversitaire' => $anneeUniversitaire->getId(),
        ]);

        $this->data['semestre1'] = $semestre1;
        $this->data['semestre2'] = $semestre2;
        if (null !== $semaine) {
            $this->data['p1']['planning'] = $this->edtPlanningRepository->recupereEDTBornes($semaine->getSemaineFormation(),
                $semestre1, $this->data['jsem'], $typeMatiereManager->findBySemestreArray($semestre1));
            $this->data['p2']['planning'] = $this->edtPlanningRepository->recupereEDTBornes($semaine->getSemaineFormation(),
                $semestre2, $this->data['jsem'], $typeMatiereManager->findBySemestreArray($semestre2));

            $this->data['p1']['groupes'] = $this->groupeRepository->findAllGroupes($semestre1);
            $this->data['p2']['groupes'] = $this->groupeRepository->findAllGroupes($semestre2);
            $this->data['jours'] = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
            $this->data['j1'] = $this->data['jours'][$this->data['jsem']].' '.date('d/m/Y',
                    mktime(12, 30, 00, (int) date('n'), (int) $this->data['njour'], (int) date('Y')));
        }
    }

    /**
     * @throws \App\Exception\SemestreNotFoundException
     */
    public function getAffichageBorneJourSemestre(mixed $intSemestre, TypeMatiereManager $typeMatiereManager): array
    {
        $semestre = $this->semestreRepository->find($intSemestre);

        if (null === $semestre) {
            throw new SemestreNotFoundException();
        }

        $semaine = $this->calendrierRepository->findOneBy([
            'semaineReelle' => $this->data['semaine'],
            'anneeUniversitaire' => $semestre->getAnneeUniversitaire()?->getId(),
        ]);

        $this->data['semestre'] = $semestre;
        if (null !== $semaine) {
            $planning = $this->edtManager->recupereEDTBornes($semaine->getSemaineFormation(),
                $semestre, $this->data['jsem'], $typeMatiereManager->findBySemestreArray($semestre));
            $tab = [];
            foreach ($planning->getEvents() as $pl) {
                $tab[$pl->ordreGroupe][$pl->gridStart] = $pl;
            }
            $this->data['planning'] = $tab;
            $this->data['p1']['groupes'] = $this->groupeRepository->findAllGroupes($semestre);
            $this->data['jours'] = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
            $this->data['j1'] = $this->data['jours'][$this->data['jsem']].' '.date('d/m/Y',
                    mktime(12, 30, 00, (int) date('n'), (int) $this->data['njour'], (int) date('Y')));
        }

        return $this->data;
    }
}
