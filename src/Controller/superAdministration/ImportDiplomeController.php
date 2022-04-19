<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Controller/superAdministration/ImportDiplomeController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 13/05/2021 17:05
 */

namespace App\Controller\superAdministration;

use App\Classes\MyUpload;
use App\Classes\Structure\DiplomeImport;
use App\Controller\BaseController;
use App\Entity\Constantes;
use App\Entity\Diplome;
use App\Repository\PpnRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/administratif/diplome-import')]
class ImportDiplomeController extends BaseController
{
    /**
     * @throws \Exception
     */
    #[Route(path: '/{id}', name: 'sa_diplome_import_index')]
    public function index(
        PpnRepository $ppnRepository,
        MyUpload $myUpload, DiplomeImport $diplomeImport, Request $request, Diplome $diplome): Response
    {
        if ($request->isMethod('POST')) {
            $ppn = $ppnRepository->find($request->request->get('ppn'));
            if ($ppn !== null) {
                $fichier = $myUpload->upload($request->files->get('fichier'), 'temp/', ['xml']);
                $diplomeImport->import($diplome, $fichier, $request->request->get('typeFichier'), $ppn);
                unlink($fichier);
                $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'Maquette importée avec succès');
            } else {
                $this->addFlashBag(Constantes::FLASHBAG_ERROR, 'PPN non trouvé');
            }
        }

        return $this->render('super-administration/import_diplome/index.html.twig', [
            'diplome' => $diplome,
        ]);
    }
}
