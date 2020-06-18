<?php

namespace App\Controller\CvMgr;

use App\Entity\CvMgr\CV;
use App\Entity\UserMgr\FormerStudents;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * Cv controller.
 *
 * @Route("cv")
 */

class CVShowController extends AbstractController {

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
