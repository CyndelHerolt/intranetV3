<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Repository/QuestionnaireEtudiantReponseRepository.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 03/09/2021 19:17
 */

namespace App\Repository;

use App\Entity\QuestionnaireEtudiant;
use App\Entity\QuestionnaireEtudiantReponse;
use App\Entity\QuestionnaireQualite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuestionnaireEtudiantReponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionnaireEtudiantReponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionnaireEtudiantReponse[]    findAll()
 * @method QuestionnaireEtudiantReponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @extends ServiceEntityRepository<QuestionnaireEtudiantReponse>
 */
class QuestionnaireEtudiantReponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionnaireEtudiantReponse::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findExistQuestion(
        string $cle,
        QuestionnaireEtudiant $quizzEtudiant
    ): ?QuestionnaireEtudiantReponse {
        return $this->createQueryBuilder('q')
            ->where('q.cleQuestion = :cle')
            ->andWhere('q.questionnaireEtudiant = :questionnaireEtudiant')
            ->setParameter('cle', $cle)
            ->setParameter('questionnaireEtudiant', $quizzEtudiant)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByQuizzEtudiant(QuestionnaireEtudiant $quizzEtudiant): array
    {
        $reponses = $this->createQueryBuilder('q')
            ->where('q.questionnaireEtudiant = :questionnaireEtudiant')
            ->setParameter('questionnaireEtudiant', $quizzEtudiant->getId())
            ->getQuery()
            ->getResult();

        $t = [];
        /** @var QuestionnaireEtudiantReponse $reponse */
        foreach ($reponses as $reponse) {
            $t[$reponse->getCleQuestion()] = $reponse;
        }

        return $t;
    }

    public function findByQuestionnaire(QuestionnaireQualite $questionnaire): array
    {
        return $this->createQueryBuilder('q')
            ->innerJoin(QuestionnaireEtudiant::class, 'e', 'WITH', 'q.questionnaireEtudiant=e.id')
            ->where('e.questionnaireQualite = :questionnaireQualite')
            ->setParameter('questionnaireQualite', $questionnaire->getId())
            ->orderBy('q.cleQuestion', \Doctrine\Common\Collections\Criteria::ASC)
            ->getQuery()
            ->getResult();
    }
}
