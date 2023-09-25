<?php

namespace App\Repository;

use App\Entity\ListSms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ListSms|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListSms|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListSms[]    findAll()
 * @method ListSms[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListSmsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListSms::class);
    }

    // /**
    //  * @return ListSms[] Returns an array of ListSms objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ListSms
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
