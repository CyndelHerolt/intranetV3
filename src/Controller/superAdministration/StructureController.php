<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Controller/superAdministration/StructureController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 07/02/2021 10:36
 */

namespace App\Controller\superAdministration;

use App\Controller\BaseController;
use App\Entity\Departement;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class StructureController.
 */
#[Route(path: '/administratif/structure')]
class StructureController extends BaseController
{
    #[Route(path: '/detail/{departement}', name: 'sa_structure_index')]
    public function index(Departement $departement): Response
    {
        return $this->render('structure/index.html.twig', [
            'departement' => $departement,
        ]);
    }
}
