<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Controller/administration/StructureController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 08/10/2021 10:52
 */

namespace App\Controller\administration;

use App\Classes\MyStructure;
use App\Controller\BaseController;
use App\Entity\Departement;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class StructureController.
 */
#[Route(path: '/administration/structure')]
class StructureController extends BaseController
{
    #[Route(path: '/', name: 'administration_structure_index')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $this->getDepartement());

        return $this->render('structure/index.html.twig', [
            'departement' => $this->dataUserSession->getDepartement(),
        ]);
    }

    /**
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    #[Route(path: '/{departement}/export.{_format}', name: 'administration_structure_export', requirements: ['_format' => 'xlsx|pdf'], methods: 'GET')]
    public function export(MyStructure $myStructure, Departement $departement, $_format): void
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $departement);
        $myStructure->export($departement, $_format);
    }
}
