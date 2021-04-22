<?php

namespace App\Repository;

use App\Entity\Progress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Progress|null find($id, $lockMode = null, $lockVersion = null)
 * @method Progress|null findOneBy(array $criteria, array $orderBy = null)
 * @method Progress[]    findAll()
 * @method Progress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Progress::class);
    }

    /**
     * @return Progress[] Returns an array of Progress objects
     */
    
    public function getLastProgress($user)
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.exercise', 'e')
            ->addSelect('e')
            ->andWhere('p.user = :val')
            ->setParameter('val', $user)
            ->OrderBy('e.id')
            ->addorderBy('p.date', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Progress
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
