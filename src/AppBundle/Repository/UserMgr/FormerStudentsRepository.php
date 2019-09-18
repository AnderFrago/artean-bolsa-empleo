<?php
/**
 * @title FormerStudentsRepository
 * @author AnderEño (ander_frago@cuatrovientos.org)
 * @see Querys to the database Former students table
 */
namespace AppBundle\Repository\UserMgr;

use Doctrine\ORM\EntityRepository;

class FormerStudentsRepository extends EntityRepository {

  function getAllByCVIds($cvs_ids){
    $sql = 'SELECT DISTINCT std
            FROM AppBundle:CvMgr/FormerStudents std, AppBundle:CvMgr/CV cv, AppBundle:CvMgr/WorkExperiences w, AppBundle:CvMgr/Studies s
            WHERE std.id = cv.formerstudent
            AND cv.id in (:filter_cvs_ids)';
    return $this->getEntityManager()->createQuery($sql)
      ->setParameter('filter_cvs_ids', $cvs_ids);
  }

}