<?php

namespace App\Repository\OffersMgr;

use App\Entity\OffersMgr\Offer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
 * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }

    /**
     * Get an offer by $id only if the owner of the offer
     * corresponds to the passed username.
     * @param $id
     * @param $owner
     * @return mixed
     */
    public function findByIdFromOwner($id,$owner){
        $sql = "SELECT o.* FROM "
            ."(SELECT id AS employer_id FROM users "
            ."WHERE username = '$owner'"
            .") as t, offer o"
            ." WHERE o.employer_id = t.employer_id"
            ." AND o.id = $id"
            ." GROUP BY o.id";

        $q = $this->_em->getConnection();
        return $q->fetchAll($sql);
    }

    // /**
    //  * @return Offer[] Returns an array of Offer objects
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
    public function findOneBySomeField($value): ?Offer
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
