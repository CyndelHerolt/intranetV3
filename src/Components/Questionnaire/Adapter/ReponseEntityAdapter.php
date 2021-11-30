<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Components/Questionnaire/Adpapter/ReponseEntityAdapter.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 04/11/2021 13:09
 */

namespace App\Components\Questionnaire\Adapter;

use App\Components\Questionnaire\DTO\Reponse;
use App\Entity\QuestionnaireReponse;

class ReponseEntityAdapter
{
    protected Reponse $reponse;

    public function __construct(QuestionnaireReponse $questionnaireReponse)
    {
        $this->reponse = new Reponse($questionnaireReponse->getId(), $questionnaireReponse->getLibelle(), $questionnaireReponse->getValeur(), $questionnaireReponse->getOrdre(), ['alignement' => $questionnaireReponse->getAlignement()]);
    }

    public function getReponse()
    {
        return $this->reponse;
    }
}
