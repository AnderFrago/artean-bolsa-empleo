<?php

namespace AppBundle\Controller\CvMgr;

use AppBundle\Entity\CvMgr\CV;
use AppBundle\Entity\UserMgr\FormerStudents;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Cv controller.
 *
 * @Route("cv")
 */

class CVShowController extends Controller {

  /**
   * Finds and displays a cV entity.
   *
   * @Route("/{username}", name="cv_show")
   */
  public function showAction($username)
  {
    $em = $this->getDoctrine()->getManager();
    // Get the CV by getting the user from logged in username
    $formerStudent = $em->getRepository(FormerStudents::class)->findOneBy([ 'username' => $username  ]);
    $cvs= $formerStudent->getCVs();

    return $this->render('cvmgr/show.html.twig', ['cv' => $cvs]);
  }

}
