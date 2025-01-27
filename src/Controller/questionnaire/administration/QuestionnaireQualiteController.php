<?php
/*
 * Copyright (c) 2024. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Controller/questionnaire/administration/QuestionnaireQualiteController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 19/11/2024 15:17
 */

namespace App\Controller\questionnaire\administration;

use App\Components\Questionnaire\Exceptions\TypeQuestionNotFoundException;
use App\Components\Questionnaire\QuestionnaireRegistry;
use App\Components\Questionnaire\TypeDestinataire\Etudiant;
use App\Components\Questionnaire\TypeDestinataire\Exterieur;
use App\Components\Questionnaire\TypeDestinataire\Personnel;
use App\Controller\BaseController;
use App\Entity\Constantes;
use App\Entity\QuestChoixEtudiant;
use App\Entity\QuestQuestionnaire;
use App\Exception\SemestreNotFoundException;
use App\Repository\QuestChoixEtudiantRepository;
use App\Repository\QuestChoixExterieurRepository;
use App\Repository\QuestChoixPersonnelRepository;
use App\Repository\QuestChoixRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/{type}/questionnaire/qualite', name: 'adm_questionnaire_qualite_', requirements: ['type' => 'administratif|administration'], defaults: ['type' => 'administratif'])]
class QuestionnaireQualiteController extends BaseController
{
    /**
     * @throws SemestreNotFoundException
     * @throws TypeQuestionNotFoundException
     */
    #[Route('/{id}/detail', name: 'detail', methods: ['GET'])]
    public function detail(
        Request $request,
        QuestionnaireRegistry $questionnaireRegistry,
        QuestQuestionnaire $questionnaireQualite
    ): Response {
        // $this->denyAccessUnlessGranted('MINIMAL_ROLE_ASS', $this->getDepartement());

        if (null === $questionnaireQualite->getTypeDestinataire()) {
            $liste = [];
        } else {
            $dest = $questionnaireRegistry->getTypeDestinataire($questionnaireQualite->getTypeDestinataire());
            $liste = $dest
                ->setQuestionnaire($questionnaireQualite)
                ->getListeDestinataire();
        }

        return $this->render('questionnaire/administration/questionnaire_qualite/detail.html.twig',
            [
                'liste' => $liste,
                'questionnaire' => $questionnaireQualite,
                'type' => $request->get('type'),
                'typeDestinataire' => $dest::LABEL,
            ]);
    }

    #[Route('/{id}/duplicate', name: 'duplicate', methods: ['GET', 'POST'])]
    public function duplicate(
        Request $request,
        QuestQuestionnaire $questionnaire
    ): Response {
        $newQuestionnaireQualite = clone $questionnaire;
        $newQuestionnaireQualite->setLibelle($questionnaire->getLibelle() . ' - copie');
        $tQuestions = [];
        $tEquivalence = [];
        $this->entityManager->persist($newQuestionnaireQualite);
        foreach ($questionnaire->getQuestSections() as $section) {
            $nSection = clone $section;
            $nSection->setQuestionnaire($newQuestionnaireQualite);
            $newQuestionnaireQualite->addQuestSection($nSection);
            $this->entityManager->persist($nSection);

            //duplique les questions
            foreach ($section->getQuestQuestions() as $question) {
                $tQuestions[$question->getId()] = $question;
                $nQuestion = clone $question;
                $nQuestion->setSection($nSection);
                $nSection->addQuestQuestion($nQuestion);
                $this->entityManager->persist($nQuestion);
                $tEquivalence[$question->getId()] = $nQuestion;

                //duplique les choix
                foreach ($question->getQuestReponses() as $reponse) {
                    $nChoix = clone $reponse;
                    $nChoix->setQuestion($nQuestion);
                    $nQuestion->addQuestReponse($nChoix);
                    $this->entityManager->persist($nChoix);
                }
            }
        }

        $this->entityManager->flush();

        // parcourir les questions et mettre à jour les id dans la config avec les nouveaux id des questions
        foreach ($tQuestions as $question) {
            $nQuestion = $tEquivalence[$question->getId()];
            $config = $nQuestion->getParametre();
            if (null !== $config && is_array($config) && array_key_exists('conditions', $config)) {
                foreach ($config['conditions'] as $key => $condition) {

                    if (array_key_exists('declenchement', $condition) && array_key_exists($condition['declenchement'], $tEquivalence)) {
                        $config['conditions'][$key]['declenchement'] = $tEquivalence[$condition['declenchement']]->getId();
                    }
                }
                $nQuestion->setParametre($config);
            }
        }
        $this->entityManager->flush();
        $this->addFlash(Constantes::FLASHBAG_SUCCESS, 'questionnaire.duplicate.success.flashbag');

        return $this->redirectToRoute('adm_questionnaire_creation_index',
            ['questionnaire' => $newQuestionnaireQualite->getId(), 'type' => $request->get('type')]
        );
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(
        QuestChoixEtudiantRepository  $questChoixEtudiantRepository,
        QuestChoixPersonnelRepository $questChoixPersonnelRepository,
        QuestChoixExterieurRepository $questChoixExterieurRepository,
        QuestChoixRepository $questChoixRepository,
        Request $request,
        QuestQuestionnaire $questionnaireQualite
    ): Response {
        $id = $questionnaireQualite->getId();

        if ($this->isCsrfTokenValid('delete' . $questionnaireQualite->getId(),
            $request->server->get('HTTP_X_CSRF_TOKEN'))) {
            // suppression des choix et choixUser
            $choix = $questChoixRepository->findByQuestionnaire($questionnaireQualite);
            foreach ($choix as $c) {
                $this->entityManager->remove($c);
            }

            switch ($questionnaireQualite->getTypeDestinataire()) {
                case Etudiant::class:
                    $qst = $questChoixEtudiantRepository->findByQuestionnaire($questionnaireQualite);
                    break;
                case Personnel::class:
                    $qst = $questChoixPersonnelRepository->findByQuestionnaire($questionnaireQualite);
                    break;
                case Exterieur::class:
                    $qst = $questChoixExterieurRepository->findByQuestionnaire($questionnaireQualite);
                    break;
            }

            foreach ($qst as $c) {
                $this->entityManager->remove($c);
            }

            // suppression des sections
            // suppression des questions et réponses
            foreach ($questionnaireQualite->getQuestSections() as $section) {
                foreach ($section->getQuestQuestions() as $question) {
                    foreach ($question->getQuestReponses() as $reponse) {
                        $this->entityManager->remove($reponse);
                    }
                    $this->entityManager->remove($question);
                }
                $this->entityManager->remove($section);
            }

            $this->entityManager->remove($questionnaireQualite);
            $this->entityManager->flush();
            $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'questionnaire.delete.success.flash');

            return $this->json($id, Response::HTTP_OK);
        }

        $this->addFlashBag(Constantes::FLASHBAG_ERROR, 'actualite.delete.error.flash');

        return $this->json(false, Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    #[Route('/supprimer/{questionnaire}', name: 'supprimer')]
    public function supprimeQuestionnaireEtudiant(
        Request            $request,
        QuestChoixEtudiant $questionnaire
    ): Response
    {
        $id = $questionnaire->getId();
        if ($this->isCsrfTokenValid('delete' . $id, $request->server->get('HTTP_X_CSRF_TOKEN'))) {
            // suppression des réponses
            $reponses = $questionnaire->getQuestionnaireEtudiantReponses();
            foreach ($reponses as $reponse) {
                $this->entityManager->remove($reponse);
            }
            $this->entityManager->remove($questionnaire);
            $this->entityManager->flush();
            $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'questionnaire.delete.success.flash');

            return $this->json($id, Response::HTTP_OK);
        }
        $this->addFlashBag(Constantes::FLASHBAG_SUCCESS, 'questionnaire.delete.success.flash');

        return $this->json(false, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
