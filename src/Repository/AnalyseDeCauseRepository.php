<?php

namespace App\Repository;

use App\Entity\AnalyseDeCause;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AnalyseDeCause|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnalyseDeCause|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnalyseDeCause[]    findAll()
 * @method AnalyseDeCause[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnalyseDeCauseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnalyseDeCause::class);
    }

    // /**
    //  * @return AnalyseDeCause[] Returns an array of AnalyseDeCause objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnalyseDeCause
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
