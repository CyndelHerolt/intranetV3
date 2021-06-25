<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Entity/ApcSaeCompetence.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 05/06/2021 18:41
 */

namespace App\Entity;

use App\Entity\Traits\LifeCycleTrait;
use App\Repository\ApcSaeCompetenceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApcSaeCompetenceRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class ApcSaeCompetence extends BaseEntity
{
    use LifeCycleTrait;

    /**
     * @ORM\ManyToOne(targetEntity=ApcSae::class, inversedBy="apcSaeCompetences")
     */
    private ?ApcSae $sae;

    /**
     * @ORM\ManyToOne(targetEntity=ApcCompetence::class, inversedBy="apcSaeCompetences")
     */
    private ?ApcCompetence $competence;

    /**
     * @ORM\Column(type="float")
     */
    private float $coefficient = 0;

    /**
     * ApcSaeCompetence constructor.
     *
     * @param $sae
     * @param $competence
     */
    public function __construct(ApcSae $sae, ApcCompetence $competence)
    {
        $this->sae = $sae;
        $this->competence = $competence;
    }


    public function getSae(): ?ApcSae
    {
        return $this->sae;
    }

    public function setSae(?ApcSae $sae): self
    {
        $this->sae = $sae;

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

    public function getCoefficient(): ?float
    {
        return $this->coefficient;
    }

    public function setCoefficient(float $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }
}
