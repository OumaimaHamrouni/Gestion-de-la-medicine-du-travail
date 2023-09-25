<?php

namespace App\Repository;

use App\Entity\Risque;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Risque|null find($id, $lockMode = null, $lockVersion = null)
 * @method Risque|null findOneBy(array $criteria, array $orderBy = null)
 * @method Risque[]    findAll()
 * @method Risque[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RisqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Risque::class);
    }

    // /**
    //  * @return Risque[] Returns an array of Risque objects
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
    public function findOneBySomeField($value): ?Risque
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
