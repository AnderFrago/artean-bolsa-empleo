<?php

namespace App\Controller\CvMgr;

use App\Entity\CvMgr\Otherknowledge;
use App\Entity\CvMgr\Studies;
use App\Entity\CvMgr\WorkExperiences;
use App\Entity\CvMgr\Languages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Cv controller.
 *
 * @Route("cv")
 */

class CVDeleteController extends AbstractController {

  /**
   * Deletes a work experience entity.
   * @Route("/{id}/{username}/workexperience_delete", name="stdnts_wrkexp_delete")
   */
  public function stdntsWorkExpDeleteAction(Request $request, $id, $username)
  {
    $em = $this->getDoctrine()->getManager();
    $wrkexperience =$em->getRepository(WorkExperiences::class)->find($id);
    $em->remove($wrkexperience);
    $em->flush();

    return $this->redirectToRoute('cv_show', [
      'username' => $username
    ]);
  }
  /**
   * Deletes a study entity.
   * @Route("/{id}/{username}/study_delete", name="stdnts_study_delete")
   */
  public function stdntsStudyDeleteAction(Request $request, $id, $username)
  {
    $em = $this->getDoctrine()->getManager();
    $studies =$em->getRepository(Studies::class)->find($id);
    $em->remove($studies);
    $em->flush();

    return $this->redirectToRoute('formerstudents_edit', [
      'username' => $username
    ]);
  }

  /**
   * Deletes a language entity.
   * @Route("/{id}/{username}//language_delete", name="stdnts_languages_delete")
   */
  public function stdntsLanguageDeleteAction(Request $request, $id, $username)
  {
    $em = $this->getDoctrine()->getManager();
    $language =$em->getRepository(Languages::class)->find($id);
    $em->remove($language);
    $em->flush();

    return $this->redirectToRoute('formerstudents_edit', [
      'username' => $username
    ]);
  }

  /**
   * Deletes a language entity.
   * @Route("/{id}/{username}/otherknowlede_delete", name="stdnts_otherknowlede_delete")
   */
  public function stdntsOtherknowledgeDeleteAction(Request $request, $id, $username)
  {
    $em = $this->getDoctrine()->getManager();
    $otherKnowledge =$em->getRepository(Otherknowledge::class)->find($id);
    $em->remove($otherKnowledge);
    $em->flush();

    return $this->redirectToRoute('formerstudents_edit', [
      'username' => $username
    ]);
  }


}
