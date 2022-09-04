<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Adapter/EdtIntranetAdapter.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 04/09/2022 17:41
 */

namespace App\Adapter;

use App\Classes\Edt\EdtManager;
use App\DTO\EvenementEdt;
use App\DTO\EvenementEdtCollection;
use App\Entity\Constantes;
use Carbon\Carbon;

class EdtIntranetAdapter extends AbstractEdtAdapter implements EdtAdapterInterface
{
    public function collection(array $events, array $matieres, array $groupes): EvenementEdtCollection
    {
        $collection = new EvenementEdtCollection();

        foreach ($events as $event) {
            $collection->add($this->single($event, $matieres, $groupes));
        }

        return $collection;
    }

    public function single(mixed $evt, array $matieres = [], array $groupes = []): ?EvenementEdt
    {
        $event = new EvenementEdt();

        if (array_key_exists($evt->getTypeIdMatiere(), $matieres)) {
            $matiere = $matieres[$evt->getTypeIdMatiere()];
            $event->matiere = $matiere->display;
            $event->code_matiere = $matiere->codeMatiere;
            $event->semestre = $matiere->getSemestres()->first();
            $event->couleur = $event->semestre->getAnnee()?->getCouleur();
        } elseif ($evt->getTexte() === null) {
            $event->matiere = 'Inconnue';
            $event->couleur = '#cccccc';
        }
        $event->largeur = $this->getLargeur($evt);
        $event->source = EdtManager::EDT_INTRANET;
        $event->id = $evt->getId();
        $event->date = $evt->getDate();
        $event->jour = (string)$evt->getJour();
        $event->heureDebut = Carbon::createFromTimeString($evt->getDebutTexte());
        $event->heureFin = Carbon::createFromTimeString($evt->getFinTexte());
        $event->typeIdMatiere = $evt->getTypeIdMatiere();
        $event->texte = $evt->getTexte();
        $event->groupeId = $evt->getGroupe();
        $event->salle = $evt->getSalle();
        $event->dateObjet = $evt->getDate();
        $event->gridStart = Constantes::TAB_HEURES_EDT_2[$evt->getDebut() - 1][0];
        $event->gridEnd = Constantes::TAB_HEURES_EDT_2[$evt->getFin() - 1][0];

        if (array_key_exists($evt->getGroupe(), $groupes)) {
            $event->ordreGroupe = $groupes[$evt->getGroupe()]->getOrdre();
            $event->groupeObjet = $groupes[$evt->getGroupe()];
        }

        $event->personnel = null !== $evt->getIntervenant() ? $evt->getIntervenant()->getDisplayPr() : '-';
        $event->personnelObjet = $evt->getIntervenant();
        $event->groupe = $evt->getDisplayGroupe();
        $event->type_cours = $evt->getType();
        $event->duree = $evt->getFin() - $evt->getDebut();

        return $event;
    }

    private function getLargeur(mixed $evt)
    {
        switch ($evt->getType()) {
            case 'cm':
            case 'CM':
                if ($evt->getGroupe() > 40) {
                    return 4;
                }

                return 0;
            case 'TD':
            case 'td':
                if ($evt->getGroupe() > 40) {
                    return 4;
                }

                return 2;
            default:
                return 1;
        }
    }
}
