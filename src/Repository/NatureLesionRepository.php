<?php

namespace App\Repository;

use App\Entity\NatureLesion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NatureLesion|null find($id, $lockMode = null, $lockVersion = null)
 * @method NatureLesion|null findOneBy(array $criteria, array $orderBy = null)
 * @method NatureLesion[]    findAll()
 * @method NatureLesion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatureLesionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NatureLesion::class);
    }

    // /**
    //  * @return NatureLesion[] Returns an array of NatureLesion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NatureLesion
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
