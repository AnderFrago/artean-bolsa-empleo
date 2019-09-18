<?php
/**
 * @title OffersRepository
 * @author AnderEño (ander_frago@cuatrovientos.org)
 * @see Querys to the database Offers table
 */
namespace AppBundle\Repository\OfferMgr;

use Doctrine\ORM\EntityRepository;

class OffersRepository extends EntityRepository {

  // Get the Offers from the logged in username
  public function findOffersByEmployeerUsername($username){
    $query = $this->getEntityManager()
      ->createQuery(
        'SELECT o FROM AppBundle:OfferMgr\Offers o
        JOIN o.employeer e
        WHERE e.username = :username'
      )->setParameter('username', $username);
    return $query->getResult();
  }

  public function findAllActive()
  {
    return $this->getEntityManager()
      ->createQuery(
        "SELECT o FROM AppBundle:OfferMgr\Offers o WHERE o.vOfferCode='ACTIVE' OR o.vOfferCode='PRUEBA'  ORDER BY o.modificationDate ASC"
      )
      ->getResult();
  }

  public function findOffersFromEmployeer($loggedin_username)
  {
    $query = $this->getEntityManager()
      ->createQuery(
        'SELECT o, e FROM AppBundle:OfferMgr\Offers o
        JOIN o.employeer e
        WHERE e.username = :username'
      )->setParameter('username', $loggedin_username);
    return $query->getResult();
  }

  public function findOwnerById($id)
  {
    return $this->getEntityManager()
      ->createQuery(
        'SELECT e.username FROM AppBundle:OfferMgr\Offers o
        JOIN o.employeer e 
        WHERE o.id = :id'
      )->setParameter('id', $id)
    ->getResult();
  }



}