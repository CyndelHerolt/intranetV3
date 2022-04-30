<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/DTO/Previsionnel.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 25/09/2021 11:12
 */

namespace App\DTO;

use App\Entity\Constantes;
use App\Enums\PlanCoursEnum;

class Previsionnel
{
    public int $id;
    public ?int $personnel_id = null;
    public int $matiere_id;
    public string $type_matiere;
    public float $nbHCm;
    public float $nbHTd;
    public float $nbHTp;
    public int $nbGrCm;
    public int $nbGrTd;
    public int $nbGrTp;
    public int $annee;
    public bool $referent;
    public string $matiere_libelle;
    public ?string $matiere_code = '';
    public ?string $matiere_code_element = '';
    public string $personnel_nom = '';
    public string $personnel_prenom = '';
    public string $personnel_numeroHarpege;
    public string $personnel_mail;
    public float $nbHeuresService;
    public int $semestre_id;
    public ?string $semestre_libelle = '';
    public PlanCoursEnum $etatPlanCours = PlanCoursEnum::COMPLET;
    public int $annee_id;
    public ?string $annee_libelle = '';
    public int $diplome_id;
    public ?string $diplome_libelle = '';
    public ?string $annee_code_etape = '';
    public ?string $annee_libelle_long = '';
    public mixed $objPrevisionnel;

    public function getNbSeanceCm(): string
    {
        return number_format($this->nbHCm / Constantes::DUREE_COURS, 2);
    }

    public function getNbSeanceTd(): string
    {
        return number_format($this->nbHTd / Constantes::DUREE_COURS, 2);
    }

    public function getNbSeanceTp(): string
    {
        return number_format($this->nbHTp / Constantes::DUREE_COURS, 2);
    }

    public function getTotalEqTd(): float
    {
        return $this->getTotalHCm() * Constantes::MAJORATION_CM + $this->getTotalHTd() + $this->getTotalHTp();
    }

    public function getTotalHCm(): float
    {
        return $this->nbHCm * $this->nbGrCm;
    }

    public function getTotalHTd(): float
    {
        return $this->nbHTd * $this->nbGrTd;
    }

    public function getTotalHTp(): float
    {
        return $this->nbHTp * $this->nbGrTp;
    }

    public function getTotalEtudiant(): float
    {
        return $this->nbHCm + $this->nbHTd + $this->nbHTp;
    }

    public function getDisplay(): string
    {
        return $this->matiere_code.' | '.$this->matiere_libelle;
    }

    public function getTypeIdMatiere(): string
    {
        return $this->type_matiere.'_'.$this->matiere_id;
    }

    public function personnelDisplay(): string
    {
        return $this->personnel_nom.' '.$this->personnel_prenom;
    }
}
