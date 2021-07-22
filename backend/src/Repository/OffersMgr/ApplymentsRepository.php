<?php

namespace App\Repository\OffersMgr;

use App\Entity\OffersMgr\Applyments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Applyments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Applyments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Applyments[]    findAll()
 * @method Applyments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplymentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Applyments::class);
    }

    public function findApplyOfferCv($offers,$cvs){
        $em = $this->getEntityManager();
        $queryApplyments  = "select a
                               from App:OffersMgr\Applyments a
                               where a.offer in (:offers)
                               and  a.cv in (:cvs)";
        $query = $em->createQuery($queryApplyments);
        $query->setParameter('offers', $offers);
        $query->setParameter('cvs', $cvs);
        return $query->getResult();
    }

    // /**
    //  * @return Applyments[] Returns an array of Applyments objects
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
    public function findOneBySomeField($value): ?Applyments
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
