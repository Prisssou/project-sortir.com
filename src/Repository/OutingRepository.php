<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Outing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Outing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Outing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Outing[]    findAll()
 * @method Outing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OutingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Outing::class);
    }

    /**
     * Récupère les sorties en lien avec une recherche
     * @return Outing[]
     */
    public function findSearch(SearchData $search, $user): array
    {

        $query = $this
            ->createQueryBuilder('outing');


        if (!empty($search->getMotCle())){
            $query = $query
                ->andWhere('outing.name LIKE :motCle')
                ->setParameter('motCle', "%{$search->getMotCle()}%");
        }

        if ($search->getBeginDate() != null){
            $query = $query
                ->andWhere('outing.startDate >= :beginDate')
                ->setParameter('beginDate', $search->getBeginDate());
        }
        if ($search->getEndDate() != null){
            $query = $query
                ->andWhere('outing.startDate <= :endDate')
                ->setParameter('endDate', $search->getEndDate());
        }
        if (!empty($search->getDureeMin())){
            $query = $query
                ->andWhere('outing.duration >= :dureeMin')
                ->setParameter('dureeMin', $search->getDureeMin());
        }
        if (!empty($search->getDureeMax())){
            $query = $query
                ->andWhere('outing.duration <= :dureeMax')
                ->setParameter('dureeMax', $search->getDureeMax());
        }
        if (!empty($search->getOrga())){
            if ($search->getOrga() == 1){
                $query = $query
                    ->andWhere('outing.member = :orga')
                    ->setParameter('orga', $user);
            }

        }
        if (!empty($search->getDureeMax())){
                $query = $query
                    ->andWhere('outing.duration <= :dureeMax')
                    ->setParameter('dureeMax', $search->getDureeMax());


        }



        return $query->getQuery()->getResult();
    }


    // /**
    //  * @return Outing[] Returns an array of Outing objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Outing
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
