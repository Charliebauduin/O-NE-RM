<?php

namespace App\EventSubscriber;


use App\Entity\User;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserPasswordSubscriber implements EventSubscriber
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
        ];
    }

 
    public function prePersist(LifecycleEventArgs $args): void
    {
        $this->setPassword('persist', $args);
    }


    private function setPassword(string $action, LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof User) {
            return;
        }

        $passwordEncoded = $this->encoder->encodePassword($entity, $entity->getPassword());

        $entity->setPassword($passwordEncoded);
    }
    
}