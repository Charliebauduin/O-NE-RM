<?php

namespace App\DataFixtures;


use App\Entity\Exercise;
use Doctrine\DBAL\Connection;
use App\Repository\UserRepository;
use App\Repository\ExerciseRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Provider\OneRmProvider;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ExerciseFixtures extends Fixture
{

    public function __construct(UserRepository $userRepository, ExerciseRepository $exerciseRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->exerciseRepository = $exerciseRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    private function truncate(Connection $connection)
    {
        // On passen mode SQL ! On cause avec MySQL

        // Désactivation des contraintes FK
        $users = $connection->query('SET foreign_key_checks = 0');

        // On tronque

        $users = $connection->query('TRUNCATE TABLE exercise');

        // etc.
    }

    public function load(ObjectManager $manager)
    {

        $this->truncate($manager->getConnection());

        //On va créer les exercices avec l'aide du provider

        for ($i = 0; $i <= 15; $i++){

            $provider = new OneRmProvider;

            $exercise = new Exercise();

            $exercise->setName($provider->exerciseName($i));
            $exercise->setDifficulty($provider->difficulty($i));
            $exercise->setIllustration($provider->illustration($i));
            $exercise->setAdvice($provider->advice($i));

            $manager->persist($exercise);
        }

        $manager->flush();
    }

    
}
