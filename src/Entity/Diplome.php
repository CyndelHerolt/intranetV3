<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Entity/Diplome.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 22/09/2021 12:08
 */

namespace App\Entity;

use App\Entity\Traits\ApogeeTrait;
use App\Entity\Traits\LifeCycleTrait;
use App\Repository\DiplomeRepository;
use Doctrine\DBAL\Types\Types;
use function chr;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use function ord;
use Serializable;

#[ORM\Entity(repositoryClass: DiplomeRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Diplome extends BaseEntity implements Serializable
{
    use ApogeeTrait;
    use LifeCycleTrait;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $libelle = null;

    #[ORM\ManyToOne(targetEntity: Personnel::class)]
    private ?Personnel $responsableDiplome = null;

    #[ORM\ManyToOne(targetEntity: Personnel::class)]
    private ?Personnel $assistantDiplome = null;

    #[ORM\ManyToOne(targetEntity: TypeDiplome::class, inversedBy: 'diplomes')]
    private ?TypeDiplome $typeDiplome = null;

    #[ORM\Column(type: Types::INTEGER)]
    private int $optNbJoursSaisie = 15;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $optDilpomeDecale = false;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $optSupprAbsence = false;

    #[ORM\Column(type: Types::STRING, length: 10)]
    private string $optMethodeCalcul = Constantes::METHODE_CALCUL_MOY_MODULE;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $optAnonymat = false;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $optCommentairesReleve = false;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $optEspacePersoVisible = true;

    #[ORM\Column(type: Types::INTEGER)]
    private int $volumeHoraire = 0;

    #[ORM\Column(type: Types::INTEGER)]
    private int $codeCelcatDepartement = 0;

    /**
     * @var \Doctrine\Common\Collections\Collection<int, \App\Entity\Hrs>
     */
    #[ORM\OneToMany(mappedBy: 'diplome', targetEntity: Hrs::class)]
    private Collection $hrs;

    /**
     * @var \Doctrine\Common\Collections\Collection<int, \App\Entity\Ppn>
     */
    #[ORM\OneToMany(mappedBy: 'diplome', targetEntity: Ppn::class)]
    private Collection $ppns;

    /**
     * @var \Doctrine\Common\Collections\Collection<int, \App\Entity\Annee>
     */
    #[ORM\OneToMany(mappedBy: 'diplome', targetEntity: Annee::class)]
    #[ORM\OrderBy(value: ['libelle' => 'ASC'])]
    private Collection $annees;

    #[ORM\Column(type: Types::STRING, length: 40)]
    private ?string $sigle = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $actif = true;

    #[ORM\ManyToOne(targetEntity: AnneeUniversitaire::class, inversedBy: 'diplomes')]
    private ?AnneeUniversitaire $anneeUniversitaire = null;

    #[ORM\Column(type: Types::INTEGER)]
    private int $optSemainesVisibles = 2;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $optCertifieQualite = false;

    #[ORM\ManyToOne(targetEntity: Personnel::class)]
    private ?Personnel $optResponsableQualite = null;

    /**
     * @var \Doctrine\Common\Collections\Collection<int, \App\Entity\ApcCompetence>
     */
    #[ORM\OneToMany(mappedBy: 'diplome', targetEntity: ApcCompetence::class)]
    private Collection $apcComptences;

    /**
     * @var \Doctrine\Common\Collections\Collection<int, \App\Entity\CovidAttestationPersonnel>
     */
    #[ORM\OneToMany(mappedBy: 'diplome', targetEntity: CovidAttestationPersonnel::class)]
    private Collection $covidAttestationPersonnels;

    /**
     * @var \Doctrine\Common\Collections\Collection<int, \App\Entity\CovidAttestationEtudiant>
     */
    #[ORM\OneToMany(mappedBy: 'diplome', targetEntity: CovidAttestationEtudiant::class)]
    private Collection $covidAttestationEtudiants;

    /**
     * @var \Doctrine\Common\Collections\Collection<int, \App\Entity\ApcParcours>
     */
    #[ORM\OneToMany(mappedBy: 'diplome', targetEntity: ApcParcours::class)]
    private Collection $apcParcours;

    #[ORM\Column(type: Types::BOOLEAN)]
    private ?bool $optUpdateCelcat = false;

    #[ORM\ManyToOne(targetEntity: Departement::class, inversedBy: 'diplomes')]
    private ?Departement $departement;

    public function __construct(Departement $departement)
    {
        $this->departement = $departement;
        $this->hrs = new ArrayCollection();
        $this->ppns = new ArrayCollection();
        $this->annees = new ArrayCollection();
        $this->apcComptences = new ArrayCollection();
        $this->covidAttestationPersonnels = new ArrayCollection();
        $this->covidAttestationEtudiants = new ArrayCollection();
        $this->apcParcours = new ArrayCollection();
    }

    public function getDisplay(): ?string
    {
        if (null !== $this->getTypeDiplome()) {
            return $this->getTypeDiplome()->getSigle().' '.$this->libelle;
        }

        return $this->libelle;
    }

    public function getTypeDiplome(): ?TypeDiplome
    {
        return $this->typeDiplome;
    }

    public function setTypeDiplome(?TypeDiplome $typeDiplome): void
    {
        $this->typeDiplome = $typeDiplome;
    }

    public function getDisplayCourt(): ?string
    {
        if (null !== $this->getTypeDiplome()) {
            return $this->getTypeDiplome()->getSigle().' '.$this->sigle;
        }

        return $this->sigle;
    }

    /**
     * @return Personnel
     */
    public function getResponsableDiplome(): ?Personnel
    {
        return $this->responsableDiplome;
    }

    public function setResponsableDiplome(Personnel $responsableDiplome): void
    {
        $this->responsableDiplome = $responsableDiplome;
    }

    /**
     * @return Personnel
     */
    public function getAssistantDiplome(): ?Personnel
    {
        return $this->assistantDiplome;
    }

    public function setAssistantDiplome(Personnel $assistantDiplome): void
    {
        $this->assistantDiplome = $assistantDiplome;
    }

    public function getOptNbJoursSaisie(): int
    {
        return $this->optNbJoursSaisie;
    }

    public function setOptNbJoursSaisie(int $optNbJoursSaisie): void
    {
        $this->optNbJoursSaisie = $optNbJoursSaisie;
    }

    public function isOptDilpomeDecale(): bool
    {
        return $this->optDilpomeDecale;
    }

    public function getOptDilpomeDecale(): ?bool
    {
        return $this->optDilpomeDecale;
    }

    public function setOptDilpomeDecale(bool $optDilpomeDecale): void
    {
        $this->optDilpomeDecale = $optDilpomeDecale;
    }

    public function getOptMethodeCalcul(): string
    {
        return $this->optMethodeCalcul;
    }

    public function setOptMethodeCalcul(string $optMethodeCalcul): void
    {
        $this->optMethodeCalcul = $optMethodeCalcul;
    }

    public function isOptAnonymat(): bool
    {
        return $this->optAnonymat;
    }

    public function getOptAnonymat(): ?bool
    {
        return $this->optAnonymat;
    }

    public function setOptAnonymat(bool $optAnonymat): void
    {
        $this->optAnonymat = $optAnonymat;
    }

    public function isOptCommentairesReleve(): bool
    {
        return $this->optCommentairesReleve;
    }

    public function getOptCommentairesReleve(): ?bool
    {
        return $this->optCommentairesReleve;
    }

    public function setOptCommentairesReleve(bool $optCommentairesReleve): void
    {
        $this->optCommentairesReleve = $optCommentairesReleve;
    }

    public function isOptEspacePersoVisible(): bool
    {
        return $this->optEspacePersoVisible;
    }

    public function getOptEspacePersoVisible(): ?bool
    {
        return $this->optEspacePersoVisible;
    }

    public function setOptEspacePersoVisible(bool $optEspacePersoVisible): void
    {
        $this->optEspacePersoVisible = $optEspacePersoVisible;
    }

    public function getVolumeHoraire(): int
    {
        return $this->volumeHoraire;
    }

    public function setVolumeHoraire(int $volumeHoraire): void
    {
        $this->volumeHoraire = $volumeHoraire;
    }

    public function getCodeCelcatDepartement(): int
    {
        return $this->codeCelcatDepartement;
    }

    public function setCodeCelcatDepartement(int $codeCelcatDepartement = 0): void
    {
        $this->codeCelcatDepartement = $codeCelcatDepartement;
    }

    /**
     * @return Collection|Hrs[]
     */
    public function getHrs(): Collection
    {
        return $this->hrs;
    }

    public function addHr(Hrs $hr): self
    {
        if (!$this->hrs->contains($hr)) {
            $this->hrs[] = $hr;
            $hr->setDiplome($this);
        }

        return $this;
    }

    public function removeHr(Hrs $hr): self
    {
        if ($this->hrs->contains($hr)) {
            $this->hrs->removeElement($hr);
            // set the owning side to null (unless already changed)
            if ($hr->getDiplome() === $this) {
                $hr->setDiplome(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ppn[]
     */
    public function getPpns(): Collection
    {
        return $this->ppns;
    }

    public function addPpn(Ppn $ppn): self
    {
        if (!$this->ppns->contains($ppn)) {
            $this->ppns[] = $ppn;
            $ppn->setDiplome($this);
        }

        return $this;
    }

    public function removePpn(Ppn $ppn): self
    {
        if ($this->ppns->contains($ppn)) {
            $this->ppns->removeElement($ppn);
            // set the owning side to null (unless already changed)
            if ($ppn->getDiplome() === $this) {
                $ppn->setDiplome(null);
            }
        }

        return $this;
    }

    public function update(string $name, mixed $value): bool
    {
        $name[0] = chr(ord($name[0]) - 32);
        $method = 'set'.$name;
        if (method_exists($this, $method)) {
            $this->$method($value);

            return true;
        }

        return false;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function addAnnee(Annee $annee): self
    {
        if (!$this->annees->contains($annee)) {
            $this->annees[] = $annee;
            $annee->setDiplome($this);
        }

        return $this;
    }

    public function removeAnnee(Annee $annee): self
    {
        if ($this->annees->contains($annee)) {
            $this->annees->removeElement($annee);
            // set the owning side to null (unless already changed)
            if ($annee->getDiplome() === $this) {
                $annee->setDiplome(null);
            }
        }

        return $this;
    }

    public function getSigle(): ?string
    {
        return $this->sigle;
    }

    public function setSigle(string $sigle): self
    {
        $this->sigle = $sigle;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function displayAnneeUniversitaire(): string
    {
        return null !== $this->getAnneeUniversitaire() ? $this->getAnneeUniversitaire()->displayAnneeUniversitaire() : 'err';
    }

    public function getAnneeUniversitaire(): ?AnneeUniversitaire
    {
        return $this->anneeUniversitaire;
    }

    public function setAnneeUniversitaire(?AnneeUniversitaire $anneeUniversitaire): self
    {
        $this->anneeUniversitaire = $anneeUniversitaire;

        return $this;
    }

    public function getOptSemainesVisibles(): ?int
    {
        return $this->optSemainesVisibles;
    }

    public function setOptSemainesVisibles(int $optSemainesVisibles): self
    {
        $this->optSemainesVisibles = $optSemainesVisibles;

        return $this;
    }

    public function getLibelleLong(): string
    {
        if (null !== $this->getTypeDiplome()) {
            return $this->getTypeDiplome()->getSigle().' '.$this->getLibelle();
        }

        return $this->getLibelle();
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }

    public function getSemestres(): array
    {
        $semestres = [];
        foreach ($this->getAnnees() as $annee) {
            foreach ($annee->getSemestres() as $semestre) {
                $semestres[] = $semestre;
            }
        }

        return $semestres;
    }

    /**
     * @return Collection|Annee[]
     */
    public function getAnnees(): Collection
    {
        return $this->annees;
    }

    public function getOptSupprAbsence(): ?bool
    {
        return $this->optSupprAbsence;
    }

    public function isOptSupprAbsence(): bool
    {
        return $this->optSupprAbsence;
    }

    public function setOptSupprAbsence(bool $optSupprAbsence): void
    {
        $this->optSupprAbsence = $optSupprAbsence;
    }

    public function getOptCertifieQualite(): ?bool
    {
        return $this->optCertifieQualite;
    }

    public function setOptCertifieQualite(bool $certifieQualite): self
    {
        $this->optCertifieQualite = $certifieQualite;

        return $this;
    }

    public function getOptResponsableQualite(): ?Personnel
    {
        return $this->optResponsableQualite;
    }

    public function setOptResponsableQualite(?Personnel $responsableQualite): self
    {
        $this->optResponsableQualite = $responsableQualite;

        return $this;
    }

    /**
     * @return Collection|ApcCompetence[]
     */
    public function getApcComptences(): Collection
    {
        return $this->apcComptences;
    }

    public function addApcComptence(ApcCompetence $apcComptence): self
    {
        if (!$this->apcComptences->contains($apcComptence)) {
            $this->apcComptences[] = $apcComptence;
            $apcComptence->setDiplome($this);
        }

        return $this;
    }

    public function removeApcComptence(ApcCompetence $apcComptence): self
    {
        if ($this->apcComptences->contains($apcComptence)) {
            $this->apcComptences->removeElement($apcComptence);
            // set the owning side to null (unless already changed)
            if ($apcComptence->getDiplome() === $this) {
                $apcComptence->setDiplome(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CovidAttestationPersonnel[]
     */
    public function getCovidAttestationPersonnels(): Collection
    {
        return $this->covidAttestationPersonnels;
    }

    public function addCovidAttestationPersonnel(CovidAttestationPersonnel $covidAttestationPersonnel): self
    {
        if (!$this->covidAttestationPersonnels->contains($covidAttestationPersonnel)) {
            $this->covidAttestationPersonnels[] = $covidAttestationPersonnel;
            $covidAttestationPersonnel->setDiplome($this);
        }

        return $this;
    }

    public function removeCovidAttestationPersonnel(CovidAttestationPersonnel $covidAttestationPersonnel): self
    {
        if ($this->covidAttestationPersonnels->contains($covidAttestationPersonnel)) {
            $this->covidAttestationPersonnels->removeElement($covidAttestationPersonnel);
            // set the owning side to null (unless already changed)
            if ($covidAttestationPersonnel->getDiplome() === $this) {
                $covidAttestationPersonnel->setDiplome(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CovidAttestationEtudiant[]
     */
    public function getCovidAttestationEtudiants(): Collection
    {
        return $this->covidAttestationEtudiants;
    }

    public function addCovidAttestationEtudiant(CovidAttestationEtudiant $covidAttestationEtudiant): self
    {
        if (!$this->covidAttestationEtudiants->contains($covidAttestationEtudiant)) {
            $this->covidAttestationEtudiants[] = $covidAttestationEtudiant;
            $covidAttestationEtudiant->setDiplome($this);
        }

        return $this;
    }

    public function removeCovidAttestationEtudiant(CovidAttestationEtudiant $covidAttestationEtudiant): self
    {
        if ($this->covidAttestationEtudiants->contains($covidAttestationEtudiant)) {
            $this->covidAttestationEtudiants->removeElement($covidAttestationEtudiant);
            // set the owning side to null (unless already changed)
            if ($covidAttestationEtudiant->getDiplome() === $this) {
                $covidAttestationEtudiant->setDiplome(null);
            }
        }

        return $this;
    }

    public function serialize(): string
    {
        // Ajouté pour le problème de connexion avec le usernametoken
        return serialize([
            $this->getId(),
            $this->getLibelle(),
        ]);
    }

    public function unserialize($data): ?bool
    {
        return null;
    }

    /**
     * @return Collection|ApcParcours[]
     */
    public function getApcParcours(): Collection
    {
        return $this->apcParcours;
    }

    public function addApcParcour(ApcParcours $apcParcour): self
    {
        if (!$this->apcParcours->contains($apcParcour)) {
            $this->apcParcours[] = $apcParcour;
            $apcParcour->setDiplome($this);
        }

        return $this;
    }

    public function removeApcParcour(ApcParcours $apcParcour): self
    {
        // set the owning side to null (unless already changed)
        if ($this->apcParcours->removeElement($apcParcour) && $apcParcour->getDiplome() === $this) {
            $apcParcour->setDiplome(null);
        }

        return $this;
    }

    public function isOptUpdateCelcat(): ?bool
    {
        return $this->optUpdateCelcat;
    }

    public function setOptUpdateCelcat(bool $optUpdateCelcat): self
    {
        $this->optUpdateCelcat = $optUpdateCelcat;

        return $this;
    }
}
