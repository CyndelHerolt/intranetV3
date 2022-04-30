<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Questionnaire/TypeQuestion/TypeSlider.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 28/10/2021 07:50
 */

namespace App\Components\Questionnaire\TypeQuestion;

use App\Entity\QuestionnaireQuestion;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeSlider extends TypeEchelle
{
    final public const LABEL = 'type_slider';
    final public const BADGE = 'bg-yellow'; // ajouter constante de couleur et de nom de template ?
    final public const ICON = 'fas fa-slider'; // ajouter constante de couleur et de nom de template ?

    public function configureOptions(OptionsResolver $resolver): void
    {
        parent::configureOptions($resolver);
        $resolver
            ->setDefault('block_name', 'type_slider')
            ->setDefault('type_question', 'range');
    }

    public function getOrGenereReponses(QuestionnaireQuestion $question): void
    {
    }
}
