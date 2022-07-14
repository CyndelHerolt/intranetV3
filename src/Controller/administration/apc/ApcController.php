<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Controller/administration/apc/ApcController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 11/07/2022 12:52
 */

namespace App\Controller\administration\apc;

use App\Classes\Apc\ApcStructure;
use App\Controller\BaseController;
use App\Entity\Diplome;
use App\Repository\ApcComptenceRepository;
use App\Repository\PpnRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/apc')]
class ApcController extends BaseController
{
    #[Route(path: '/referentiel/{diplome}', name: 'administration_apc_referentiel_index', options: ['expose' => true], methods: ['GET'])]
    public function referentiel(
        Request $request,
        PpnRepository $ppnRepository,
        ApcComptenceRepository $apcComptenceRepository,
        ApcStructure $apcStructure, Diplome $diplome): Response
    {
        if (null === $request->query->get('ppn')) {
            $ppn = $diplome->getPpns()->first();
        } else {
            $ppn = $ppnRepository->find($request->query->get('ppn'));
        }
        $tParcours = $apcStructure->parcoursNiveaux($diplome);
        $competences = $apcComptenceRepository->findByDiplomeAndPn($diplome, $ppn);

        return $this->render('apc/referentiel.html.twig', [
            'diplome' => $diplome,
            'ppns' => $diplome->getPpns(),
            'competences' => $competences,
            'parcours' => $diplome->getReferentiel()?->getApcParcours(),
            'parcoursNiveaux' => $tParcours,
            'ppn' => $ppn,
        ]);
    }
}
