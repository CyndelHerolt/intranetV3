<?php

namespace App\Controller\api\unifolio;

use App\Controller\BaseController;
use App\Entity\Personnel;
use App\Repository\DepartementRepository;
use App\Repository\PersonnelRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EnseignantController extends BaseController
{
    #[Route(path: '/api/unifolio/enseignant', name: 'api_enseignant_liste')]
    public function listeEnseignant(
        Request               $request,
        PersonnelRepository   $personnelRepository,
        DepartementRepository $departementRepository
    )
    {
        $this->checkAccessApi($request);

        $enseignants = $personnelRepository->findAll();

        $tabEnseignant = [];

        foreach ($enseignants as $enseignant) {

            //Récupérer les départements liés à l'enseignant en utilisant la méthode findDepartementPersonnel()
            $departements = [];
            foreach ($departementRepository->findDepartementPersonnel($enseignant) as $departement) {
                $departements[] = [
                    'id' => $departement->getId(),
                    'libelle' => $departement->getLibelle(),
                ];
            }


            $tabEnseignant[$enseignant->getId()] = [
                'id' => $enseignant->getId(),
                'nom' => $enseignant->getNom(),
                'prenom' => $enseignant->getPrenom(),
                'username' => $enseignant->getUsername(),
                'mail_perso' => $enseignant->getMailPerso(),
                'mail_univ' => $enseignant->getMailUniv(),
                'telephone' => $enseignant->getTel1(),
                'departements' => $departements,
            ];
        }

        return $this->json($tabEnseignant);
    }
}