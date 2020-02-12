<?php

namespace App\Repository;

use App\Entity\Subscribed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Subscribed|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subscribed|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subscribed[]    findAll()
 * @method Subscribed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubscribedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subscribed::class);
    }

    // /**
    //  * @return Subscribed[] Returns an array of Subscribed objects
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
    public function findOneBySomeField($value): ?Subscribed
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
