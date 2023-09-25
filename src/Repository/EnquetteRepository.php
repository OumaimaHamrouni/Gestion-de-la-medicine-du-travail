<?php

namespace App\Repository;

use App\Entity\Enquette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Enquette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Enquette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Enquette[]    findAll()
 * @method Enquette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnquetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Enquette::class);
    }

    // /**
    //  * @return Enquette[] Returns an array of Enquette objects
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
    public function findOneBySomeField($value): ?Enquette
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
