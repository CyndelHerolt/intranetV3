<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DateRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Date extends BaseEntity
{
    public const TYPE_STAGE = 'type.stage';
    public const TYPE_SOUTENANCE = 'type.soutenance';
    public const TYPE_PROJET = 'type.projet';
    public const TYPE_AUTRE = 'type.autre';
    public const TYPE_COMMISSION = 'type.commission';
    public const TYPE_REUNION = 'type.reunion';
    public const TYPE_RENTREE = 'type.rentree';

    public const QUI_ETUDIANT = 'E';
    public const QUI_PERSONNEL = 'P';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="time", nullable=true)
     */
    private $heureFin;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=150)
     */
    private $lieu;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $allday = false;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1)
     */
    private $qui;

    /**
     * @var Formation
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Formation")
     */
    private $formation;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Semestre", inversedBy="dates")
     */
    private $semestres;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $type;

    public function __construct()
    {
        $this->semestres = new ArrayCollection();
    }

    /**
     * @return array
     */
    public static function getTypeList(): array
    {
        return array(
            self::TYPE_AUTRE,
            self::TYPE_COMMISSION,
            self::TYPE_PROJET,
            self::TYPE_REUNION,
            self::TYPE_SOUTENANCE,
            self::TYPE_STAGE,
            self::TYPE_RENTREE,
        );
    }

    /**
     * @return null|string
     */
    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     *
     * @return Date
     */
    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTexte(): ?string
    {
        return $this->texte;
    }

    /**
     * @param string $texte
     *
     * @return Date
     */
    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    /**
     * @param \DateTime $dateDebut
     */
    public function setDateDebut(\DateTime $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return \DateTime
     */
    public function getHeureDebut(): ?\DateTime
    {
        return $this->heureDebut;
    }

    /**
     * @param \DateTime $heureDebut
     */
    public function setHeureDebut(\DateTime $heureDebut): void
    {
        $this->heureDebut = $heureDebut;
    }

    /**
     * @return \DateTime
     */
    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    /**
     * @param \DateTime $dateFin
     */
    public function setDateFin(\DateTime $dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return \DateTime
     */
    public function getHeureFin(): ?\DateTime
    {
        return $this->heureFin;
    }

    /**
     * @param \DateTime $heureFin
     */
    public function setHeureFin(\DateTime $heureFin): void
    {
        $this->heureFin = $heureFin;
    }

    /**
     * @return string
     */
    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     */
    public function setLieu(string $lieu): void
    {
        $this->lieu = $lieu;
    }

    /**
     * @return bool
     */
    public function isAllday(): bool
    {
        return $this->allday;
    }

    /**
     * @param bool $allday
     */
    public function setAllday(bool $allday): void
    {
        $this->allday = $allday;
    }

    /**
     * @return string
     */
    public function getQui(): ?string
    {
        return $this->qui;
    }

    /**
     * @param string $qui
     */
    public function setQui(string $qui): void
    {
        $this->qui = $qui;
    }

    /**
     * @return Formation
     */
    public function getFormation(): ?Formation
    {
        return $this->formation;
    }

    /**
     * @param Formation $formation
     */
    public function setFormation(Formation $formation): void
    {
        $this->formation = $formation;
    }

    /**
     * @return Collection|Semestre[]
     */
    public function getSemestres(): Collection
    {
        return $this->semestres;
    }

    /**
     * @param Semestre $semestre
     *
     * @return Date
     */
    public function addSemestre(Semestre $semestre): self
    {
        if (!$this->semestres->contains($semestre)) {
            $this->semestres[] = $semestre;
        }

        return $this;
    }

    /**
     * @param Semestre $semestre
     *
     * @return Date
     */
    public function removeSemestre(Semestre $semestre): self
    {
        if ($this->semestres->contains($semestre)) {
            $this->semestres->removeElement($semestre);
        }

        return $this;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Date
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
