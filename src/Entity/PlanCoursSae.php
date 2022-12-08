<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Entity/PlanCoursSae.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 18/11/2022 08:54
 */

namespace App\Entity;

use App\Repository\PlanCoursSaeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanCoursSaeRepository::class)]
class PlanCoursSae extends PlanCours
{


    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $modalitesEvaluations = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $livrables = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $livrablesRendus = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $modaliteEncadrementAutonomie = null;

    #[ORM\Column]
    protected ?float $projetPrevu = null;

    #[ORM\Column]
    protected ?float $projetRealise = null;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getModalitesEvaluations(): ?string
    {
        return $this->modalitesEvaluations;
    }

    public function setModalitesEvaluations(?string $modalitesEvaluations): self
    {
        $this->modalitesEvaluations = $modalitesEvaluations;

        return $this;
    }

    public function getLivrables(): ?string
    {
        return $this->livrables;
    }

    public function setLivrables(?string $livrables): self
    {
        $this->livrables = $livrables;

        return $this;
    }

    public function getLivrablesRendus(): ?string
    {
        return $this->livrablesRendus;
    }

    public function setLivrablesRendus(?string $livrablesRendus): self
    {
        $this->livrablesRendus = $livrablesRendus;

        return $this;
    }

    public function getModaliteEncadrementAutonomie(): ?string
    {
        return $this->modaliteEncadrementAutonomie;
    }

    public function setModaliteEncadrementAutonomie(?string $modaliteEncadrementAutonomie): self
    {
        $this->modaliteEncadrementAutonomie = $modaliteEncadrementAutonomie;

        return $this;
    }

    public function getProjetPrevu(): ?float
    {
        return $this->projetPrevu;
    }

    public function setProjetPrevu(float $projetPrevu): self
    {
        $this->projetPrevu = $projetPrevu;

        return $this;
    }

    public function getProjetRealise(): ?float
    {
        return $this->projetRealise;
    }

    public function setProjetRealise(float $projetRealise): self
    {
        $this->projetRealise = $projetRealise;

        return $this;
    }
}