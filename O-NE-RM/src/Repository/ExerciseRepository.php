<?php

namespace App\Repository;

use App\Entity\Exercise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Exercise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercise[]    findAll()
 * @method Exercise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exercise::class);
    }

    // /**
    //  * @return Exercise[] Returns an array of Exercise objects
    //  */
    
    // public function getAllGoals($user)
    // {
    //     return $this->createQueryBuilder('e')
    //         ->LeftJoin('e.goals', 'g')
    //         ->addSelect('g')
    //         ->where('g.user = :val')
    //         ->setParameter('val', $user)
    //         ->orderBy('e.id', 'ASC')
    //         ->getQuery()
    //         ->getResult();
    // }

    // public function getLastGoal($user)
    // {
    //     return $this->createQueryBuilder('e')
    //         ->LeftJoin('e.goals', 'g')
    //         ->addSelect('g')
    //         ->where('g.user = :val')
    //         ->setParameter('val', $user)
    //         ->orderBy('e.id', 'ASC')
    //         ->getQuery()
    //         ->getResult();
    // }

    public function getLastPerf($user)
    {

    }

    


    public function getAllGoals($user)
    {
        $entityManager = $this->getEntityManager();

        $statement = $entityManager->getConnection()->prepare(

            'SELECT e.id AS ID_exercise, g.id AS ID_goal, e.name, g.repetition, g.weight
            FROM exercise AS e
            LEFT JOIN goal  AS g
            ON e.id = g.exercise_id
            AND g.user_id = :val
            ORDER BY ID_exercise ASC, g.id DESC');

        $statement->execute([
            'val' => $user->getId()
        ]);
        // returns an array of Product objects
        return $statement->fetchAll();

    }




    public function OneExerciseWithUserProgress($user, $exercise)
    {
        $entityManager = $this->getEntityManager();

        $statement = $entityManager->getConnection()->prepare(

            'SELECT e.id AS ID_exercise, p.id AS ID_progress, e.name, e.difficulty, e.advice, e.illustration, p.date, p.repetition, p.weight, p.user_id
            FROM exercise AS e
            LEFT JOIN progress  AS p
            ON e.id = p.exercise_id
            WHERE e.id = :val2
            AND p.user_id = :val
            ORDER BY ID_exercise ASC, p.date ASC');

        $statement->execute([

            'val2' => $exercise->getId(),
            'val' => $user->getId()
        ]);
        // returns an array of Product objects
        return $statement->fetchAll();

    }


    //SELECT * From exercise left join progress On exercise.id = progress.exercise_id WHERE progress.user_id = 1 AND exercise.id = 1
    //SELECT * From exercise LEFT JOIN progress On exercise.id = progress.exercise_id AND progress.user_id = 1

    /**
     * Liste des exercices avec progres d'un utilisateur donné
     */
    
    public function ExerciseWithUserProgressAndGoals($user)
    {
        $entityManager = $this->getEntityManager();

        $statement = $entityManager->getConnection()->prepare(

            'SELECT e.id AS ID_exercise, p.id AS ID_progress, g.id AS ID_goal, g.weight AS goal_weight, g.repetition AS goal_repetition, e.name, p.date, p.repetition AS progress_repetition, p.weight AS progress_weight, p.user_id
            FROM exercise AS e
            LEFT JOIN goal  AS g
            ON e.id = g.exercise_id
            AND g.user_id = :val
            LEFT JOIN progress as p
            ON e.id = p.exercise_id
            AND p.user_id = :val
            ORDER BY ID_exercise ASC, p.id DESC, g.id DESC');

        $statement->execute([
            'val' => $user->getId()
        ]);
        // returns an array of Product objects
        return $statement->fetchAll();

    }


    /*
    public function findOneBySomeField($value): ?Exercise
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
