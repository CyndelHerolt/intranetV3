<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Repository/GroupeRepository.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 07/09/2022 15:32
 */

namespace App\Repository;

use App\Entity\Annee;
use App\Entity\Departement;
use App\Entity\Diplome;
use App\Entity\Groupe;
use App\Entity\Semestre;
use App\Entity\TypeGroupe;
use App\Enums\TypeGroupeEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Groupe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Groupe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Groupe[]    findAll()
 * @method Groupe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @extends ServiceEntityRepository<Groupe>
 */
class GroupeRepository extends ServiceEntityRepository
{
    /**
     * GroupeRepository constructor.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Groupe::class);
    }

    public function findByDepartementBuilder(Departement $departement): QueryBuilder
    {
        return $this->createQueryBuilder('g')
            ->innerJoin(TypeGroupe::class, 't', 'WITH', 'g.typeGroupe = t.id')
            ->innerJoin(Semestre::class, 's', 'WITH', 't.semestre = s.id')
            ->innerJoin(Annee::class, 'a', 'WITH', 'a.id = s.annee')
            ->innerJoin(Diplome::class, 'd', 'WITH', 'd.id = a.diplome')
            ->where('d.departement = :departement')
            ->setParameter('departement', $departement->getId());
    }

    public function findByDepartement(Departement $departement): array
    {
        return $this->findByDepartementBuilder($departement)
            ->getQuery()
            ->getResult();
    }

    public function findBySemestre(Semestre $semestre): array
    {
        return $this->findBySemestreBuilder($semestre)
            ->getQuery()
            ->getResult();
    }

    public function findBySemestreBuilder(Semestre $semestre): QueryBuilder
    {
        return $this->createQueryBuilder('g')
            ->innerJoin(TypeGroupe::class, 't', 'WITH', 'g.typeGroupe = t.id')
            ->where('t.semestre = :semestre')
            ->setParameter('semestre', $semestre->getId())
            ->orderBy('t.libelle', Criteria::ASC)
            ->addOrderBy('g.libelle', Criteria::ASC);
    }

    public function findAllGroupes(Semestre $semestre): array
    {
        $groupes = [];
        $gtp = $this->getGroupesTP($semestre);

        $i = 1;
        /** @var Groupe $g */
        foreach ($gtp as $g) {
            $groupes[$i] = $g->getLibelle();
            ++$i;
        }

        for ($j = $i; $j <= $semestre->getNbgroupeTpEdt() + 1; ++$j) {
            $groupes[$j] = '';
        }

        return $groupes;
    }

    public function findAllGroupesOrdreSemestre(Semestre $semestre): array
    {
        $groupes = [];
        $gtp = $this->getGroupesTP($semestre);

        $i = 1;
        /** @var Groupe $g */
        foreach ($gtp as $g) {
            $groupes[$i] = $g->getLibelle();
            ++$i;
        }

        for ($j = $i; $j <= $semestre->getNbgroupeTpEdt() + 1; ++$j) {
            $groupes[$j] = '';
        }

        return $groupes;
    }

//    public function getGroupesTPOrdreSemestre(Semestre $semestre): array
//    {
//        // todo: typegroupe ne doit plus contenir de semestre... mais un numéro et un diplome
//        return $this->createQueryBuilder('g')
//            ->innerJoin(TypeGroupe::class, 't', 'WITH', 'g.typeGroupe = t.id')
//            ->where('t.type = :type')
//            ->andWhere('t.ordreSemestre = :semestre')
//            ->andWhere('t.diplome = :diplome')
//            ->setParameters(['type' => 'TP', 'semestre' => $semestre->getOrdreLmd(), 'diplome' => $semestre->getDiplome()->getId()])
//            ->orderBy('g.libelle', Criteria::ASC)
//            ->getQuery()
//            ->getResult();
//    }

//    public function getGroupesTDOrdreSemestre(Semestre $semestre): array
//    {
//        return $this->createQueryBuilder('g')
//            ->innerJoin(TypeGroupe::class, 't', 'WITH', 'g.typeGroupe = t.id')
//            ->where('t.type = :type')
//            ->andWhere('t.ordreSemestre = :semestre')
//            ->andWhere('t.diplome = :diplome')
//            ->setParameters(['type' => 'TD', 'semestre' => $semestre->getOrdreLmd(), 'diplome' => $semestre->getDiplome()->getId()])
//            ->orderBy('g.libelle', Criteria::ASC)
//            ->getQuery()
//            ->getResult();
//    }

    public function getGroupesTP(Semestre $semestre): array
    {
        if (null === $semestre->getDiplome()->getParent()) {
            $diplome = $semestre->getDiplome();
        } else {
            $diplome = $semestre->getDiplome()->getParent();
        }

        return $this->createQueryBuilder('g')
            ->innerJoin(TypeGroupe::class, 't', 'WITH', 'g.typeGroupe = t.id')
            ->where('t.type = :type')
            ->andWhere('t.ordreSemestre = :semestre')
            ->andWhere('t.diplome = :diplome')
            ->setParameters(['type' => TypeGroupeEnum::TYPE_GROUPE_TP, 'semestre' => $semestre->getOrdreLmd(), 'diplome' => $diplome->getId()])
            ->orderBy('g.libelle', Criteria::ASC)
            ->getQuery()
            ->getResult();
    }

    public function getGroupesTD(Semestre $semestre): array
    {
        if (null === $semestre->getDiplome()->getParent()) {
            $diplome = $semestre->getDiplome();
        } else {
            $diplome = $semestre->getDiplome()->getParent();
        }

        return $this->createQueryBuilder('g')
            ->innerJoin(TypeGroupe::class, 't', 'WITH', 'g.typeGroupe = t.id')
            ->where('t.type = :type')
            ->andWhere('t.ordreSemestre = :semestre')
            ->andWhere('t.diplome = :diplome')
            ->setParameters(['type' => TypeGroupeEnum::TYPE_GROUPE_TD, 'semestre' => $semestre->getOrdreLmd(), 'diplome' => $diplome->getId()])
            ->orderBy('g.libelle', Criteria::ASC)
            ->getQuery()
            ->getResult();
    }

    public function findBySemestreArray(Semestre $semestre): array
    {
        $groupes = $this->findByDiplomeAndOrdreSemestre($semestre->getDiplome(), $semestre->getOrdreLmd());
        $t = [];

        /** @var Groupe $groupe */
        foreach ($groupes as $groupe) {
            $t[$groupe->getCodeApogee()] = $groupe;
        }

        return $t;
    }

    public function findGroupeSemestreEdt(Semestre $semestre): array
    {
        $groupes = [];
        $gtp = $this->getGroupesTP($semestre);
        $gtd = $this->getGroupesTD($semestre);

        $i = 1;
        $groupes[0]['id'] = 'CM-1';
        $groupes[0]['display'] = 'CM | CM';

        /** @var Groupe $g */
        foreach ($gtp as $g) {
            $groupes[$i]['id'] = 'TP-'.$g->getOrdre();
            $groupes[$i]['display'] = 'TP'.$g->getLibelle().' | TP '.$g->getLibelle();
            ++$i;
        }

        /** @var Groupe $g */
        foreach ($gtd as $g) {
            $or = $g->getOrdre();
            $groupes[$i]['id'] = 'TD-'.$or;
            $groupes[$i]['display'] = 'TD'.$g->getLibelle().' | TD '.$g->getLibelle();
            ++$i;
        }

        return $groupes;
    }

    public function findByTypeGroupe(?TypeGroupe $typegroupe): array
    {
        return $this->createQueryBuilder('g')
            ->where('g.typeGroupe = :typeGroupe')
            ->orderBy('g.ordre', Criteria::ASC)
            ->setParameter('typeGroupe', $typegroupe)
            ->getQuery()
            ->getResult();
    }

    public function findByDepartementSemestreActifBuilder(Departement $departement): QueryBuilder
    {
        return $this->createQueryBuilder('g')
            ->innerJoin(TypeGroupe::class, 't', 'WITH', 'g.typeGroupe = t.id')
            ->innerJoin(Semestre::class, 's', 'WITH', 't.semestre = s.id')
            ->innerJoin(Annee::class, 'a', 'WITH', 'a.id = s.annee')
            ->innerJoin(Diplome::class, 'd', 'WITH', 'd.id = a.diplome')
            ->where('d.departement = :departement')
            ->andWhere('s.actif = 1')
            ->setParameter('departement', $departement->getId());
    }

    public function findByDepartementSemestreActif(Departement $departement): array
    {
        return $this->findByDepartementSemestreActifBuilder($departement)
            ->getQuery()
            ->getResult();
    }

    public function getEtudiantsByGroupes(TypeGroupe $typegroupe): array
    {
        $query = $this->createQueryBuilder('g')
            ->innerJoin('g.etudiants', 'e')
            ->where('g.typeGroupe = :typegroupe')
            ->setParameter('typegroupe', $typegroupe->getId())
            ->getQuery()
            ->getResult();

        $t = [];
        foreach ($query as $groupe) {
            $t[$groupe->getId()] = $groupe->getEtudiants();
        }

        return $t;
    }

    public function findByDiplomeAndOrdreSemestre(Diplome $diplome, int $ordreSemestre): array
    {
        return $this->findByDiplomeAndOrdreSemestreBuilder($diplome, $ordreSemestre)->getQuery()
            ->getResult();
    }

    public function findByDiplomeAndOrdreSemestreBuilder(Diplome $diplome, int $ordreSemestre): QueryBuilder
    {
        if (null !== $diplome->getParent()) {
            $diplome = $diplome->getParent();
        }

        return $this->createQueryBuilder('g')
            ->innerJoin(TypeGroupe::class, 't', 'WITH', 'g.typeGroupe = t.id')
            ->where('t.diplome = :diplome')
            ->andWhere('t.ordreSemestre = :ordreSemestre')
            ->setParameter('diplome', $diplome->getId())
            ->setParameter('ordreSemestre', $ordreSemestre)
            ->orderBy('t.libelle', Criteria::ASC)
            ->addOrderBy('g.libelle', Criteria::ASC);
    }
}
