<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Classes/MyEmprunts.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 07/02/2021 11:20
 */

/*
 * Pull your hearder here, for exemple, Licence header.
 */

namespace App\Classes;

use App\Classes\Pdf\MyPDF;
use App\Entity\Constantes;
use App\Entity\Departement;
use App\Entity\Emprunt;
use App\Entity\EmpruntEtudiant;
use App\Entity\EmpruntMateriel;
use App\Entity\Etudiant;
use App\Entity\Materiel;
use App\Event\EmpruntEvent;
use App\Repository\EmpruntRepository;
use App\Repository\MaterielRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class MyEmprunts
{
    protected EventDispatcherInterface $eventDispatcher;

    protected EmpruntRepository $empruntRepository;

    protected EntityManagerInterface $entityManager;

    /** @var Emprunt[] */
    protected array $emprunts;

    protected Emprunt $emprunt;

    protected array $statistiques;
    private array $jours;
    private MyPDF $myPDF;

    /**
     * MyEmprunts constructor.
     */
    public function __construct(
        EmpruntRepository $empruntRepository,
        MaterielRepository $materielRepository,
        EntityManagerInterface $entityManager,
        EventDispatcherInterface $eventDispatcher,
        MyPDF $myPDF
    ) {
        $this->materielRepository = $materielRepository;
        $this->empruntRepository = $empruntRepository;
        $this->myPDF = $myPDF;
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
        $this->statistiques = [
            Emprunt::DEMANDE => 0,
            Emprunt::ACCEPTE => 0,
            Emprunt::SORTIE  => 0,
            Emprunt::REFUS   => 0,
            Emprunt::REVENU  => 0,
        ];
    }

    public function getJours(): array
    {
        return $this->jours;
    }

    public function listeEmprunts(Departement $departement): void
    {
        $this->emprunts = $this->empruntRepository->findByDepartement($departement);
        $this->calculStatistiques();
    }

    private function calculStatistiques(): void
    {
        foreach ($this->emprunts as $emprunt) {
            ++$this->statistiques[$emprunt->getEtat()];
        }
    }

    /**
     * @return Emprunt[]
     */
    public function getEmprunts(): array
    {
        return $this->emprunts;
    }

    public function getStatistiques(): array
    {
        return $this->statistiques;
    }

    public function changeEtat(Emprunt $emprunt, string $etat): void
    {
        $eventNotif = '';
        $this->emprunt = $emprunt;
        switch ($etat) {
            case Emprunt::DEMANDE:
                $this->emprunt->setEtat(Emprunt::DEMANDE);
                $eventNotif = EmpruntEvent::CHGT_ETAT_EMPRUNT_DEMANDE;
                break;
            case Emprunt::ACCEPTE:
                $this->emprunt->setEtat(Emprunt::ACCEPTE);
                $this->emprunt->setDateValidation(new DateTime('now'));
                $eventNotif = EmpruntEvent::CHGT_ETAT_EMPRUNT_ACCEPTE;
                break;
            case Emprunt::SORTIE:
                $this->emprunt->setEtat(Emprunt::SORTIE);
                $this->emprunt->setDateSortie(new DateTime('now'));
                break;
            case Emprunt::REFUS:
                $this->emprunt->setEtat(Emprunt::REFUS);
                $this->emprunt->setDateValidation(new DateTime('now'));
                $eventNotif = EmpruntEvent::CHGT_ETAT_EMPRUNT_REFUS;
                break;
            case Emprunt::REVENU:
                $this->emprunt->setEtat(Emprunt::REVENU);
                $this->emprunt->setDateRetour(new DateTime('now'));
                break;
        }

        $event = new EmpruntEvent($this->emprunt);

        if ('' !== $eventNotif) {
            $this->eventDispatcher->dispatch($event, $eventNotif);
        }

        $this->entityManager->persist($this->emprunt);
        $this->entityManager->flush();
    }

    public function calculGrille($role = 'ETU'): array
    {
        $this->jours = [];

        if ('ETU' === $role) {
            $nbjouremprunt = 7;
            if ('5' === date('N')) {
                $j = 4;
            } else {
                $j = 2;
            }
        } else {
            $nbjouremprunt = 10;
            $j = -2;
        }

        for ($i = 0; $i < $nbjouremprunt; ++$i) {
            $d = mktime(0, 0, 0, date('m'), date('d') + $j, date('Y'));

            if (6 === date('N', $d)) {
                $d2 = mktime(0, 0, 0, date('m'), date('d') + $j + 1, date('Y'));
                $this->jours[$i]['jour'] = 'WE';
                $this->jours[$i]['texte'] = date('d/m/Y', $d) . '-' . date('d/m/Y', $d2);
                $this->jours[$i]['date'] = date('Y-m-d', $d);
                $this->jours[$i]['objDate'] = $d;
                $this->jours[$i]['i'] = $i;
                ++$j;
            } elseif (7 === date('N', $d)) {
                $d2 = mktime(0, 0, 0, date('m'), date('d') + $j - 1, date('Y'));
                $this->jours[$i]['jour'] = 'WE';
                $this->jours[$i]['texte'] = date('d/m/Y', $d2) . '-' . date('d/m/Y', $d);
                $this->jours[$i]['date'] = date('Y-m-d', $d);
                $this->jours[$i]['objDate'] = $d;
                $this->jours[$i]['i'] = $i;
            } else {
                $this->jours[$i]['jour'] = Constantes::TAB_JOURS[date('N', $d)];
                $this->jours[$i]['texte'] = date('d/m/Y', $d);
                $this->jours[$i]['date'] = date('Y-m-d', $d);
                $this->jours[$i]['objDate'] = $d;
                $this->jours[$i]['i'] = $i;
            }
            ++$j;
        }

        return $this->jours;
    }

    /**
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function genereFiche(Emprunt $emprunt): void
    {
        $nom = null !== $emprunt->getEtudiant() ? $emprunt->getEtudiant()->getNom() : 'etudiant';

        $this->myPDF::generePdf('pdf/ficheEmprunt.html.twig', [
            'emprunt' => $emprunt,
        ],
            'pret-' . $nom,
            null !== $emprunt->getDepartement() ? $emprunt->getDepartement()->getLibelle() : 'departement');
    }

    public function empruntDemande(
        Request $request,
        Etudiant $etudiant
    ) {
        $pret = new EmpruntEtudiant($etudiant);

        $pret->setMotif($request->request->get('listemotif'));
        $pret->setDescription($request->request->get('motif'));
        $pret->setTelephone($request->request->get('telportable'));
        $pret->setDepartement($etudiant->getDepartement());

        $materieljour = $request->request->get('materiels');

        $materiels = $this->materielRepository->findByDepartement($etudiant->getDepartement());
        $tmat = [];
        /** @var Materiel $materiel */
        foreach ($materiels as $materiel) {
            $tmat[$materiel->getId()] = $materiel;
        }
        $matde = [];

        $d1 = null;
        $d2 = null;

        foreach ($materieljour as $m) {
            $t = explode('_', $m); //jour, AM/PM, matériel
            if (\array_key_exists($t[1], $tmat)) {
                //matériel existant, on ajoute
                if (!\array_key_exists($t[1], $matde)) {
                    $matde[$t[1]] = $tmat[$t[1]];
                }

                if (null === $d1) {
                    $d1 = $t[0];
                    $d2 = $t[0];
                } else {
                    $d1 = min($d1, $t[0]);
                    $d2 = max($d2, $t[0]);
                }
            }
        }

        $pret->setDateDebut(Tools::convertDateToObject($d1));
        $pret->setDateFin(Tools::convertDateToObject($d2));

        $this->entityManager->persist($pret);
        $this->entityManager->flush();

        foreach ($matde as $m) {
            $pm = new EmpruntMateriel();
            $pm->setEmprunt($pret);
            $pm->setMateriel($m);
            $pm->setEtat(EmpruntMateriel::ETAT_MATERIEL_RESERVE);

            $this->entityManager->persist($pm);
        }
        $this->entityManager->flush();

        $event = new EmpruntEvent($pret);
        $this->eventDispatcher->dispatch($event, EmpruntEvent::CHGT_ETAT_EMPRUNT_DEMANDE);

        return $pret;
    }

    public function deleteReservation(Emprunt $emprunt): bool
    {
        //Supprimer l'emprunt
        //Supprimer les réservations des métériels associés'
        foreach ($emprunt->getEmpruntMateriels() as $materiel) {
            $this->entityManager->remove($materiel);
        }
        $this->entityManager->remove($emprunt);
        $this->entityManager->flush();

        return true;
    }
}
