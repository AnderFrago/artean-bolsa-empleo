<?php
/**
 * @title CvsRepository
 * @author AnderEño (ander_frago@cuatrovientos.org)
 * @see Querys to the database Cvs table
 */
namespace App\Repository\CvMgr;

use App\Entity\CvMgr\CV;
use App\Entity\CvMgr\Languages;
use App\Entity\CvMgr\Otherknowledge;
use App\Entity\CvMgr\Studies;
use App\Entity\CvMgr\WorkExperiences;
use App\Entity\UserMgr\FormerStudents;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Session\Session;

class CVsRepository extends EntityRepository {

  // Get CVs by Id list
  public function findCVByIds($ids){
    $query = $this->getEntityManager()
      ->createQuery(
        'SELECT c FROM App:CvMgr\CV c
        WHERE c.id in (:ids)'
      )->setParameter('ids', $ids);
    return $query->getResult();
  }


  // Get the CV from the logged in username
 public function findCVByFormerStudentUsername($username){
   $query = $this->getEntityManager()
     ->createQuery(
       'SELECT o FROM App:CvMgr\CV o
        JOIN o.formerstudent e
        WHERE e.username = :username'
     )->setParameter('username', $username);
   return $query->getResult();
 }

  // Method used to persist values in database
  public function store_cv_values( Session $session, CV $actual_user_cv)
  {
    // Manage fields according to what the database expects:
    $em = $this->getEntityManager();
    // Add user values stored in session to the actual user cv
    $id = $session->get('formerStudentID');
    // Get formed student values from database
    $formerStudent = $em->getRepository(FormerStudents::class)->find($id);

    $actual_user_cv->setFormerstudent($formerStudent);

    foreach ($actual_user_cv->getWorkexperiences() as $aux_workexperience) {
      $em->persist($aux_workexperience);
    }
    foreach ($actual_user_cv->getStudies() as $aux_studies) {
      $em->persist($aux_studies);
    }
    foreach ($actual_user_cv->getLanguages() as $aux_language) {
      $em->persist($aux_language);
    }
    foreach ($actual_user_cv->getOtherknowledges() as $aux_otherknowledge) {
      $em->persist($aux_otherknowledge);
    }


    $em->flush();
    // Delete CV in session
    $session->set('actual_user_cv', null);

  }

  // Get CVs IDs in database
  function getAllIds(){
      $sql = "SELECT cv.id FROM App:CvMgr\CV cv";
    return $this->getEntityManager()->createQuery(
      $sql)->getResult();
  }

  /**
   * Methods to apply filters in the CV search page
   */
  function filter_WorkExperience_Studies_Keyword( $query_cvs_ids, $selected_wrkexp_category, $selected_study_category, $selected_key_word){
    $entityManager = $this->getEntityManager();
    $sql = 'SELECT DISTINCT std
            FROM App:UserMgr\FormerStudents std, App:CvMgr\CV cv, App:CvMgr\WorkExperiences w, App:CvMgr\Studies s
            WHERE std.id = cv.formerstudent
            AND cv.id in (:filter_cvs_ids)
            AND cv.id = w.cv
            AND cv.id = s.cv
            AND w.vPosition = :selected_wrkexp_category
            AND s.vCategory = :selected_study_category
            AND
             (
                (
                  w.vPosition LIKE :selected_key_word
                  OR w.vEmployer LIKE :selected_key_word
                  OR w.vLocation LIKE :selected_key_word
                  OR w.ltextDuties LIKE :selected_key_word
                )
                OR 
                (
                  s.vCategory LIKE :selected_key_word
                  OR s.vStudiesCode LIKE :selected_key_word
                  OR s.vStudiesLevel LIKE :selected_key_word
                  OR s.vStudiesCentre LIKE :selected_key_word               
                )
             )
            ORDER BY std.id DESC';
    return $entityManager->createQuery($sql)
      ->setParameter('filter_cvs_ids', $query_cvs_ids)
      ->setParameter('selected_wrkexp_category', $selected_wrkexp_category)
      ->setParameter('selected_study_category', $selected_study_category)
      ->setParameter('selected_key_word',  "%$selected_key_word%" )
      ->getResult();
  }
  function filter_WorkExperience_Studies($query_cvs_ids, $selected_wrkexp_category, $selected_study_category){
    $entityManager = $this->getEntityManager();
    $sql = 'SELECT DISTINCT std
            FROM App:UserMgr\FormerStudents std, App:CvMgr\CV cv, App:CvMgr\WorkExperiences w, App:CvMgr\Studies s
            WHERE std.id = cv.formerstudent
            AND cv.id in (:filter_cvs_ids)
            AND cv.id = w.cv
            AND cv.id = s.cv
            AND w.vPosition = :selected_wrkexp_category
            AND s.vCategory = :selected_study_category
            ORDER BY std.id DESC';
    return  $entityManager->createQuery($sql)
      ->setParameter('filter_cvs_ids', $query_cvs_ids)
      ->setParameter('selected_wrkexp_category', $selected_wrkexp_category)
      ->setParameter('selected_study_category', $selected_study_category)
      ->getResult();
  }
  function filter_WorkExperience_Keyword($query_cvs_ids, $selected_wrkexp_category, $selected_key_word){
    $entityManager = $this->getEntityManager();
    $sql = 'SELECT DISTINCT std
            FROM App:UserMgr\FormerStudents std, App:CvMgr\CV cv, App:CvMgr\WorkExperiences w, App:CvMgr\Studies s
            WHERE std.id = cv.formerstudent
            AND cv.id in (:filter_cvs_ids)
            AND cv.id = w.cv
            AND cv.id = s.cv
            AND w.vPosition = :selected_wrkexp_category
            AND
             (
                (
                  w.vPosition LIKE :selected_key_word
                  OR w.vEmployer LIKE :selected_key_word
                  OR w.vLocation LIKE :selected_key_word
                  OR w.ltextDuties LIKE :selected_key_word
                )
                OR 
                (
                  s.vCategory LIKE :selected_key_word
                  OR s.vStudiesCode LIKE :selected_key_word
                  OR s.vStudiesLevel LIKE :selected_key_word
                  OR s.vStudiesCentre LIKE :selected_key_word                 
                )
             )
            ORDER BY std.id DESC';
    return $entityManager->createQuery($sql)
      ->setParameter('filter_cvs_ids', $query_cvs_ids)
      ->setParameter('selected_wrkexp_category', $selected_wrkexp_category)
      ->setParameter('selected_key_word',  "%$selected_key_word%")
      ->getResult();
  }
  function filter_WorkExperience($query_cvs_ids, $selected_wrkexp_category){
    $entityManager = $this->getEntityManager();
    $sql = 'SELECT DISTINCT std
            FROM App:UserMgr\FormerStudents std, App:CvMgr\CV cv, App:CvMgr\WorkExperiences w
            WHERE std.id = cv.formerstudent
            AND cv.id in (:filter_cvs_ids)
            AND cv.id = w.cv
            AND w.vPosition = :selected_wrkexp_category
            ORDER BY std.id DESC';
    return $entityManager->createQuery($sql)
      ->setParameter('filter_cvs_ids', $query_cvs_ids)
      ->setParameter('selected_wrkexp_category', $selected_wrkexp_category)
      ->getResult();
  }
  function filter_Studies_Keyword($query_cvs_ids, $selected_study_category, $selected_key_word){
    $entityManager = $this->getEntityManager();
    $sql = 'SELECT DISTINCT std
            FROM App:UserMgr\FormerStudents std, App:CvMgr\CV cv, App:CvMgr\Studies s
            WHERE std.id = cv.formerstudent
            AND cv.id in (:filter_cvs_ids)
            AND cv.id = s.cv
            AND s.vCategory = :selected_study_category
            AND
             (
              s.vCategory LIKE :selected_key_word
              OR s.vStudiesCode LIKE :selected_key_word
              OR s.vStudiesLevel LIKE :selected_key_word
              OR s.vStudiesCentre LIKE :selected_key_word              
             )
            ORDER BY std.id DESC';
    $query_formerStudents = $entityManager->createQuery($sql)
      ->setParameter('filter_cvs_ids', $query_cvs_ids)
      ->setParameter('selected_study_category', $selected_study_category)
      ->setParameter('selected_key_word',  "%$selected_key_word%" )
      ->getResult();
  }
  function filter_Studies($query_cvs_ids, $selected_study_category){
    $entityManager = $this->getEntityManager();
    $sql = 'SELECT DISTINCT std
            FROM App:UserMgr\FormerStudents std, App:CvMgr\CV cv, App:CvMgr\Studies s
            WHERE std.id = cv.formerstudent
            AND cv.id in (:filter_cvs_ids)
            AND cv.id = s.cv
            AND s.vCategory = :selected_study_category
            ORDER BY std.id DESC';
    return $entityManager->createQuery($sql)
      ->setParameter('filter_cvs_ids', $query_cvs_ids)
      ->setParameter('selected_study_category', $selected_study_category)
      ->getResult();
  }
  function filter_Keyword( $query_cvs_ids, $selected_key_word){
    $entityManager = $this->getEntityManager();
    $sql = 'SELECT DISTINCT std
            FROM App:UserMgr\FormerStudents std, App:CvMgr\CV cv, App:CvMgr\WorkExperiences w, App:CvMgr\Studies s
            WHERE std.id = cv.formerstudent
            AND cv.id in (:filter_cvs_ids)
            AND cv.id = w.cv
            AND cv.id = s.cv
            AND
             (
                (
                  w.vPosition LIKE :selected_key_word
                  OR w.vEmployer LIKE :selected_key_word
                  OR w.vLocation LIKE :selected_key_word
                  OR w.ltextDuties LIKE :selected_key_word
                )
                OR 
                (
                  s.vCategory LIKE :selected_key_word
                  OR s.vStudiesCode LIKE :selected_key_word
                  OR s.vStudiesLevel LIKE :selected_key_word
                  OR s.vStudiesCentre LIKE :selected_key_word                
                )
             )
            ORDER BY std.id DESC';
    return $entityManager->createQuery($sql)
      ->setParameter('filter_cvs_ids', $query_cvs_ids)
      ->setParameter('selected_key_word',  "%$selected_key_word%" )
      ->getResult();
  }
}


