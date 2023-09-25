<?php

namespace App\Repository;

use App\Entity\SiegeLesion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SiegeLesion|null find($id, $lockMode = null, $lockVersion = null)
 * @method SiegeLesion|null findOneBy(array $criteria, array $orderBy = null)
 * @method SiegeLesion[]    findAll()
 * @method SiegeLesion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiegeLesionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SiegeLesion::class);
    }

    // /**
    //  * @return SiegeLesion[] Returns an array of SiegeLesion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SiegeLesion
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
