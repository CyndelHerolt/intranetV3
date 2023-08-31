<?php
/*
 * Copyright (c) 2023. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Classes/EduSign/Adapter/IntranetGroupeEduSignAdapter.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 31/08/2023 15:57
 */

namespace App\Classes\EduSign\Adapter;

use App\Classes\EduSign\DTO\EduSignGroupe;
use App\Entity\Groupe;

class IntranetGroupeEduSignAdapter
{
    private EduSignGroupe $groupe;

    public function __construct(Groupe $groupe)
    {
        $this->groupe = new EduSignGroupe();

    }

    public function getGroupe(): ?EduSignGroupe
    {
        return $this->groupe;
    }
}
