<?php
/**
 * @title StudiesRepository
 * @author AnderEño (ander_frago@cuatrovientos.org)
 * @see Querys to the database Studies table
 */
namespace AppBundle\Repository\CvMgr;

use Doctrine\ORM\EntityRepository;

class StudiesRepository extends EntityRepository {

  // Method to get the biggest Studies Id in database
  // Needed to assign the next ID to a new Study to be added when
  // coming from the CV editing controller
  public function getMaxId()
  {
    $em = $this->getEntityManager();
    return $em->createQueryBuilder()
      ->select('MAX(e.id)')
      ->from('AppBundle:CvMgr\Studies', 'e')
      ->getQuery()
      ->getSingleScalarResult();
  }

}




