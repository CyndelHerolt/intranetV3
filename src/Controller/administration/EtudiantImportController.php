<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Controller/administration/EtudiantImportController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 23/10/2021 10:34
 */

namespace App\Controller\administration;

use App\Classes\Etudiant\EtudiantImport;
use App\Classes\MyUpload;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/administration/etudiant/import')]
class EtudiantImportController extends BaseController
{
    //todo: a finaliser ou inutile ?

    /**
     * @throws \Exception
     */
    #[Route('/liste_csv', name: 'administration_etudiant_import_liste_csv')]
    public function listeCsv(
        Request $request,
        MyUpload $myUpload,
        EtudiantImport $etudiantImport
    ): Response {
        $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $this->getDepartement());

        //traitement de l'import
        $fichier = $myUpload->upload($request->files->get('fichierimportcsv'), 'temp');
        $etudiantImport->importFomCsv($fichier);

        return $this->redirectToRoute('administration_etudiant_import_liste_csv'); //page de synthèse ? ou nouvel import ?
    }
}
