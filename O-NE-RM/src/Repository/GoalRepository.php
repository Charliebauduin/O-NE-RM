<?php

namespace App\Repository;

use App\Entity\Goal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Goal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Goal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Goal[]    findAll()
 * @method Goal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GoalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Goal::class);
    }

    
    //  * @return Goal[] Returns an array of Goal objects
    //  */
    
    public function getLastGoal($user)
    {
        return $this->createQueryBuilder('g')
            ->LeftJoin('g.exercise' , 'e')
            ->addSelect('e')
            ->andWhere('g.user = :val')
            ->setParameter('val', $user)
            ->orderBy('e.id', 'ASC')
            ->addorderBy('g.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    



    /*
    public function findOneBySomeField($value): ?Goal
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
