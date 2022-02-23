<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Controller/superAdministration/UeController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 29/06/2021 17:48
 */

namespace App\Controller\superAdministration;

use App\Controller\BaseController;
use App\Entity\Constantes;
use App\Entity\Semestre;
use App\Entity\Ue;
use App\Form\UeType;
use function count;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/administratif/structure/unite-enseignement')]
class UeController extends BaseController
{
    #[Route(path: '/new/{semestre}', name: 'sa_ue_new', methods: 'GET|POST')]
    public function create(Request $request, Semestre $semestre): Response
    {
        if (null !== $semestre->getAnnee()) {
            $ue = new Ue($semestre);
            $form = $this->createForm(UeType::class, $ue, [
                'diplome' => $semestre->getAnnee()->getDiplome(),
                'attr' => [
                    'data-provide' => 'validation',
                ],
            ]);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->entityManager->persist($ue);
                $this->entityManager->flush();
                $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'ue.add.success.flash');

                return $this->redirectToRoute(
                    'sa_structure_index',
                    ['departement' => $ue->getSemestre()->getAnnee()->getDiplome()->getDepartement()->getId()]
                );
            }

            return $this->render('structure/ue/new.html.twig', [
                'ue' => $ue,
                'form' => $form->createView(),
            ]);
        }

        return $this->redirectToRoute('erreur_666');
    }

    #[Route(path: '/{id}', name: 'sa_ue_show', methods: 'GET')]
    public function show(Ue $ue): Response
    {
        return $this->render('structure/ue/show.html.twig', ['ue' => $ue]);
    }

    #[Route(path: '/{id}/edit', name: 'sa_ue_edit', methods: 'GET|POST')]
    public function edit(Request $request, Ue $ue): Response
    {
        if (null !== $ue->getDiplome()) {
            $form = $this->createForm(UeType::class, $ue, [
                'diplome' => $ue->getDiplome(),
                'attr' => [
                    'data-provide' => 'validation',
                ],
            ]);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->entityManager->flush();
                $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'ue.edit.success.flash');

                return $this->redirectToRoute(
                    'sa_structure_index',
                    ['departement' => $ue->getDiplome()->getDepartement()->getId()]
                );
            }

            return $this->render('structure/ue/edit.html.twig', [
                'ue' => $ue,
                'form' => $form->createView(),
            ]);
        }

        return $this->redirectToRoute('erreur_666');
    }

    #[Route(path: '/{id}/duplicate', name: 'sa_ue_duplicate', methods: 'GET|POST')]
    public function duplicate(Ue $ue): Response
    {
        $newUe = clone $ue;
        $newUe->setLibelle($newUe->getLibelle().' copie');
        $this->entityManager->persist($newUe);
        $this->entityManager->flush();

        return $this->redirectToRoute('sa_ue_edit', ['id' => $newUe->getId()]);
    }

    #[Route(path: '/{id}', name: 'sa_ue_delete', methods: 'DELETE')]
    public function delete(Request $request, Ue $ue): Response
    {
        $id = $ue->getId();
        if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            if (0 === count($ue->getMatieres())) {
                $this->entityManager->remove($ue);
                $this->entityManager->flush();
                $this->addFlashBag(
                    Constantes::FLASHBAG_SUCCESS,
                    'ue.delete.success.flash'
                );

                return $this->json($id, Response::HTTP_OK);
            }

            $this->addFlashBag(Constantes::FLASHBAG_ERROR, 'ue.delete.error.non-vide.flash');

            return $this->json(false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->addFlashBag(Constantes::FLASHBAG_ERROR, 'diplome.delete.error.flash');

        return $this->json(false, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    #[Route(path: '/activate/{ue}/{etat}', name: 'sa_ue_activate', methods: ['GET'])]
    public function activate(Ue $ue, bool $etat): RedirectResponse
    {
        $ue->setActif($etat);
        $this->entityManager->flush();
        $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'ue.activate.'.$etat.'.flash');

        return $this->redirectToRoute('super_admin_homepage');
    }
}
