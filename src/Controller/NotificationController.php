<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Controller/NotificationController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 14/05/2022 10:44
 */

namespace App\Controller;

use App\Entity\Notification;
use App\Repository\NotificationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MessagerieController.
 */
#[Route(path: '/notification')]
class NotificationController extends BaseController
{
    #[Route(path: '/', name: 'notification_index')]
    public function index(NotificationRepository $notificationRepository): Response
    {
        return $this->render('notification/index.html.twig', [
            'notifications' => $notificationRepository->findByUser($this->getUser()),
        ]);
    }

    #[Route(path: '/lire/{uuid}', name: 'notification_lire')]
    #[ParamConverter('notification', options: ['mapping' => ['uuid' => 'uuid']])]
    public function lire(Notification $notification): RedirectResponse
    {
        $notification->setLu(true);
        $this->entityManager->flush();

        return $this->redirect($notification->getUrl());
    }

    #[Route(path: '/marquer', name: 'notification_marquer_lu', options: ['expose' => true])]
    public function marquerCommeLu(NotificationRepository $notificationRepository): Response
    {
        $notifications = $notificationRepository->findNonLuByUser($this->getUser());
        /** @var Notification $notif */
        foreach ($notifications as $notif) {
            $notif->setLu(true);
            $this->entityManager->persist($notif);
        }
        $this->entityManager->flush();

        return new Response('ok', \Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }
}
