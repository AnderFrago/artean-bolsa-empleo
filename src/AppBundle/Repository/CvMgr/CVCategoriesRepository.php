<?php
/**
 * @title CvCategoriesRepository
 * @author AnderEño (ander_frago@cuatrovientos.org)
 * @see Get categories to generate filter options.
 *
 * Recover from: Querying for Objetcs with DQL: https://symfony.com/doc/3.4/doctrine.html#querying-for-objects-with-dql
 */
namespace AppBundle\Repository\CvMgr;

use Doctrine\ORM\EntityRepository;

class CVCategoriesRepository extends EntityRepository {

  function getWorExperiencesPositions(){
      return $this->getEntityManager()->createQuery(
      "SELECT e.value FROM AppBundle:CvMgr\CVCategories e WHERE e.key='Work Experience' AND e.description='position'")->getResult();
  }
  function getStudiesCategories(){
    return $this->getEntityManager()->createQuery(
      "SELECT e.value FROM AppBundle:CvMgr\CVCategories e WHERE e.key='Studies' AND e.description='study category'")->getResult();
  }

  //QueryBuilders used in the generation of Form's drop down lists
  function getCVCategoriesQueryBuilder($key, $desc){
        $qb = $this->getEntityManager()->createQueryBuilder();
       return $qb->select('e')
          ->from('AppBundle:CvMgr\CVCategories', 'e')
          ->where('e.key= :key')
          ->andWhere('e.description= :desc')
          ->setParameter('key', $key)
          ->setParameter('desc', $desc);
  }

}


