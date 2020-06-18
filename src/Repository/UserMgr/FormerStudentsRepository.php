<?php
/**
 * @title FormerStudentsRepository
 * @author AnderEño (ander_frago@cuatrovientos.org)
 * @see Querys to the database Former students table
 */
namespace App\Repository\UserMgr;

use Doctrine\ORM\EntityRepository;

class FormerStudentsRepository extends EntityRepository {

  function getAllByCVIds($cvs_ids){
    $sql = 'SELECT DISTINCT std
            FROM App:CvMgr/FormerStudents std, App:CvMgr/CV cv, App:CvMgr/WorkExperiences w, App:CvMgr/Studies s
            WHERE std.id = cv.formerstudent
            AND cv.id in (:filter_cvs_ids)';
    return $this->getEntityManager()->createQuery($sql)
      ->setParameter('filter_cvs_ids', $cvs_ids);
  }

}