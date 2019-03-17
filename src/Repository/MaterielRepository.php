<?php

namespace App\Repository;

use App\Entity\Departement;
use App\Entity\Materiel;
use App\Entity\TypeMateriel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Materiel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Materiel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Materiel[]    findAll()
 * @method Materiel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterielRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Materiel::class);
    }

    public function findByDepartement(Departement $departement)
    {
        return $this->createQueryBuilder('m')
            ->innerJoin(TypeMateriel::class, 't', 'WITH', 'm.typeMateriel = t.id')
            ->where('t.departement = :departement')
            ->setParameter('departement', $departement->getId())
            ->getQuery()
            ->getResult();
    }


}
