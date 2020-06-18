<?php
/**
 * @title Curriculum Vitae SEARCH
 * @author AnderEño (ander_frago@cuatrovientos.org)
 * @see The Emloyeers must have the oportunity to do a manual serach of CVs from
 * the database applying advanced filters
 */

namespace App\Controller\CvMgr;

use App\Entity\CvMgr\CVCategories;
use App\Entity\CvMgr\Otherknowledge;
use App\Entity\CvMgr\Studies;
use App\Entity\CvMgr\WorkExperiences;
use App\Entity\CvMgr\CV;

use App\Entity\UserMgr\FormerStudents;
use App\Repository\CvMgr\CVsRepository;
use App\Repository\OfferMgr\CVCategoriesRepository;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("cv")
 */
class CVSearchController extends AbstractController {

  /**
   * Lists all Cvs entities.
   * @Route("/search", name="cvs_index")
   */
  public function indexAction(Request $request) {
    $entityManager = $this->getDoctrine()->getManager();

    // Get Distinct categories to generate filter options
    $wrkexp_categories = $entityManager->getRepository(CVCategories::class)->getWorExperiencesPositions();

    $studies_categories = $entityManager->getRepository(CVCategories::class)->getStudiesCategories();

    // Get CVs by work experiences and studies
    $cvs_ids = $entityManager->getRepository(CV::class)->getAllIds();

    // If values from filters selected and Form resend by get method values must be filtered
    if (isset($_GET['wrkexp_category']) || isset($_GET['studies_category']) || isset($_GET['keyword'])) {
      $formerStudents = $this->filterFormerStudents($cvs_ids, $wrkexp_categories, $studies_categories);
    }
    else {
      // Otherwise we get all formed students
      $formerStudents = $entityManager->getRepository(FormerStudents::class)->getAllByCVIds( $cvs_ids);
    }

    return $this->render('cvmgr/index.html.twig', [
      'wrkexp_categories' => $wrkexp_categories,
      'studies_categories' => $studies_categories,
      'formerStudents' => $formerStudents,
    ]);
  }

  /**
   * Function to filter students from database depending on selected filters by
   * the user
   */
  function filterFormerStudents($query_cvs_ids, $wrkexp_categories, $studies_categories) {
    // First we get the selected value`s position
    if (isset($_GET['wrkexp_category'])) {
      $selected_wrkexp_category_position = $_GET['wrkexp_category'];
      // then the value from categories by the  index
      $selected_wrkexp_category = $wrkexp_categories[$selected_wrkexp_category_position - 1];
    }

    if (isset($_GET['studies_category'])) {
      $selected_study_category_position = $_GET['studies_category'];
      $selected_study_category = $studies_categories[$selected_study_category_position - 1];
    }

    $selected_key_word = isset($_GET['keyword']) ? $_GET['keyword'] : "";

    // Filter by workexperience
    if (isset($selected_wrkexp_category)) {
      // Filter by studies
      if (isset($selected_study_category)) {
        // Filter by key word
        if (isset($selected_key_word)) {
          // Filter by workexperience + studies + keyword
          $formerStudents = $this->getDoctrine()
            ->getRepository(CV::class)
            ->filter_WorkExperience_Studies_Keyword($query_cvs_ids, $selected_wrkexp_category, $selected_study_category, $selected_key_word);
        }
        else {
          // Filter by workexperience + studies
          $formerStudents = $this->getDoctrine()
            ->getRepository(CV::class)
            ->filter_WorkExperience_Studies($query_cvs_ids, $selected_wrkexp_category, $selected_study_category);
        }
      }
      else {
        // Filter by key word
        if (!empty($selected_key_word)) {
          // Filter by workexperience  + keyword
          $formerStudents = $this->getDoctrine()
            ->getRepository(CV::class)
            ->filter_WorkExperience_Keyword($query_cvs_ids, $selected_wrkexp_category, $selected_key_word);
        }
        else {
          // Filter by workexperience
          $formerStudents = $this->getDoctrine()
            ->getRepository(CV::class)
            ->filter_WorkExperience($query_cvs_ids, $selected_wrkexp_category);
        }
      }
    }
    else {
      if (isset($selected_study_category)) {
        // Filter by studies
        if (isset($selected_study_category)) {
          // Filter by key word
          if (!empty($selected_key_word)) {
            // Filter by studies + keyword
            $formerStudents = $this->getDoctrine()
              ->getRepository(CV::class)
              ->filter_Studies_Keyword($query_cvs_ids, $selected_study_category, $selected_key_word);
          }
          else {
            // Filter by studies
            $formerStudents = $this->getDoctrine()
              ->getRepository(CV::class)
              ->filter_Studies($query_cvs_ids, $selected_study_category);
          }
        }
      }
      else {
        // Filter by keyword
        $formerStudents = $this->getDoctrine()
          ->getRepository(CV::class)
          ->filter_Keyword($query_cvs_ids, $selected_key_word);
      }
    }

    return $formerStudents;
  }

}


