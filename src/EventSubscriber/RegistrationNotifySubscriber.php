<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/EventSubscriber/RegistrationNotifySubscriber.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 09/05/2021 14:41
 */

namespace App\EventSubscriber;

use App\Entity\Absence;
use App\Entity\Etudiant;
use App\Entity\Notification;
use App\Event\AbsenceEvent;
use App\Event\CarnetEvent;
use App\Event\JustificatifEvent;
use App\Event\NoteEvent;
use App\Event\RattrapageEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Envoi un mail de bienvenue à chaque creation d'un utilisateur.
 */
class RegistrationNotifySubscriber implements EventSubscriberInterface
{
    private EntityManagerInterface $entityManager;
    private RouterInterface $router;

    /**
     * RegistrationNotifySubscriber constructor.
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        RouterInterface $router
    ) {
        $this->entityManager = $entityManager;
        $this->router = $router;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            NoteEvent::ADDED => 'onNoteAdded',
            AbsenceEvent::ADDED => 'onAbsenceAdded',
            AbsenceEvent::REMOVED => 'onAbsenceRemoved',
            AbsenceEvent::JUSTIFIED => 'onAbsenceJustified',
            CarnetEvent::ADDED => 'onCarnetAdded',
            RattrapageEvent::DECISION => 'onDecisionRattrapge',
            JustificatifEvent::DECISION => 'onDecisionJustficatif',
        ];
    }

    public function onCarnetAdded(CarnetEvent $event): void
    {
        $cahier = $event->getCahierTexte();

        if (null !== $cahier->getSemestre()) {
            /** @var Etudiant $etudiant */
            foreach ($cahier->getSemestre()->getEtudiants() as $etudiant) {
                $notif = new Notification();
                $notif->setEtudiant($etudiant);
                $notif->setTypeUser(Notification::ETUDIANT);
                $notif->setType(CarnetEvent::ADDED);
                $notif->setUrl($this->router->generate('application_etudiant_carnet_show', ['id' => $cahier->getId()]));
                $this->entityManager->persist($notif);
            }

            $this->entityManager->flush();
        }
    }

    public function onNoteAdded(NoteEvent $event): void
    {
        $note = $event->getNote();
        $notif = new Notification();
        $notif->setEtudiant($note->getEtudiant());
        $notif->setPersonnel(null);
        $notif->setTypeUser(Notification::ETUDIANT);

        $notif->setType(NoteEvent::ADDED);
        $notif->setUrl($this->router->generate('user_mon_profil', ['onglet' => 'note']));
        $this->entityManager->persist($notif);
    }

    public function onAbsenceAdded(AbsenceEvent $event): void
    {
        $this->onAbsence($event->getAbsence(), AbsenceEvent::ADDED);
    }

    public function onDecisionRattrapge(RattrapageEvent $event): void
    {
        $rattrapage = $event->getRattrapage();

        $notif = new Notification();
        $notif->setEtudiant($rattrapage->getEtudiant());
        $notif->setPersonnel(null);
        $notif->setTypeUser(Notification::ETUDIANT);
        if ('A' === $rattrapage->getEtatDemande()) {
            $notif->setType(RattrapageEvent::DECISION_RATTRAPAGE_ACCEPTEE);
        } else {
            $notif->setType(RattrapageEvent::DECISION_RATTRAPAGE_REFUSEE);
        }
        $notif->setUrl($this->router->generate('application_index', ['onglet' => 'rattrapage']));
        $this->entityManager->persist($notif);

        // notification du personnel
        $notif = new Notification();
        $notif->setEtudiant(null);
        $notif->setPersonnel($rattrapage->getPersonnel());
        $notif->setTypeUser(Notification::PERSONNEL);
        if ('A' === $rattrapage->getEtatDemande()) {
            $notif->setType(RattrapageEvent::DECISION_RATTRAPAGE_ACCEPTEE);
        } else {
            $notif->setType(RattrapageEvent::DECISION_RATTRAPAGE_REFUSEE);
        }
        $notif->setUrl($this->router->generate('application_index', ['onglet' => 'rattrapage']));
        $this->entityManager->persist($notif);

        $this->entityManager->flush();
    }

    public function onDecisionJustficatif(JustificatifEvent $event): void
    {
        $absenceJustificatif = $event->getAbsenceJustificatif();

        $notif = new Notification();
        $notif->setEtudiant($absenceJustificatif->getEtudiant());
        $notif->setPersonnel(null);
        $notif->setTypeUser(Notification::ETUDIANT);
        if ('A' === $absenceJustificatif->getEtat()) {
            $notif->setType(JustificatifEvent::DECISION_JUSTIFICATIF_ACCEPTEE);
        } else {
            $notif->setType(JustificatifEvent::DECISION_JUSTIFICATIF_REFUSEE);
        }
        $notif->setUrl($this->router->generate('application_index', ['onglet' => 'justificatif']));
        $this->entityManager->persist($notif);

        $this->entityManager->flush();
    }

    public function onAbsenceRemoved(AbsenceEvent $event): void
    {
        $this->onAbsence($event->getAbsence(), AbsenceEvent::REMOVED);
    }

    public function onAbsenceJustified(AbsenceEvent $event): void
    {
        $this->onAbsence($event->getAbsence(), AbsenceEvent::JUSTIFIED);
    }

    private function onAbsence(Absence $absence, string $etat): void
    {
        $notif = new Notification();
        $notif->setEtudiant($absence->getEtudiant());
        $notif->setPersonnel($absence->getPersonnel());
        $notif->setTypeUser(Notification::ETUDIANT);
        $notif->setType($etat);
        $notif->setUrl($this->router->generate('user_mon_profil', ['onglet' => 'absence']));
        $this->entityManager->persist($notif);
        $this->entityManager->flush();
    }
}
