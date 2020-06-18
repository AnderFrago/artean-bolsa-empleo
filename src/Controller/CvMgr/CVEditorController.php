<?php
/**
 * @title Curriculum Vitae EDITOR
 * @author AnderEño (ander_frago@cuatrovientos.org)
 * @see When editing a CV the user must have the option to add new information
 * in a recursively way without the need of launching the CV creation wizard
 */

namespace App\Controller\CvMgr;

use App\Entity\CvMgr\CV;
use App\Entity\CvMgr\CVCategories;
use App\Entity\CvMgr\Languages;
use App\Entity\CvMgr\Otherknowledge;
use App\Entity\CvMgr\Studies;
use App\Entity\CvMgr\WorkExperiences;
use App\Entity\UserMgr\FormerStudents;
use App\Repository\CvMgr\CVCategoriesRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("cv")
 */
class CVEditorController extends AbstractController {

  /**
   * Update values of an edited work experience from a selected FormedStudent's
   * CV
   * @Route("/{id_std}/edit/workexperience", name="stdnts_wrkexp_edit")
   */
  public function stdntsWorkExpEditAction($id_std, Request $request) {
    // Get the Working experience id from session
    $id_wrkexp = $request->query->get('id_wrkexp');
    // Get WorkExperience by Id
    $em = $this->getDoctrine()->getManager();
    $wrkexp_db = $em->getRepository('App:CvMgr\WorkExperiences')
      ->find($id_wrkexp);

    // Update values taken from the form
    $wrkexp_db->setVPosition($request->request->get('position'));
    $wrkexp_db->setVEmployer($request->request->get('employer'));
    $wrkexp_db->setVLocation($request->request->get('location'));
    $wrkexp_db->setLtextDuties($request->request->get('duties'));
    $wrkexp_db->setDStartDate(new DateTime($request->request->get('startdate')));
    $wrkexp_db->setDEndDate(new DateTime($request->request->get('enddate')));

    // Update database
    $em->merge($wrkexp_db);
    $em->flush();

    // Back to former students editing page
    $formerStudent = $em->getRepository(FormerStudents::class)->find($id_std);
    return $this->redirect($this->generateUrl('formerstudents_edit', [
      'username' => $formerStudent->getUsername()
    ]));
  }

  /**
   * New work experience to add to an editing FormedStudent's CV
   * @Route("/{id_std}/{id_cv}/new/workexperience", name="stdnts_wrkexp_new")
   */
  public function stdntsWorkExpNewAction($id_std, $id_cv, Request $request) {
    $em = $this->getDoctrine()->getManager();

    // Look for the editing CV
    $actual_user_cv = $em->getRepository(CV::class)->find($id_cv);

    // Get id from last workexperience
    $highest_id = $this->getDoctrine()
      ->getRepository(WorkExperiences::class)
      ->getMaxId();

    // Add another workexperience at the CV
    $newWrkExperience = new WorkExperiences();
    $newWrkExperience->setId($highest_id + 1);
    $newWrkExperience->setVPosition("to complete");
    $newWrkExperience->setVEmployer("to complete");
    $newWrkExperience->setVLocation("to complete");
    $newWrkExperience->setLtextDuties("to complete");
    $newWrkExperience->setDStartDate(new DateTime());
    $newWrkExperience->setDEndDate(new DateTime());

    // Saving the referencing entity
    $em->persist($newWrkExperience);
    $em->flush();
    // Add entity to actual user CV
    $actual_user_cv->addWorkexperience($newWrkExperience);

    $cv = $em->getRepository(CV::class)->find($id_cv);
    $newWrkExperience->setCv($cv);
    $em->merge($newWrkExperience);
    $em->flush();

    // Back to former students editing page
    $formerStudent = $em->getRepository(FormerStudents::class)->find($id_std);
    return $this->redirect($this->generateUrl('formerstudents_edit', ['username' => $formerStudent->getUsername()]));
  }

  /**
   * Update values of an edited study from selected FormedStudent's CV
   * @Route("/{id_std}/edit/study", name="stdnts_study_edit")
   */
  public function stdntsStudyEditAction($id_std, Request $request, Session $session) {
    // Get Study experience id in session
    $id_study = $request->query->get('id_study');
    // Get Study by Id
    $em = $this->getDoctrine()->getManager();
    $study_db = $em->getRepository('App:CvMgr\Studies')->find($id_study);

    // Update values
    $study_db->setVStudiesLevel($request->request->get('studieslevel'));
    $study_db->setVCategory($request->request->get('category'));
    $study_db->setVStudiesCode($request->request->get('studiescode'));
    $study_db->setVStudiesCentre($request->request->get('studiescentre'));
    $study_db->setVDescription($request->request->get('description'));
    $study_db->setDStartDate(new DateTime($request->request->get('startdate')));
    $study_db->setDEndDate(new DateTime($request->request->get('enddate')));

    // Update database
    $em->merge($study_db);
    $em->flush();

    // Back to former students editing page
    $formerStudent = $em->getRepository(FormerStudents::class)->find($id_std);
    return $this->redirect($this->generateUrl('formerstudents_edit', [
      'username' => $formerStudent->getUsername()
    ]));
  }

  /**
   * New studies to add to an editing FormedStudent's CV
   * @Route("/{id_std}/{id_cv}/new/studies", name="stdnts_study_new")
   */
  public function stdntsStudiesNewAction($id_std, $id_cv, Request $request) {
    $em = $this->getDoctrine()->getManager();

    // Look for the editing CV
    $actual_user_cv = $em->getRepository(CV::class)->find($id_cv);

    // Get id from last Study
    $highest_id = $this->getDoctrine()
      ->getRepository(Studies::class)
      ->getMaxId();

    // Add another study at the CV
    $newStudies = new Studies();
    $newStudies->setId($highest_id + 1);
    $newStudies->setVCategory("to complete");
    $newStudies->setVStudiesCode("to complete");
    $newStudies->setVStudiesLevel("to complete");
    $newStudies->setVStudiesCentre("to complete");
    $newStudies->setVDescription("to complete");
    $newStudies->setDStartDate(new DateTime());
    $newStudies->setDEndDate(new DateTime());

    // Saving the referencing entity
    $em->persist($newStudies);
    $em->flush();
    // Add entity to actual user CV
    $actual_user_cv->addStudies($newStudies);

    $cv = $em->getRepository(CV::class)->find($id_cv);
    $newStudies->setCv($cv);
    $em->merge($newStudies);
    $em->flush();

    // When creation some values are fixed for example the studies code, studies ctegory or studies level

    // Getting the studies categories from CVCategories Configuration entity
    $studies_categories_list = $em->getRepository(CVCategories::class)->getStudiesCategories();
    // Store position list in session variable
    $session = $request->getSession();
    $session->set('studies_categories_list',$studies_categories_list);
    // Getting the studies categories from CVCategories Configuration entity
    $studies_code_list = $em->getRepository(CVCategories::class)->getCVCategoriesQueryBuilder('Studies','study code');
    // Store position list in session variable
    $session = $request->getSession();
    $session->set('studies_code_list',$studies_code_list);
    // Getting the studies categories from CVCategories Configuration entity
    $studies_level_list = $em->getRepository(CVCategories::class)->getCVCategoriesQueryBuilder('Studies','study level');
    // Store position list in session variable
    $session = $request->getSession();
    $session->set('studies_level_list',$studies_level_list);


    // Back to former students editing page
    $formerStudent = $em->getRepository(FormerStudents::class)->find($id_std);
    return $this->redirect($this->generateUrl('formerstudents_edit', ['username' => $formerStudent->getUsername()]));
  }

  /**
   * Update values of an edited language from selected FormedStudent's CV
   *
   * @Route("/{id_std}/edit/language", name="stdnts_language_edit")
   */
  public function stdntsLanguageEditAction($id_std, Request $request, Session $session) {
    // Get Study experience id in session
    $id_otherknowlede = $request->query->get('id_language');
    // Get Study by Id
    $em = $this->getDoctrine()->getManager();
    $language_db = $em->getRepository('App:CvMgr\Languages')
      ->find($id_otherknowlede);

    // Update values
    $language_db->setVName($request->request->get('name'));
    $language_db->setVTitle($request->request->get('title'));
    $language_db->setLtextDescription($request->request->get('description'));
    // Update database
    $em->merge($language_db);
    $em->flush();
    // Back to former students editing page
    $formerStudent = $em->getRepository(FormerStudents::class)->find($id_std);

    return $this->redirect($this->generateUrl('formerstudents_edit', [
      'username' => $formerStudent->getUsername()
    ]));
  }

  /**
   * New language to add to an editing FormedStudent's CV
   * @Route("/{id_std}/{id_cv}/new/language", name="stdnts_language_new")
   */
  public function stdntsLanguageNewAction($id_std, $id_cv, Request $request) {
    $em = $this->getDoctrine()->getManager();

    // Look for the editing CV
    $actual_user_cv = $em->getRepository(CV::class)->find($id_cv);

    // Get id from last workexperience
    $highest_id = $this->getDoctrine()
      ->getRepository(Languages::class)
      ->getMaxId();

    // Add another work experience at the CV
    $newLanguage = new Languages();
    $newLanguage->setId($highest_id + 1);
    $newLanguage->setVName("to complete");
    $newLanguage->setLtextDescription("to complete");
    $newLanguage->setVTitle("to complete");

    // Saving the referencing entity
    $em->persist($newLanguage);
    $em->flush();
    // Add entity to actual user CV
    $actual_user_cv->addLanguages($newLanguage);

    $cv = $em->getRepository(CV::class)->find($id_cv);
    $newLanguage->setCv($cv);
    $em->merge($newLanguage);
    $em->flush();

    // Back to former students editing page
    $formerStudent = $em->getRepository(FormerStudents::class)->find($id_std);
    return $this->redirect($this->generateUrl('formerstudents_edit', ['username' => $formerStudent->getUsername()]));
  }

  /**
   * Update values of an edited study from selected FormedStudent's CV
   *
   * @Route("/{id_std}/edit/otherknowlede", name="stdnts_otherknowlede_edit")
   */
  public function stdntsOtherknowledgeEditAction($id_std, Request $request, Session $session) {
    // Get Study experience id in session
    $id_otherknowlede = $request->query->get('id_otherknowledge');
    // Get Study by Id
    $em = $this->getDoctrine()->getManager();
    $otherknowlede_db = $em->getRepository('App:CvMgr\Otherknowledge')
      ->find($id_otherknowlede);

    // Update values
    $otherknowlede_db->setVName($request->request->get('name'));
    $otherknowlede_db->setVTitle($request->request->get('title'));
    $otherknowlede_db->setLtextDescription($request->request->get('description'));
    // Update database
    $em->merge($otherknowlede_db);
    $em->flush();
    // Back to former students editing page
    $formerStudent = $em->getRepository(FormerStudents::class)->find($id_std);
    return $this->redirect($this->generateUrl('formerstudents_edit', [
      'username' => $formerStudent->getUsername()
    ]));
  }

  /**
   * New otherknowledge to add to an editing FormedStudent's CV
   * @Route("/{id_std}/{id_cv}/new/otherknowledge", name="stdnts_otherknowledge_new")
   */
  public function stdntsOtherknowledgeNewAction($id_std, $id_cv, Request $request) {
    $em = $this->getDoctrine()->getManager();

    // Look for the editing CV
    $actual_user_cv = $em->getRepository(CV::class)->find($id_cv);

    // Get id from last workexperience
    $highest_id = $this->getDoctrine()
      ->getRepository(WorkExperiences::class)
      ->getMaxId();

    // Add another other knowledge at the CV
    $newOtherknowledge = new Otherknowledge();
    $newOtherknowledge->setId($highest_id + 1);
    $newOtherknowledge->setVName("to complete");
    $newOtherknowledge->setLtextDescription("to complete");
    $newOtherknowledge->setVTitle("to complete");

    // Saving the referencing entity
    $em->persist($newOtherknowledge);
    $em->flush();
    // Add entity to actual user CV
    $actual_user_cv->addOtherknowledges($newOtherknowledge);

    $cv = $em->getRepository(CV::class)->find($id_cv);
    $newOtherknowledge->setCv($cv);
    $em->merge($newOtherknowledge);
    $em->flush();

    // Back to former students editing page
    $formerStudent = $em->getRepository(FormerStudents::class)->find($id_std);
    return $this->redirect($this->generateUrl('formerstudents_edit', ['username' => $formerStudent->getUsername()]));
  }
}

