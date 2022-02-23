<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Controller/SettingsController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 08/10/2021 19:11
 */

namespace App\Controller;

use App\Entity\Personnel;
use App\Repository\AnneeUniversitaireRepository;
use App\Utils\JsonRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/settings', name: 'settings_')]
class SettingsController extends BaseController
{
    /**
     * @throws \JsonException
     */
    #[Route('/change-annee-universitaire', name: 'change_annee_universitaire', options: ['expose' => true], methods: ['POST'])]
    public function changeAnneeUniversitaire(
        AnneeUniversitaireRepository $anneeUniversitaireRepository,
        Request $request
    ): Response {
        $parametersAsArray = JsonRequest::getFromRequest($request);
        if ($this->getUser() instanceof Personnel &&
            array_key_exists('annee_universitaire', $parametersAsArray)) {
            $anneeUniversitaire = $anneeUniversitaireRepository->find($parametersAsArray['annee_universitaire']);
            if (null !== $anneeUniversitaire) {
                $this->getUser()->setAnneeUniversitaire($anneeUniversitaire);
                $this->entityManager->flush();

                return $this->json(true);
            }
        }


        return $this->json(false);
    }

    /**
     * @throws \JsonException
     */
    #[Route('/change-configuration-personnel', name: 'configuration_personnel', options: ['expose' => true], methods: ['POST'])]
    public function changeConfigurationPersonnel(
        Request $request
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_PERMANENT');

        $parametersAsArray = JsonRequest::getFromRequest($request);
        if (array_key_exists('field', $parametersAsArray) && array_key_exists('value', $parametersAsArray)) {
            $configuration = $this->getUser()->getConfiguration();

            $configuration[$parametersAsArray['field']] = $parametersAsArray['value'];
            $this->getUser()->setConfiguration($configuration);
            $this->entityManager->flush();

            return $this->json(true);
        }

        return $this->json(false);
    }
}
