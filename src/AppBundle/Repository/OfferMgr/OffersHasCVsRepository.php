<?php
/**
 * @title OffersHasCVsRepository
 * @author AnderEño (ander_frago@cuatrovientos.org)
 * @see
 */
namespace AppBundle\Repository\OfferMgr;

use Doctrine\ORM\EntityRepository;

class OffersHasCVsRepository extends EntityRepository {


  public function findOfferHasCVsByOfferId($offerids){

    $query = $this->getEntityManager()
      ->createQuery(
        'SELECT h FROM AppBundle:OfferMgr\Offers_has_CVs h   
        JOIN h.offer o    
        WHERE o.id = :id'
      )->setParameter('id', $offerids);
    return $query->getResult();
  }

}