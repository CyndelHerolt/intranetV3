<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Classes/MyConfiguration.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 09/05/2021 14:41
 */

/*
 * Pull your hearder here, for exemple, Licence header.
 */

namespace App\Classes;

use App\Entity\AnneeUniversitaire;
use App\Entity\Personnel;
use App\Repository\AnneeRepository;
use App\Repository\AnneeUniversitaireRepository;
use App\Repository\DepartementRepository;
use App\Repository\DiplomeRepository;
use App\Repository\PersonnelRepository;
use App\Repository\SemestreRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class MyConfiguration.
 */
class MyConfiguration
{
    /**
     * MyConfiguration constructor.
     */
    public function __construct(private readonly DepartementRepository $departementRepository, private readonly DiplomeRepository $diplomeRepository, private readonly AnneeRepository $anneeRepository, private readonly SemestreRepository $semestreRepository, private readonly PersonnelRepository $personnelRepository, private readonly AnneeUniversitaireRepository $anneeUniversitaireRepository, private readonly EntityManagerInterface $entityManager)
    {
    }

    public function updateOption(string $type, int | string $id, string $name, mixed $value): bool
    {
        return match ($type) {
            'departement' => $this->updateDepartement($id, $name, $value),
            'diplome' => $this->updateDiplome($id, $name, $value),
            'annee' => $this->updateAnnee($id, $name, $value),
            'semestre' => $this->updateSemestre($id, $name, $value),
            default => false,
        };
    }

    private function updateDepartement(int | string $id, string $name, mixed $value): bool
    {
        $departement = $this->departementRepository->find($id);
        if ($departement) {
            $departement->update($name, $this->transformeValue($value));
            $this->entityManager->persist($departement);
            $this->entityManager->flush();

            return true;
        }

        return false;
    }

    private function transformeValue(mixed $value): Personnel | bool | string | AnneeUniversitaire | null
    {
        if ('false' === $value) {
            return false;
        }

        if ('true' === $value) {
            return true;
        }

        if (str_starts_with($value, 'pers')) {
            return $this->personnelRepository->find(mb_substr($value, 4, mb_strlen($value)));
        }

        if (str_starts_with($value, 'anneeuniv')) {
            return $this->anneeUniversitaireRepository->find(mb_substr($value, 9, mb_strlen($value)));
        }

        if (empty($value) && '0' !== $value) {
            return null;
        }

        return $value;
    }

    private function updateDiplome(int | string $id, string $name, mixed $value): bool
    {
        $diplome = $this->diplomeRepository->find($id);
        if ($diplome) {
            $diplome->update($name, $this->transformeValue($value));
            $this->entityManager->flush();

            return true;
        }

        return false;
    }

    private function updateAnnee(int | string $id, string $name, mixed $value): bool
    {
        $annee = $this->anneeRepository->find($id);
        if ($annee) {
            $annee->update($name, $this->transformeValue($value));
            $this->entityManager->flush();

            return true;
        }

        return false;
    }

    private function updateSemestre(int | string $id, string $name, mixed $value): bool
    {
        $semestre = $this->semestreRepository->find($id);
        if ($semestre) {
            $semestre->update($name, $this->transformeValue($value));
            $this->entityManager->flush();

            return true;
        }

        return false;
    }
}
