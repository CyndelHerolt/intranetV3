<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Questionnaire/TypeQuestionRenderer.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 23/10/2021 10:37
 */

namespace App\Components\Questionnaire;

use App\Components\Questionnaire\TypeQuestion\AbstractQuestion;
use App\Components\Questionnaire\TypeQuestion\TypeChainee;
use Twig\Environment;
use Twig\TemplateWrapper;

class TypeQuestionRenderer
{
    public Environment $twig;
    public ?TemplateWrapper $templateWrapper = null;
    private string $template;

    public function __construct(Environment $twig)
    {
        $this->template = 'components/questionnaire/blocks_type_question.html.twig';
        $this->twig = $twig;
    }

    /**
     * @throws \Throwable
     */
    public function render(AbstractQuestion $question, ?int $ordre = 0): string
    {
        $template = $this->load();

        $params = $question->getOptions();
        $params['block_name'] = $question->getOption('block_name');

        if (TypeChainee::class === $question::class) {
            $params['questionsEnfants'] = $question->questions;
        }

        $params['name'] = 'q'.$question->id;
        $params['id'] = $question->id;
        $params['visible'] = $this->isVisible($question->parametres);
        $params['reponses'] = $question->getReponses();
        $params['help'] = $question->help;
        $params['config'] = $question->config;
        $params['parametres'] = $question->parametres;
        $params['valeurs'] = $question->valeurs;
        $params['libelle'] = $question->libelle;
        $params['numero'] = $question->numero;
        $params['ordre'] = $ordre;
        $params['obligatoire'] = $question->obligatoire;
        $params['typeQuestionnaire'] = $question->getOption('typeQuestionnaire');
        $params['reponseEtudiant'] = $question->reponseEtudiant;

        return $template->renderBlock($params['block_name'], $params);
    }

    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    private function load(): TemplateWrapper
    {
        if (null === $this->templateWrapper) {
            $this->templateWrapper = $this->twig->load($this->template);
        }

        return $this->templateWrapper;
    }

    private function isVisible(array $parametres): bool
    {
        foreach ($parametres as $param) {
            if (array_key_exists('type', $param) && 'condition' === $param['type']) {
                return false;
            }
        }

        return true;
    }
}
