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
     * @param SearchData $search
     * @param $user
     * @return Outing[]
     */
    public function findSearch(SearchData $search, $user): array
    {


        $query = $this
            ->createQueryBuilder('outing');


        if (!empty($search->getMotCle())) {
            $query = $query
                ->andWhere('outing.name LIKE :motCle')
                ->setParameter('motCle', "%{$search->getMotCle()}%");
        }

        if ($search->getBeginDate() != null) {
            $query = $query
                ->andWhere('outing.startDate >= :beginDate')
                ->setParameter('beginDate', $search->getBeginDate());
        }
        if ($search->getEndDate() != null) {
            $query = $query
                ->andWhere('outing.startDate <= :endDate')
                ->setParameter('endDate', $search->getEndDate());
        }
        if (!empty($search->getDureeMin())) {
            $query = $query
                ->andWhere('outing.duration >= :dureeMin')
                ->setParameter('dureeMin', $search->getDureeMin());
        }
        if (!empty($search->getDureeMax())) {
            $query = $query
                ->andWhere('outing.duration <= :dureeMax')
                ->setParameter('dureeMax', $search->getDureeMax());
        }
        if (!empty($search->getOrga())) {
            if ($search->getOrga() == 1) {
                $query = $query
                    ->addSelect('i')
                    ->leftJoin('outing.member', 'i')
                    ->andWhere('i = :organisateur')
                    ->setParameter('organisateur', $user);

            }

        }

        if (!empty($search->getInscrit())) {
            if ($search->getInscrit() == 1) {
                $query = $query
                    ->addSelect('s')
                    ->innerJoin('outing.subscriptions', 's')
//                    ->innerJoin('outing.member', 'm')
                    ->andWhere('s.member = :inscrit')
//                    ->andWhere('m = :inscrit')
//                    ->andWhere('m = :inscrit OR s = :inscrit')
                    ->setParameter('inscrit', $user);

            }

        }
        if (!empty($search->getNotInscrit())) {
            if ($search->getNotInscrit() == 1) {
                $query = $query
                    ->addSelect('sa')
                    ->innerjoin('outing.subscriptions', 'sa')
                    ->andWhere('sa.member != :notinscrit')
                    ->setParameter('notinscrit', $user);

            }

        }

//        if (!empty($search->getPassee())) {
//            if ($search->getPassee() == 1) {
//                $query = $query
//                    ->andWhere('outing.state = :passe')
//                    ->setParameter('passe', "5");
//
//            }
//
//        }
        if (!empty($search->getPassee())) {
            if ($search->getPassee() == 1) {
                $query = $query
                    ->addSelect('e')
                    ->leftJoin('outing.state', 'e')
                    ->andWhere('e.label = :passe')
                    ->setParameter('passe', "Passée");

            }

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
