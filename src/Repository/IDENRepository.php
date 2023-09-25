<?php

namespace App\Repository;

use App\Entity\IDEN;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IDEN|null find($id, $lockMode = null, $lockVersion = null)
 * @method IDEN|null findOneBy(array $criteria, array $orderBy = null)
 * @method IDEN[]    findAll()
 * @method IDEN[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IDENRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IDEN::class);
    }

    // /**
    //  * @return IDEN[] Returns an array of IDEN objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IDEN
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
