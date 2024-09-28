<?php
/*
 * Copyright (c) 2024. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Classes/EduSign/UpdateEtudiant.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 19/04/2024 10:44
 */

namespace App\Classes\EduSign;

use App\Classes\EduSign\Adapter\IntranetEtudiantEduSignAdapter;
use App\Classes\EduSign\Api\ApiEtudiant;
use App\Classes\EduSign\DTO\EduSignEtudiant;
use App\Entity\Diplome;
use App\Repository\DiplomeRepository;
use App\Repository\EtudiantRepository;
use App\Repository\SemestreRepository;

class UpdateEtudiant
{
    public function __construct(
        private readonly ApiEtudiant $apiEtudiant,
        protected DiplomeRepository  $diplomeRepository,
        protected SemestreRepository $semestreRepository,
        protected EtudiantRepository $etudiantRepository,
        protected EduSignEtudiant    $edusignEtudiant,
    )
    {
    }

    public function update(?string $keyEduSign): array
    {
        $diplomes = $this->diplomeRepository->findBy(['keyEduSign' => $keyEduSign]);

        foreach ($diplomes as $diplome) {
            $semestres = $diplome->getSemestres();

            foreach ($semestres as $semestre) {
                $etudiants = $this->etudiantRepository->findBySemestre($semestre);

                foreach ($etudiants as $etudiant) {
                    // faire un tableau qui regroupe $etudiant->getSemestre()->getIdEduSign() et les id des groupes
                    $groupes = array_merge(
                        [$etudiant->getSemestre()->getIdEduSign()],
                        array_map(fn($g) => $g->getIdEduSign(), $etudiant->getGroupes()->toArray())
                    );
                    // retirer les entrées vides et réindexer
                    $groupes = array_values(array_filter($groupes));

                    $etudiantEduSign = (new IntranetEtudiantEduSignAdapter($etudiant, $groupes))->getEtudiant();

                    if ($etudiant->getIdEduSign() === null || $etudiant->getIdEduSign() === '') {
                        $response = $this->apiEtudiant->addEtudiant($etudiantEduSign, $keyEduSign);
                    } elseif ($etudiant->getAnneeSortie() !== 0) {
                        $response = $this->apiEtudiant->deleteEtudiant($etudiant->getIdEduSign(), $keyEduSign);
                    } else {
                        $response = $this->apiEtudiant->updateEtudiant($etudiantEduSign, $keyEduSign);
                    }

                    $result[$etudiant->getId()] = $response;
                }
            }
        }

        // retirer les entrées vides et réindexer
        $result = array_values(array_filter($result));
        return $result;
    }

    public function deleteMissingEtudiants(?string $keyEduSign): array
    {
        $diplomes = $this->diplomeRepository->findBy(['keyEduSign' => $keyEduSign]);
        $etudiantOut = $this->etudiantRepository->findEduSignOutdated();
        $result = [];

        foreach ($diplomes as $diplome) {
            $semestres = $this->semestreRepository->findByDiplome($diplome);
            $allEtudiants = $this->apiEtudiant->getAllEtudiants($keyEduSign);

            if ($allEtudiants !== null && isset($allEtudiants['result']) && is_array($allEtudiants['result'])) {
                foreach ($allEtudiants['result'] as $etudiant) {
                    if (!is_array($etudiant)) continue;

                    foreach ($semestres as $semestre) {
                        $etudiantSemestres = $this->etudiantRepository->findBySemestre($semestre);

                        if (!in_array($etudiant, $etudiantSemestres) || in_array($etudiant, $etudiantOut)) {
                            $response = $this->apiEtudiant->deleteEtudiant($etudiant['ID'], $keyEduSign);
                            $result[$etudiant['API_ID']] = $response;

                            if ($response['success']) {
                                $etudiantObject = $this->etudiantRepository->findOneBy(['idEduSign' => $etudiant['ID']]);
                                $etudiantObject->setIdEduSign(null);
                                $this->etudiantRepository->save($etudiantObject);
                            }
                        }
                    }
                }
            }
        }

        // retirer les entrées vides et réindexer
        $result = array_values(array_filter($result));
        return $result;
    }

    public function changeSemestre(?Diplome $diplome, string $keyEduSign): array
    {
        $semestres = $diplome->getSemestres();

        foreach ($semestres as $semestre) {
            $etudiants = $this->etudiantRepository->findBySemestre($semestre);

            foreach ($etudiants as $etudiant) {
                $groupes = array_merge(
                    [$etudiant->getSemestre()->getIdEduSign()],
                    array_map(fn($g) => $g->getIdEduSign(), $etudiant->getGroupes()->toArray())
                );
                $groupes = array_values(array_filter($groupes));

                $etudiantEduSign = (new IntranetEtudiantEduSignAdapter($etudiant, $groupes))->getEtudiant();

                if ($etudiant->getIdEduSign() === null || $etudiant->getIdEduSign() === '') {
                    $result[$etudiant->getId()] = $this->apiEtudiant->addEtudiant($etudiantEduSign, $keyEduSign);
                } else {
                    $result[$etudiant->getId()] = $this->apiEtudiant->updateEtudiant($etudiantEduSign, $keyEduSign);
                }
            }
        }

        // retirer les entrées vides et réindexer
        $result = array_values(array_filter($result));
        return $result;
    }

    public function updateDeleteEtudiantNoGroup(string $keyEduSign): array {
        set_time_limit(1000000);

        $allEtudiantsEdusign = $this->apiEtudiant->getAllEtudiants($keyEduSign);
        if ($allEtudiantsEdusign === null) {
            return [];
        }
        foreach ($allEtudiantsEdusign as $etudiant) {
                $etudiantObject = $this->etudiantRepository->findOneBy(['idEduSign' => $etudiant['ID']]);
                if ($etudiantObject === null) {
                    $etudiantObject = $this->etudiantRepository->findOneBy(['id' => $etudiant['API_ID']]);
                    $etudiantEduSign = (new IntranetEtudiantEduSignAdapter($etudiantObject))->getEtudiant();
                    // changer l'adresse mail de etudiantEduSign
                    $etudiantEduSign->email = $etudiantObject->getId() . '@delete.univ-troyes.fr';
                    $etudiantEduSign->id = $etudiant['ID'];
                    // mettre à jour l'étudiant
                    $this->apiEtudiant->updateEtudiant($etudiantEduSign, $keyEduSign);
                    // supprimer l'étudiant
                    $this->apiEtudiant->deleteEtudiant($etudiant['ID'], $keyEduSign);
                }
        }

        return [];
    }
}

