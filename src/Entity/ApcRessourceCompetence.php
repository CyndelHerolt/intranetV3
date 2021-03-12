<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Entity/ApcRessourceCompetence.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 12/03/2021 22:10
 */

namespace App\Entity;

use App\Entity\Traits\LifeCycleTrait;
use App\Repository\ApcRessourceCompetenceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApcRessourceCompetenceRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class ApcRessourceCompetence extends BaseEntity
{
    use LifeCycleTrait;

    /**
     * @ORM\ManyToOne(targetEntity=ApcRessource::class, inversedBy="apcRessourceCompetences")
     */
    private $ressource;

    /**
     * @ORM\ManyToOne(targetEntity=ApcCompetence::class, inversedBy="apcRessourceCompetences")
     */
    private $competence;

    /**
     * ApcRessourceCompetence constructor.
     *
     * @param $ressource
     * @param $competence
     */
    public function __construct($ressource, $competence)
    {
        $this->ressource = $ressource;
        $this->competence = $competence;
    }


    public function getRessource(): ?ApcRessource
    {
        return $this->ressource;
    }

    public function setRessource(?ApcRessource $ressource): self
    {
        $this->ressource = $ressource;

        return $this;
    }

    public function getCompetence(): ?ApcCompetence
    {
        return $this->competence;
    }

    public function setCompetence(?ApcCompetence $competence): self
    {
        $this->competence = $competence;

        return $this;
    }
}
