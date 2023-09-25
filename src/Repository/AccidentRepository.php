<?php

namespace App\Repository;

use App\Entity\Accident;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Accident|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accident|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accident[]    findAll()
 * @method Accident[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccidentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accident::class);
    }

    // /**
    //  * @return Accident[] Returns an array of Accident objects
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
    public function findOneBySomeField($value): ?Accident
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function accident()
    {
$query = $this->createQueryBuilder('accident');

        $query = $this->createQueryBuilder('accident');
        $res = $query
            ->select('accident')
            ->groupBy("accident.ref")
            ->getQuery()
            ->getResult();
        return $res;
}
}
