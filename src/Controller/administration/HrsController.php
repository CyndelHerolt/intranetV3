<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Controller/administration/HrsController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 23/10/2021 11:51
 */

namespace App\Controller\administration;

use App\Controller\BaseController;
use App\Entity\Constantes;
use App\Entity\Hrs;
use App\Form\HrsType;
use App\Repository\HrsRepository;
use App\Table\HrsTableType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/administration/service-previsionnel/hrs')]
class HrsController extends BaseController
{
    /**
     * @Route("/{annee}", name="administration_hrs_index", methods="GET|POST", options={"expose":true},
     *                    requirements={"annee":"\d+"})
     */
    public function index(Request $request, ?int $annee = 0): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $this->getDepartement());

        if (0 === $annee && null !== $this->getAnneeUniversitaire() && 0 !== $this->getAnneeUniversitaire()->getAnnee()) {
            $annee = $this->getAnneeUniversitaire()->getAnnee();
        }

        $table = $this->createTable(HrsTableType::class, [
            'departement' => $this->getDepartement(),
            'annee' => $annee,
        ]);

        $hrs = new Hrs($this->getDepartement());
        $form = $this->createForm(HrsType::class, $hrs, [
            'departement' => $this->getDepartement(),
            'attr' => [
                'data-provide' => 'validation',
            ],
        ]);

        $table->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getCallbackResponse();
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($hrs);
            $this->entityManager->flush();
            $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'hrs.add.success.flash');
        }

        return $this->render('administration/hrs/index.html.twig', [
            'annee' => $annee,
            'table' => $table,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="administration_hrs_edit", methods="GET|POST")
     */
    public function edit(Request $request, Hrs $hrs): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $hrs->getDepartement()); //todo: département parfois null??

        $form = $this->createForm(HrsType::class, $hrs, [
            'departement' => $this->getDepartement(),
            'attr' => [
                'data-provide' => 'validation',
            ],
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'hrs.edit.success.flash');

            if (null !== $request->request->get('btn_update')) {
                return $this->redirectToRoute('administration_hrs_index');
            }
        }

        return $this->render('administration/hrs/edit.html.twig', [
            'hrs' => $hrs,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/annee/duplicate", name="administration_hrs_duplicate_annee", methods="POST")
     */
    public function duplicateAnnee(HrsRepository $hrsRepository, Request $request): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $this->getDepartement());
        $anneeDepart = $request->request->get('annee_depart');
        $annee_destination = $request->request->get('annee_destination');
        $annee_concerver = $request->request->get('annee_concerver');

        //on efface, sauf si la case est cochée.
        if ('true' !== $annee_concerver) {
            $hrs = $hrsRepository->findByDepartement($this->getDepartement(), $annee_destination);
            foreach ($hrs as $hr) {
                $this->entityManager->remove($hr);
            }
            $this->entityManager->flush();
        }

        $hrs = $hrsRepository->findByDepartement($this->getDepartement(), $anneeDepart);

        /** @var Hrs $hr */
        foreach ($hrs as $hr) {
            $newHrs = clone $hr;
            $newHrs->setAnnee($annee_destination);
            $this->entityManager->persist($newHrs);
        }
        $this->entityManager->flush();

        $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'hrs.duplicate_annee.success.flash');

        return $this->redirectToRoute('administration_hrs_index', ['annee' => $annee_destination]);
    }

    /**
     * @Route("/{id}/duplicate", name="administration_hrs_duplicate", methods="GET")
     */
    public function duplicate(Hrs $hrs): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $hrs->getDepartement());
        $newHrs = clone $hrs;
        $this->entityManager->persist($newHrs);
        $this->entityManager->flush();
        $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'hrs.duplicate.success.flash');

        //'Copie effectuée avec succès. VOus pouvez modifier le nouvel élément.'
        return $this->redirectToRoute('administration_hrs_edit', ['id' => $newHrs->getId()]);
    }

    /**
     * @Route("/{id}/details", name="administration_hrs_show", methods="GET")
     */
    public function show(Hrs $hrs): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $hrs->getDepartement());

        return $this->render('administration/hrs/_show.html.twig', ['hrs' => $hrs]);
    }

    /**
     * @Route("/{id}", name="administration_hrs_delete", methods="DELETE")
     */
    public function delete(Request $request, Hrs $hrs): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $hrs->getDepartement());
        $id = $hrs->getId();
        if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $this->entityManager->remove($hrs);
            $this->entityManager->flush();
            $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'hrs.delete.success.flash');

            return $this->json($id, Response::HTTP_OK);
        }

        $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'hrs.delete.error.flash');

        return $this->json(false, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @Route("/supprimer/annee", name="administration_hrs_supprimer_annee", methods="DELETE")
     */
    public function supprimer(Request $request, HrsRepository $hrsRepository): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $this->getDepartement());

        if ($this->isCsrfTokenValid('supprimer', $request->request->get('_token'))) {
            $hrs = $hrsRepository->findByDepartement($this->getDepartement(),
                $request->request->get('annee_supprimer'));
            foreach ($hrs as $hr) {
                $this->entityManager->remove($hr);
            }
            $this->entityManager->flush();
            $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'hrs.delete.success.flash');
        }

        $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'hrs.delete.error.flash');

        return $this->redirectToRoute('administration_hrs_index');
    }
}
