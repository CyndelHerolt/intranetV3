<?php

namespace App\Controller\api\unifolio;

use App\Controller\BaseController;
use App\Entity\Personnel;
use App\Repository\PersonnelRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EnseignantController extends BaseController
{
    #[Route(path: '/api/unifolio/enseignant/liste', name: 'api_enseignant_liste')]
    public function listeEnseignant(
        Request $request,
        PersonnelRepository $personnelRepository
    )
    {
        //TODO: décommenter ça quand lien avec Unifolio OK
//        $this->checkAccessApi($request);

        $enseignants = $personnelRepository->findAll();

        $tabEnseignant = [];

        foreach ($enseignants as $enseignant) {
            $tabEnseignant[$enseignant->getId()] = [
                'id' => $enseignant->getId(),
                'nom' => $enseignant->getNom(),
                'prenom' => $enseignant->getPrenom(),
                'mail_perso' => $enseignant->getMailPerso(),
                'mail_univ' => $enseignant->getMailUniv(),
            ];
        }

        return $this->json($tabEnseignant);
    }
}