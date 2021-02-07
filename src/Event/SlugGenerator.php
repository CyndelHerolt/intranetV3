<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/Event/SlugGenerator.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 07/02/2021 10:51
 */

namespace App\Event;

use App\Classes\Tools;
use App\Entity\Article;
use App\Entity\Utilisateur;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class SlugGenerator implements EventSubscriber
{
    // this method can only return the event names; you cannot define a
    // custom method name to execute when each event triggers
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    // callback methods must be called exactly like the events they listen to;
    // they receive an argument of type LifecycleEventArgs, which gives you access
    // to both the entity object of the event and the entity manager itself
    public function prePersist(LifecycleEventArgs $args)
    {
        $this->slug('persist', $args);
    }

    private function slug(string $action, LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // if this subscriber only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if ($entity instanceof Article) {
            return $entity->setSlug(Tools::slug($entity->getTitre()));
        } elseif ($entity instanceof Utilisateur) {
            if ('' !== $entity->getMailUniv() && null !== $entity->getMailUniv()) {
                $tabSlug = explode('@', $entity->getMailUniv());

                return $entity->setSlug($tabSlug[0]);
            }
        }

        // ... get the entity information and log it somehow
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->slug('update', $args);
    }
}
