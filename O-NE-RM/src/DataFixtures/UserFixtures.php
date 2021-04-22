<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Provider\OneRmProvider;
use App\Repository\FitnessRoomRepository;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{

    private $passwordEncoder;
    private $fitnessRoomRepository;


    public function __construct(UserPasswordEncoderInterface $passwordEncoder, FitnessRoomRepository $fitnessRoomRepository)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->fitnessRoomRepository = $fitnessRoomRepository;
    }

    private function truncate(Connection $connection)
    {
        // On passen mode SQL ! On cause avec MySQL

        // Désactivation des contraintes FK
        $users = $connection->query('SET foreign_key_checks = 0');

        // On tronque
        $users = $connection->query('TRUNCATE TABLE user');


        // etc.
    }

    public function load(ObjectManager $manager)
    {
        $this->truncate($manager->getConnection());

        // on créé des utilisateurs fictifs

        for ($i = 0; $i <= 9 ; $i++) {
            $user = new User();

            $gender = ['homme', 'femme'];

            $provider = new OneRmProvider;

            $user->setFirstName($provider->username($i));
            $user->setLastname($provider->username($i));
            $user->setGender($gender[mt_rand(0,1)]);
            $user->setAge(mt_rand(15, 99));
            $user->setEmail($provider->username($i). '@' . $provider->username($i) . '.com');
            $user->setPassword($this->passwordEncoder->encodePassword($user, $provider->username($i)));
            $user->setRoles(['ROLE_USER']);
            $user->setFitnessRoom($this->fitnessRoomRepository->find(mt_rand(1,3)));


            $manager->persist($user);

        }

            $manager->flush();

    }

    public function getDependencies()
    {
        return array(
            FitnessRoomFixtures::class,
        );
    }

}
