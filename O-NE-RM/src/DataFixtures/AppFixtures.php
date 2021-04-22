<?php

namespace App\DataFixtures;
use App\Entity\Comment;
use App\Entity\Progress;
use Doctrine\DBAL\Connection;
use App\Repository\UserRepository;
use App\Repository\ExerciseRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Goal;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class AppFixtures extends Fixture implements DependentFixtureInterface
{

    private $userRepository;

    private $exerciseRepository;



    public function __construct(UserRepository $userRepository, ExerciseRepository $exerciseRepository)
    {
        $this->userRepository = $userRepository;
        $this->exerciseRepository = $exerciseRepository;
       
    }

    private function truncate(Connection $connection)
    {
        // On passen mode SQL ! On cause avec MySQL

        // Désactivation des contraintes FK
        $users = $connection->query('SET foreign_key_checks = 0');

        // On tronque
        $users = $connection->query('TRUNCATE TABLE progress');
        $users = $connection->query('TRUNCATE TABLE comment');
        $users = $connection->query('TRUNCATE TABLE goal');


        // etc.
    }

    public function load(ObjectManager $manager)
    {
        $this->truncate($manager->getConnection());


        // on crée des progres aléatoires


        for ($i = 0; $i <= 10; $i++){

            $progress = new Progress();
            

            $progress->setDate(new \DateTime());
            $progress->setRepetition(mt_rand(1,30));
            $progress->setWeight(mt_rand(1,150));
            $progress->setUser($this->userRepository->find(mt_rand(1,9)));
            $progress->setExercise($this->exerciseRepository->find(mt_rand(1,3)));


            $manager->persist($progress);
        }
        
        // on crée des comment aléatoires


        for ($i = 0; $i <= 10; $i++){

            $comment = new Comment();
            

            $comment->setContent('loremblablabla tu devrais plutot faire comme ci et pas comme ça');
            $comment->setUser($this->userRepository->find(mt_rand(1,9)));
            $comment->setExercise($this->exerciseRepository->find(mt_rand(1,16)));


            $manager->persist($comment);
        }
        
            // on crée des objectifs (goal) aléatoires


        for ($i = 0; $i <= 10; $i++){

            $goal = new Goal();
            

            $goal->setRepetition(mt_rand(1,90));
            $goal->setWeight(mt_rand(1,200));
            $goal->setUser($this->userRepository->find(mt_rand(1,9)));
            $goal->setExercise($this->exerciseRepository->find(mt_rand(1,16)));


            $manager->persist($goal);
        }
        

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
            ExerciseFixtures::class
        );
    }


}
