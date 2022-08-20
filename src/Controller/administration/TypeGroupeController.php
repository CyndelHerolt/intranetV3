<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Controller/administration/TypeGroupeController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 20/08/2022 17:24
 */

namespace App\Controller\administration;

use App\Classes\Groupes\GenereTypeGroupe;
use App\Controller\BaseController;
use App\Entity\Constantes;
use App\Entity\Diplome;
use App\Entity\Semestre;
use App\Entity\TypeGroupe;
use App\Enums\TypeGroupeEnum;
use App\Exception\DiplomeNotFoundException;
use App\Repository\TypeGroupeRepository;
use App\Utils\JsonRequest;
use App\Utils\Tools;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/administration/type-de-groupe')]
class TypeGroupeController extends BaseController
{
    #[Route(path: '/liste/{semestre}', name: 'administration_type_groupe_liste_semestre', options: ['expose' => true], methods: ['GET'])]
    public function listeSemestre(
        TypeGroupeRepository $typeGroupeRepository,
        Semestre $semestre): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $semestre);
        $diplome = $this->getDiplomeFromSemestre($semestre);
        if ($diplome->isApc() === true) {
         //todo: fusionner dès la suppression de semestre et la mise à jour des données.
            $typeGroupes = $typeGroupeRepository->findByDiplomeAndOrdreSemestre($diplome, $semestre->getOrdreLmd());
        } else {
            $typeGroupes = $semestre->getTypeGroupes();
        }

        return $this->render('administration/type_groupe/_listeSemestre.html.twig', [
            'semestre' => $semestre,
            'diplome' => $diplome,
            'typeGroupes' => $typeGroupes,
            'typeGroupeEnum' => TypeGroupeEnum::cases()
        ]);
    }

    /**
     * @throws \App\Exception\DiplomeNotFoundException
     */
    #[Route(path: '/generation-automatique/{semestre}', name: 'administration_type_groupe_semestre_generation_auto', requirements: ['semestre' => '\d+'], methods: ['GET'])]
    public function generationAutomatique(
        GenereTypeGroupe $genereTypeGroupe,
        Semestre $semestre): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $semestre);

        $genereTypeGroupe->generer($semestre, $this->getDiplomeFromSemestre($semestre));

        return $this->redirectToRoute('administration_groupe_index', ['semestre' => $semestre->getId()]);
    }

    #[Route(path: '/new/{semestre}', name: 'administration_type_groupe_new', options: ['expose' => true], methods: ['POST'])]
    public function new(Request $request, Semestre $semestre): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $semestre);
        $typeGroupe = new TypeGroupe($semestre);
        $typeGroupe->setLibelle(JsonRequest::getValueFromRequest($request, 'libelle'));
        $typeGroupe->setType(JsonRequest::getValueFromRequest($request, 'type'));
        $typeGroupe->setDefaut(Tools::convertToBool(JsonRequest::getValueFromRequest($request, 'defaut')));
        $typeGroupe->setMutualise(Tools::convertToBool(JsonRequest::getValueFromRequest($request, 'mutualise')));
        $this->entityManager->persist($typeGroupe);
        $this->entityManager->flush();

        return new JsonResponse(true, Response::HTTP_OK);
    }

    #[Route(path: '/ajax/update/{id}', name: 'administration_type_groupe_ajax_edit', options: ['expose' => true], methods: ['POST'])]
    public function update(Request $request, TypeGroupe $typeGroupe): ?JsonResponse
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $typeGroupe->getSemestre());
        $value = $request->request->get('value');
        $typeGroupe->setLibelle($value);
        $this->entityManager->flush();

        return new JsonResponse(true, Response::HTTP_OK);
    }

    #[Route(path: '/ajax/update-type/{typeGroupe}', name: 'administration_typegroupe_change_type', options: ['expose' => true], methods: ['POST'])]
    public function updateType(Request $request, TypeGroupe $typeGroupe): ?JsonResponse
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $typeGroupe->getSemestre());
        $typeGroupe->setType($request->request->get('type'));
        $this->entityManager->flush();

        return new JsonResponse(true, Response::HTTP_OK);
    }

    #[Route(path: '/update-defaut/{typegroupe}/{semestre}', name: 'administration_type_groupe_defaut', options: ['expose' => true], methods: ['POST'])]
    public function updateDefaut(Request $request, TypeGroupe $typegroupe, Semestre $semestre): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $semestre);
        $etat = Tools::convertToBool(JsonRequest::getValueFromRequest($request, 'defaut'));
        if ($etat === true) {
            foreach ($semestre->getTypeGroupes() as $tg) {
                if ($tg->getId() === $typegroupe->getId()) {
                    $tg->setDefaut(true);
                } else {
                    $tg->setDefaut(false);
                }
            }
        } else {
            $typegroupe->setDefaut(false);
        }
        $this->entityManager->flush();

        return new JsonResponse(true, Response::HTTP_OK);
    }

    #[Route(path: '/update-mutualise/{typegroupe}/{semestre}', name: 'administration_type_groupe_mutualise', options: ['expose' => true], methods: ['POST'])]
    public function updateMutualise(Request $request, TypeGroupe $typegroupe, Semestre $semestre): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $semestre);
        $etat = Tools::convertToBool(JsonRequest::getValueFromRequest($request, 'mutualise'));
        $typegroupe->setMutualise($etat);
        $this->entityManager->flush();

        return new JsonResponse(true, Response::HTTP_OK);
    }

    #[Route(path: '/duplicate/{typegroupe}', name: 'administration_type_groupe_duplicate', options: ['expose' => true], methods: ['GET'])]
    public function duplicate(TypeGroupe $typegroupe): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $typegroupe->getSemestre());
        $newGroupe = clone $typegroupe;
        $newGroupe->setLibelle('Copie_' . $newGroupe->getLibelle());
        $this->entityManager->persist($newGroupe);
        $this->entityManager->flush();
        $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'type_groupe.duplicate.success.flash');

        return new JsonResponse(true, Response::HTTP_OK);
    }

    #[Route(path: '/supprimer/{id}', name: 'administration_type_groupe_delete', methods: ['DELETE'])]
    public function delete(Request $request, TypeGroupe $typeGroupe): Response
    {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $typeGroupe->getSemestre());
        $id = $typeGroupe->getId();
        if ($this->isCsrfTokenValid('delete' . $id, $request->server->get('HTTP_X_CSRF_TOKEN'))) {
            $this->entityManager->remove($typeGroupe);
            $this->entityManager->flush();
            $this->addFlashBag(
                Constantes::FLASHBAG_SUCCESS,
                'type_groupe.delete.success.flash'
            );

            return $this->json($id, Response::HTTP_OK);
        }
        $this->addFlashBag(Constantes::FLASHBAG_ERROR, 'type_groupe.delete.error.flash');

        return $this->json(false, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    private function getDiplomeFromSemestre(Semestre $semestre): Diplome
    {
        if (null === $semestre->getDiplome()) {
            throw new DiplomeNotFoundException();
        }

        return $semestre->getDiplome()->getParent() ?? $semestre->getDiplome();
    }
}
