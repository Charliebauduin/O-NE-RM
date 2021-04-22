<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeCrudActionEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EasyAdminUpdateUserPasswordSubscriber implements EventSubscriberInterface
{

    private $encoder;
    private $oldPassword;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;

    }

    
    public static function getSubscribedEvents()
    {
        return [

            BeforeCrudActionEvent::class => ['getOldPassword'],
            BeforeEntityUpdatedEvent::class => ['setPassword'],
        ];
    }

    public function getOldPassword(BeforeCrudActionEvent $event)
    {
        
        if($event->getAdminContext()->getEntity()->getInstance() !== null){

            if($event->getAdminContext()->getEntity()->getInstance()instanceof User) {

                $oldPassword = $event->getAdminContext()->getEntity()->getInstance()->getPassword();
        
                return $this->oldPassword = $oldPassword;

            }

        }

    }

    public function setPassword(BeforeEntityUpdatedEvent $event)
    {

        $entity = $event->getEntityInstance();

        if (!($entity instanceof User)) {
            return;
        }

        if($entity->getPassword() !== $this->oldPassword) {

            $passwordEncoded = $this->encoder->encodePassword($entity, $entity->getPassword());
            $entity->setPassword($passwordEncoded);

        }

    }


}
