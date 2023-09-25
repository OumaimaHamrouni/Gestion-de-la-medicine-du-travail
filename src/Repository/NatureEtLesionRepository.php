<?php

namespace App\Repository;

use App\Entity\NatureEtLesion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NatureEtLesion|null find($id, $lockMode = null, $lockVersion = null)
 * @method NatureEtLesion|null findOneBy(array $criteria, array $orderBy = null)
 * @method NatureEtLesion[]    findAll()
 * @method NatureEtLesion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NatureEtLesionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NatureEtLesion::class);
    }

    // /**
    //  * @return NatureEtLesion[] Returns an array of NatureEtLesion objects
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
    public function findOneBySomeField($value): ?NatureEtLesion
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
