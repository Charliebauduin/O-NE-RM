<?php

namespace App\Repository;

use App\Entity\FitnessRoom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FitnessRoom|null find($id, $lockMode = null, $lockVersion = null)
 * @method FitnessRoom|null findOneBy(array $criteria, array $orderBy = null)
 * @method FitnessRoom[]    findAll()
 * @method FitnessRoom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FitnessRoomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FitnessRoom::class);
    }

    // /**
    //  * @return FitnessRoom[] Returns an array of FitnessRoom objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FitnessRoom
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
