<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Components/Questionnaire/Form/QuestionnaireQuestionTypeQcm.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 26/05/2022 18:23
 */

namespace App\Components\Questionnaire\Form;

use App\Form\QuestionnaireReponseType;
use App\Form\Type\CollectionStimulusType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class QuestionnaireQuestionTypeQcm extends QuestionnaireQuestionType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        $builder
            // ->add('parametre', TextType::class)
            ->add('maxChoix', IntegerType::class, [
                'label' => 'label.maxChoix',
                'help' => 'Indiquez un nombre maximum de réponses acceptées. Laisser 0 si pas de limite.',
            ])
            ->add('quizzReponses', CollectionStimulusType::class, [
                'entry_type' => QuestionnaireReponseType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'prototype' => true,
                'allow_delete' => true,
                'label' => 'Réponses pour la question',
                'by_reference' => false,
                'max_items' => 0,

                // 'help' => 'Ajoutez les situations professionnelles de la compétence.',
            ]);
    }

}
