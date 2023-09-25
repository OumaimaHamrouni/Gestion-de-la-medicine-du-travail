<?php

namespace App\Repository;

use App\Entity\Rhse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Rhse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rhse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rhse[]    findAll()
 * @method Rhse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RhseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rhse::class);
    }

    // /**
    //  * @return Rhse[] Returns an array of Rhse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rhse
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
