<?php

namespace App\DataFixtures;

use App\Entity\FitnessRoom;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class FitnessRoomFixtures extends Fixture 
{


    public function PasswordHash($PasswordToHash)
    {
        return password_hash($PasswordToHash, PASSWORD_ARGON2I );
    }


    private function truncate(Connection $connection)
    {
        // On passen mode SQL ! On cause avec MySQL

        // Désactivation des contraintes FK
        $users = $connection->query('SET foreign_key_checks = 0');

        // On tronque
        $users = $connection->query('TRUNCATE TABLE fitness_room');


        // etc.
    }

    public function load(ObjectManager $manager)
    {
        $this->truncate($manager->getConnection());



        // On créé des salles de sport fictives 

        for ($i = 1; $i <= 3; $i++){

            $fitnessRoom = new FitnessRoom();

            $fitnessRoom->setName('salle' . $i);
            $fitnessRoom->setPassword($this->PasswordHash('salle' . $i));

            $manager->persist($fitnessRoom);
        }

        $manager->flush();
            

    }

            

}


