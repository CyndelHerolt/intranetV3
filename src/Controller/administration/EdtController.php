<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Controller/administration/EdtController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 24/08/2022 17:06
 */

namespace App\Controller\administration;

use App\Classes\Edt\MyEdtCelcat;
use App\Classes\Edt\MyEdtIntranet;
use App\Classes\Matieres\TypeMatiereManager;
use App\Controller\BaseController;
use App\Entity\Constantes;
use App\Repository\GroupeRepository;
use App\Repository\PersonnelRepository;
use App\Repository\SalleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class EdtController.
 */
#[Route(path: '/administration/emploi-du-temps')]
class EdtController extends BaseController
{
    #[Route(path: '/{semaine}/{valeur}/{filtre}', name: 'administration_edt_index', requirements: ['semaine' => '\d+'])]
    public function index(int $semaine = 0, string $valeur = '', string $filtre = ''): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_EDT', $this->getDepartement());
        // todo: a priciser ?
        return $this->render('administration/edt/index.html.twig', [
            'semaine' => $semaine,
            'valeur' => $valeur,
            'filtre' => $filtre,
        ]);
    }

    #[Route(path: '/zone/import', name: 'administration_edt_za_importsemaine', options: ['expose' => true])]
    public function zoneImport(): Response
    {
        return $this->render('administration/edt/blocs/import.html.twig');
    }

    #[Route(path: '/ajax-update/{filtre}/{valeur}/{semaine}', name: 'administration_edt_ajax_update', options: ['expose' => true])]
    public function edtIntranet(PersonnelRepository $personnelRepository, TypeMatiereManager $typeMatiereManager, SalleRepository $salleRepository, GroupeRepository $groupeRepository, MyEdtIntranet $myEdt, int $semaine, string $valeur, string $filtre): Response
    {
        $filtre = '' === $filtre ? Constantes::FILTRE_EDT_PROMO : $filtre;
        $matieres = $typeMatiereManager->findByDepartementArray($this->getDepartement());
        // todo: codeApogee si depuis Celcat. Trouverune solution, si Edt récupère depuis touues les tables pour la conversion...
        $edt = $myEdt->initAdministration($this->getDepartement(), $semaine, $filtre,
            $valeur, $this->getAnneeUniversitaire(), $matieres);

        return match ($filtre) {
            Constantes::FILTRE_EDT_PROF => $this->render('administration/edt/_edt-prof.html.twig', [
                'prof' => $personnelRepository->find($valeur),
                'filtre' => $filtre,
                'personnels' => $personnelRepository->findByDepartement($this->getDepartement()),
                'salles' => $salleRepository->findAll(),
                'matieres' => $matieres,
                'edt' => $myEdt,
                'tabHeures' => Constantes::TAB_HEURES_EDT_2,
            ]),
            Constantes::FILTRE_EDT_MODULE => $this->render('administration/edt/_edt-matiere.html.twig', [
                'matiere' => $typeMatiereManager->getMatiereFromSelect($valeur), // todo: manque le type?
                'filtre' => $filtre,
                'personnels' => $personnelRepository->findByDepartement($this->getDepartement()),
                'salles' => $salleRepository->findAll(),
                'matieres' => $typeMatiereManager->findByDepartement($this->getDepartement()),
                'edt' => $edt,
            ]),
            Constantes::FILTRE_EDT_SALLE => $this->render('administration/edt/_edt-salle.html.twig', [
                'salle' => $valeur,
                'filtre' => $filtre,
                'personnels' => $personnelRepository->findByDepartement($this->getDepartement()),
                'salles' => $salleRepository->findAll(),
                'matieres' => $typeMatiereManager->findByDepartement($this->getDepartement()),
                'edt' => $edt,
            ]),
            default => $this->render('administration/edt/_edt-intranet.html.twig', [
                'filtre' => $filtre,
                'personnels' => $personnelRepository->findByDepartement($this->getDepartement()),
                'salles' => $salleRepository->findAll(),
                'matieres' => $typeMatiereManager->findByDepartement($this->getDepartement()),
                'edt' => $edt,
                'groupes' => $groupeRepository->findGroupeSemestreEdt($edt->getSemestre()),
            ]),
        };
    }

    public function edtCelcat(
        PersonnelRepository $personnelRepository,
        TypeMatiereManager $typeMatiereManager,
        SalleRepository $salleRepository,
        MyEdtCelcat $myEdtCelcat
    ): Response {
        return $this->render('administration/edt/_edt-celcat.html.twig', [
            'personnels' => $personnelRepository->findByDepartement($this->dataUserSession->getDepartement()),
            'salles' => $salleRepository->findAll(),
            'matieres' => $typeMatiereManager->findByDepartement($this->dataUserSession->getDepartement()),
            'edt' => $myEdtCelcat->initAdministration(),
        ]);
    }
}
