<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Repository/AbsenceEtatAppelRepository.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 28/07/2022 10:12
 */

namespace App\Repository;

use App\Entity\AbsenceEtatAppel;
use App\Entity\Personnel;
use Carbon\CarbonImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AbsenceEtatAppel|null find($id, $lockMode = null, $lockVersion = null)
 * @method AbsenceEtatAppel|null findOneBy(array $criteria, array $orderBy = null)
 * @method AbsenceEtatAppel[]    findAll()
 * @method AbsenceEtatAppel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @extends ServiceEntityRepository<AbsenceEtatAppel>
 */
class AbsenceEtatAppelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AbsenceEtatAppel::class);
    }

    public function findBySemaineAndUser(
        CarbonImmutable $dateLundi,
        Personnel $personnel
    ): array {
        $dateFin = $dateLundi->copy()->addDays(5);

        return $this->createQueryBuilder('a')
            ->where('a.date BETWEEN :dateLundi AND :dateFin')
            ->andWhere('a.personnel = :personnel')
            ->setParameters([
                'dateLundi' => $dateLundi,
                'dateFin' => $dateFin,
                'personnel' => $personnel,
            ])
            ->getQuery()
            ->getResult();
    }

    public function findBySemaineAndUserArray(
        CarbonImmutable $dateLundi,
        Personnel $personnel
    ): array {
        $data = $this->findBySemaineAndUser($dateLundi, $personnel);
        $t = [];
        foreach ($data as $value) {
            if ($value->getTypeIdEvent() !== null) {
                $t[$value->getTypeIdEvent()] = $value;
            }
        }

        return $t;
    }
}
