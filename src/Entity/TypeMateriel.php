<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Entity/TypeMateriel.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 06/06/2021 09:36
 */

namespace App\Entity;

use App\Entity\Traits\LifeCycleTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeMaterielRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class TypeMateriel extends BaseEntity
{
    use LifeCycleTrait;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private ?string $libelle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Departement", inversedBy="typeMateriels")
     */
    private Departement $departement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Materiel", mappedBy="typeMateriel")
     */
    private Collection $materiels;

    public function __construct(Departement $departement)
    {
        $this->materiels = new ArrayCollection();
        $this->departement = $departement;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * @return Collection|Materiel[]
     */
    public function getMateriels(): Collection
    {
        return $this->materiels;
    }

    public function addMateriel(Materiel $materiel): self
    {
        if (!$this->materiels->contains($materiel)) {
            $this->materiels[] = $materiel;
            $materiel->setTypeMateriel($this);
        }

        return $this;
    }

    public function removeMateriel(Materiel $materiel): self
    {
        if ($this->materiels->contains($materiel)) {
            $this->materiels->removeElement($materiel);
            // set the owning side to null (unless already changed)
            if ($materiel->getTypeMateriel() === $this) {
                $materiel->setTypeMateriel(null);
            }
        }

        return $this;
    }
}
