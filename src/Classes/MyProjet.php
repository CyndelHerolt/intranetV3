<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Classes/MyProjet.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 29/06/2021 17:48
 */

/*
 * Pull your hearder here, for exemple, Licence header.
 */

namespace App\Classes;

use App\Entity\Etudiant;
use App\Entity\ProjetEtudiant;
use App\Entity\ProjetPeriode;
use App\Repository\EtudiantRepository;
use App\Repository\ProjetEtudiantRepository;
use function array_key_exists;
use Doctrine\ORM\EntityManagerInterface;

class MyProjet
{

    protected array$dataEtudiants = [];

    /**
     * MyStage constructor.
     */
    public function __construct(
        private EntityManagerInterface $entityManger,
        private ProjetEtudiantRepository $projetEtudiantRepository,
        private EtudiantRepository $etudiantRepository
    ) {
    }

    public function getDataPeriode(ProjetPeriode $projetPeriode, ?int $anneeUniversitaire = 0): self
    {
        if (0 === $anneeUniversitaire) {
            $anneeUniversitaire = null !== $projetPeriode->getAnneeUniversitaire() ? $projetPeriode->getAnneeUniversitaire()->getAnnee() : (int) date('Y');
        }

        $etudiants = $this->etudiantRepository->findBySemestre($projetPeriode->getSemestre());

        /** @var Etudiant $etudiant */
        foreach ($etudiants as $etudiant) {
            $this->dataEtudiants[$etudiant->getId()]['etudiant'] = $etudiant;
        }

        /** @var ProjetEtudiant $projetEtudiants */
        foreach ($projetPeriode->getProjetEtudiants() as $projetEtudiants) {
            foreach ($projetEtudiants->getEtudiants() as $etudiant) {
                if (array_key_exists($etudiant->getId(), $this->dataEtudiants)) {
                    $this->dataEtudiants[$etudiant->getId()]['projet'] = $projetEtudiants;
                }
            }
        }

        return $this;
    }

    public function getDataEtudiants(): array
    {
        return $this->dataEtudiants;
    }
}
