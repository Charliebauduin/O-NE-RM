<?php

namespace App\EventSubscriber;


use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class EasyAdminUserPasswordSubscriber implements EventSubscriberInterface
{

    private $encoder;


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setPassword'],
        ];
    }

    public function setPassword(BeforeEntityPersistedEvent $event)
    {

        $entity = $event->getEntityInstance();

        if (!($entity instanceof User)) {
            return;
        }

        $passwordEncoded = $this->encoder->encodePassword($entity, $entity->getPassword());
        $entity->setPassword($passwordEncoded);

    }
} 
