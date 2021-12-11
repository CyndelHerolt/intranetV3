<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Repository/AbsenceRepository.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 09/10/2021 10:33
 */

namespace App\Repository;

use App\DTO\Matiere;
use App\Entity\Absence;
use App\Entity\AbsenceJustificatif;
use App\Entity\AnneeUniversitaire;
use App\Entity\Etudiant;
use App\Entity\Semestre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function array_key_exists;

/**
 * @method Absence|null find($id, $lockMode = null, $lockVersion = null)
 * @method Absence|null findOneBy(array $criteria, array $orderBy = null)
 * @method Absence[]    findAll()
 * @method Absence[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @extends ServiceEntityRepository<Absence>
 */
class AbsenceRepository extends ServiceEntityRepository
{
    /**
     * AbsenceRepository constructor.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Absence::class);
    }

    public function getByMatiereArray($matiere, AnneeUniversitaire $anneeUniversitaire): array
    {
        $absences = $this->getByMatiere($matiere, $anneeUniversitaire);

        $tab = [];
        /** @var Absence $absence */
        foreach ($absences as $absence) {
            $date = null !== $absence->getDateHeure() ? $absence->getDateHeure()->format('Y-m-d') : '';
            $heure = null !== $absence->getDateHeure() ? $absence->getDateHeure()->format('H:i') : '';

            if (!array_key_exists($date, $tab)) {
                $tab[$date] = [];
            }

            if (!array_key_exists($heure, $tab[$date])) {
                $tab[$date][$heure] = [];
            }

            $tab[$date][$heure][] = null !== $absence->getEtudiant() ? $absence->getEtudiant()->getId() : '';
        }

        return $tab;
    }

    public function getByMatiere(Matiere $matiere, ?AnneeUniversitaire $anneeUniversitaire = null)
    {
        $query = $this->createQueryBuilder('m')
            ->where('m.idMatiere = :matiere')
            ->andWhere('m.typeMatiere = :type')
            ->setParameter('matiere', $matiere->id)
            ->setParameter('type', $matiere->typeMatiere)
            ->orderBy('m.dateHeure', 'DESC');

        if (null !== $anneeUniversitaire) {
            $query->innerJoin(AnneeUniversitaire::class, 'a', 'WITH', 'm.anneeUniversitaire = a.id')
                ->andWhere('a.annee = :annee')
                ->setParameter('annee', $anneeUniversitaire->getAnnee());
        }

        return $query->getQuery()
            ->getResult();
    }

    public function findBySemestreRattrapage(Semestre $semestre, AnneeUniversitaire $anneeCourante): array
    {
        $absences = $this->getBySemestre($semestre, $anneeCourante);
        $trattrapages = [];

        /** @var Absence $absence */
        foreach ($absences as $absence) {
            if (null !== $absence->getEtudiant() &&
                null !== $absence->getDateHeure()) {
                if (array_key_exists($absence->getEtudiant()->getId(), $trattrapages) &&
                    array_key_exists($absence->getDateHeure()->format('Ymd'),
                        $trattrapages[$absence->getEtudiant()->getId()]
                    )) {
                    if (!array_key_exists(
                        $absence->getDateHeure()->format('Hi'),
                        $trattrapages[$absence->getEtudiant()->getId()][$absence->getDateHeure()->format('Ymd')]
                    )) {
                        $trattrapages[$absence->getEtudiant()->getId()][$absence->getDateHeure()->format('Ymd')][$absence->getDateHeure()->format('Hi')] = $absence->isJustifie();
                    }
                } else {
                    $trattrapages[$absence->getEtudiant()->getId()][$absence->getDateHeure()->format('Ymd')][$absence->getDateHeure()->format('Hi')] = $absence->isJustifie();
                }
            }
        }

        return $trattrapages;
    }

    public function getBySemestre(Semestre $semestre, AnneeUniversitaire $anneeCourante)
    {
        return $this->createQueryBuilder('a')
            ->where('a.semestre = :semestre')
            ->andWhere('a.anneeUniversitaire = :annee')
            ->setParameter('semestre', $semestre->getId())
            ->setParameter('annee', $anneeCourante->getId())
            ->orderBy('a.dateHeure', 'DESC')
            ->getQuery()
            ->getResult();
    }

    //todo: utiliser le semestre de Absence ? plutot que matière
    public function getByEtudiantAndSemestre(
        $matieres,
        Etudiant $etudiant,
        AnneeUniversitaire $anneeUniversitaire
    ) {
        $query = $this->createQueryBuilder('a')
            ->innerJoin(AnneeUniversitaire::class, 'e', 'WITH', 'a.anneeUniversitaire = e.id')
            ->where('e.id = :annee')
            ->andWhere('a.etudiant = :etudiant')
            ->setParameter('annee', $anneeUniversitaire->getId())
            ->setParameter('etudiant', $etudiant->getId())
            ->orderBy('a.dateHeure', 'DESC');

        $ors = [];
        foreach ($matieres as $matiere) {
            $ors[] = '(' . $query->expr()->orx('a.idMatiere = ' . $query->expr()->literal($matiere->id)) . ' AND ' . $query->expr()->andX('a.typeMatiere = ' . $query->expr()->literal($matiere->typeMatiere)) . ')';
        }

        return $query->andWhere(implode(' OR ', $ors))
            ->getQuery()
            ->getResult();
    }

    public function getAJustifier(AbsenceJustificatif $justificatif)
    {
        //recherche toutes les absences sur la période du justificatif
        return $this->createQueryBuilder('a')
            ->where('a.dateHeure >= :dateDebut')
            ->andWhere('a.etudiant = :etudiant')
            ->andWhere('a.dateHeure <= :dateFin')
            ->setParameter('dateDebut', $justificatif->getDateHeureDebut())
            ->setParameter('dateFin', $justificatif->getDateHeureFin())
            ->setParameter('etudiant', $justificatif->getEtudiant()->getId())
            ->getQuery()
            ->getResult();
    }

    public function findByMatiere(int $matiere, string $type, ?AnneeUniversitaire $annee = null)
    {
        $query = $this->createQueryBuilder('e')
            ->where('e.idMatiere = :matiere')
            ->andWhere('e.typeMatiere = :type')
            ->setParameter('matiere', $matiere)
            ->setParameter('type', $type)
            ->orderBy('e.dateHeure', 'ASC');

        if (null !== $annee) {
            $query->innerJoin(AnneeUniversitaire::class, 'u', 'WITH', 'e.anneeUniversitaire = u.id')
                ->andWhere('u.annee = :annee')
                ->setParameter('annee', $annee->getAnnee());
        }

        return $query->getQuery()
            ->getResult();
    }
}
