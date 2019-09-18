<?php
/**
 * @title OtherknowledgeRepository
 * @author AnderEño (ander_frago@cuatrovientos.org)
 * @see Querys to the database Otherknowledge table
 */
namespace AppBundle\Repository\CvMgr;

use Doctrine\ORM\EntityRepository;

class OtherknowledgeRepository extends EntityRepository {

  // Method to get the biggest Work Experience Id in database
  // Needed to assign the next ID to a new Work experience to be added when
  // coming from the CV editing controller
  public function getMaxId()
  {
     $em = $this->getEntityManager();
     return $em->createQueryBuilder()
      ->select('MAX(e.id)')
      ->from('AppBundle:CvMgr\Otherknowledge', 'e')
      ->getQuery()
      ->getSingleScalarResult();
  }

}




