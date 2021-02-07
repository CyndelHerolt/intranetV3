<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Controller/administration/SalleExamenController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 07/02/2021 11:20
 */

namespace App\Controller\administration;

use App\Classes\MyExport;
use App\Controller\BaseController;
use App\Entity\Constantes;
use App\Entity\SalleExamen;
use App\Form\SalleExamenType;
use App\Repository\SalleExamenRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration/salle-examen")
 */
class SalleExamenController extends BaseController
{
    /**
     * @Route("/", name="administration_salle_examen_index", methods="GET")
     */
    public function index(SalleExamenRepository $salleExamenRepository): Response
    {
        return $this->render('administration/salle_examen/index.html.twig',
            ['salle_examens' => $salleExamenRepository->findByDepartement($this->dataUserSession->getDepartement())]);
    }

    /**
     * @Route("/export.{_format}", name="administration_salle_examen_export", methods="GET",
     *                             requirements={"_format"="csv|xlsx|pdf"})
     *
     * @param $_format
     */
    public function export(MyExport $myExport, SalleExamenRepository $salleExamenRepository, $_format): Response
    {
        $salles_examen = $salleExamenRepository->findByDepartement($this->dataUserSession->getDepartement());

        return $myExport->genereFichierGenerique(
            $_format,
            $salles_examen,
            'salles_examens',
            ['salle_examen_administration', 'salle_administration'],
            ['salle' => ['libelle'], 'nbColonnes', 'nbRangs', 'capacite', 'placesInterdites']
        );
    }

    /**
     * @Route("/new", name="administration_salle_examen_new", methods="GET|POST")
     */
    public function create(Request $request): Response
    {
        $salleExaman = new SalleExamen($this->dataUserSession->getDepartement());
        $form = $this->createForm(SalleExamenType::class, $salleExaman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($salleExaman);
            $this->entityManager->flush();
            $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'salle_examen.add.success.flash');

            return $this->redirectToRoute('administration_salle_examen_index');
        }

        return $this->render('administration/salle_examen/new.html.twig', [
            'salle_examan' => $salleExaman,
            'form'         => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="administration_salle_examen_show", methods="GET")
     */
    public function show(SalleExamen $salleExaman): Response
    {
        return $this->render('administration/salle_examen/show.html.twig', ['salle_examan' => $salleExaman]);
    }

    /**
     * @Route("/{id}/edit", name="administration_salle_examen_edit", methods="GET|POST")
     */
    public function edit(Request $request, SalleExamen $salleExaman): Response
    {
        $form = $this->createForm(SalleExamenType::class, $salleExaman);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'salle_examen.edit.success.flash');
            if (null !== $request->request->get('btn_update')) {
                return $this->redirectToRoute('administration_salle_examen_index');
            }

            return $this->redirectToRoute('administration_salle_examen_edit', ['id' => $salleExaman->getId()]);
        }

        return $this->render('administration/salle_examen/edit.html.twig', [
            'salle_examan' => $salleExaman,
            'form'         => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="administration_salle_examen_delete", methods="DELETE")
     */
    public function delete(Request $request, SalleExamen $salleExamen): Response
    {
        $id = $salleExamen->getId();
        if ($this->isCsrfTokenValid('delete' . $id, $request->request->get('_token'))) {
            $this->entityManager->remove($salleExamen);
            $this->entityManager->flush();
            $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'salle_examen.delete.success.flash');

            return $this->json($id, Response::HTTP_OK);
        }
        $this->addFlashBag(Constantes::FLASHBAG_ERROR, 'salle_examen.delete.error.flash');

        return $this->json(false, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @Route("/{id}/duplicate", name="administration_salle_examen_duplicate", methods="GET")
     */
    public function duplicate(SalleExamen $salleExamen): Response
    {
        $newSalleExamen = clone $salleExamen;
        $this->entityManager->persist($newSalleExamen);
        $this->entityManager->flush();
        $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'salle_examen.duplicate.success.flash');

        return $this->redirectToRoute('administration_salle_examen_edit', ['id' => $newSalleExamen->getId()]);
    }
}
