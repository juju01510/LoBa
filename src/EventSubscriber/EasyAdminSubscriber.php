<?php

namespace App\EventSubscriber;
use App\Entity\Post;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setDateCreated']
        ];
    }

    public function setDateCreated(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if(!($entity instanceof Post)){
            return;
        }
        $now = new DateTime('now');
        $entity->setDateCreated($now);
    }
}
