<?php

namespace App\Repository;

use App\Entity\ExamenComp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ExamenComp|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamenComp|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamenComp[]    findAll()
 * @method ExamenComp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamenCompRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamenComp::class);
    }

    // /**
    //  * @return ExamenComp[] Returns an array of ExamenComp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExamenComp
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
