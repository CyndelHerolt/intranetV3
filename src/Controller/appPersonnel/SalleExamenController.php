<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Controller/appPersonnel/SalleExamenController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 22/05/2021 21:03
 */

namespace App\Controller\appPersonnel;

use App\Classes\MySalleExamen;
use App\Controller\BaseController;
use App\Entity\Constantes;
use App\Repository\PersonnelRepository;
use App\Repository\SalleExamenRepository;
use App\Repository\SemestreRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class QuizzController.
 *
 * @IsGranted("ROLE_PERMANENT")
 */
#[Route(path: '/application/personnel/salle-examen')]
class SalleExamenController extends BaseController
{
    #[Route(path: '/', name: 'application_personnel_salle_examen_index')]
    public function index(SemestreRepository $semestreRepository, SalleExamenRepository $salleExamenRepository, PersonnelRepository $personnelRepository): Response
    {
        return $this->render('appPersonnel/salle_examen/index.html.twig', [
            'semestres' => $semestreRepository->findByDepartementActif($this->getDepartement()),
            'salles' => $salleExamenRepository->findByDepartement($this->getDepartement()),
            'personnels' => $personnelRepository->findByDepartement($this->getDepartement()),
        ]);
    }

    /**
     * @throws SyntaxError
     * @throws LoaderError
     * @throws RuntimeError
     */
    #[Route(path: '/application/salle-examen/genere/document', name: 'application_personnel_salle_examen_genere_placement', methods: ['POST'])]
    public function generePlacement(MySalleExamen $mySalleExamen, Request $request): Response
    {
        $capacite = $mySalleExamen->calculCapacite($request->request->get('salle'),
            $request->request->get('selectgroupes'), $request->request->get('detail_groupes'));
        if ($capacite) {
            return $mySalleExamen->genereDocument(
                $request->request->get('dateeval'),
                $request->request->get('selectmatiere'),
                $request->request->get('enseignant1'),
                $request->request->get('enseignant2'),
                $this->dataUserSession->getDepartement()
            );
        }
        $this->addFlashBag(Constantes::FLASHBAG_ERROR, 'Salle trop petite');

        return $this->redirectToRoute('application_index', ['onglet' => 'salle_examen']);
    }
}
