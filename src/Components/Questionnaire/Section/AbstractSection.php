<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Questionnaire/Section/AbstractSection.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 04/08/2021 08:00
 */

namespace App\Components\Questionnaire\Section;

use App\Components\Questionnaire\DTO\AbstractQuestionnaire;
use App\Components\Questionnaire\QuestionnaireRegistry;
use App\Components\Questionnaire\Questions;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractSection
{
    public const DEFAULT_TEMPLATE = 'components/questionnaire/sections/section.html.twig';
    public const INTRODUCTION = 'introduction';
    public const END = 'end';

    public ?int $arrayKey = 0;
    public ?int $id = null;
    public ?int $questionnaire_section_id = null;
    public string $ordre = '1';
    public ?string $titre;
    public ?string $text_explicatif;

    public int $nbParties = 1;
    public array $params = [];
    public bool $configurable = false;
    public AbstractSectionAdapter $abstractSectionAdapter;

    public QuestionnaireRegistry $questionnaireRegistry;
    public \App\Components\Questionnaire\DTO\Section $section;

    protected Questions $questions;

    public array $options = [];
    public ?int $questionnaire_id = null;
    public ?int $etudiant_id = null;

//    #[Required]
//    public ReponsesEtudiantAdapter $reponsesEtudiantAdapter;

    public function __construct(
        QuestionnaireRegistry $questionnaireRegistry)
    {
        $this->questionnaireRegistry = $questionnaireRegistry;
        $this->questions = new Questions();
    }

//    #[Required]
//    public function setReponsesEtudiantAdater(ReponsesEtudiantAdapter $reponsesEtudiantAdapter): void
//    {
//        $this->reponsesEtudiantAdapter = $reponsesEtudiantAdapter;
//    }

    public function setSection(\App\Components\Questionnaire\DTO\Section $section, array $options = []): void
    {
        $this->setOptions($options);
        $this->questionnaire_id = $options['questionnaire_id'];
        $this->etudiant_id = $options['etudiant_id'];
        $this->ordre = $section->ordre;
        $this->titre = $section->titre;
        $this->text_explicatif = $section->texte_explicatif;
        $this->section = $section;
    }

    public function setOptions(array $options): void
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $this->options = $resolver->resolve($options);
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'template' => self::DEFAULT_TEMPLATE,
            'mode' => AbstractQuestionnaire::MODE_APERCU,
            'questionnaire_id' => null,
            'typeQuestionnaire' => 'qualite',
            'etudiant_id' => null,
        ]);
    }

    public function getTemplate(): string
    {
        return $this->options['template'];
    }

    public function getOption(string $name): string
    {
        return $this->options[$name];
    }

    public function getVars(): array
    {
        return [
            'id' => null,
            'questionnaire_section_id' => null,
            'ordre' => 1,
            'titre' => null,
        ];
    }
}
