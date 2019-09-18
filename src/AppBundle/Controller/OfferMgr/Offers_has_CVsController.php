<?php

namespace AppBundle\Controller\OfferMgr;

use AppBundle\Entity\CvMgr\CV;
use AppBundle\Entity\OfferMgr\Offers;
use AppBundle\Entity\OfferMgr\Offers_has_CVs;
use AppBundle\Entity\UserMgr\Employeers;
use AppBundle\Entity\UserMgr\FormerStudents;
use AppBundle\Entity\UserMgr\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("offers-has-cvs")
 */
class Offers_has_CVsController extends Controller {

  /**
   * Apply to an offer
   * @Route("apply/{id_offer}/{username}", name="apply_offer", requirements={"id_offer"="\d+"})
   */
  public function applyToOfferAction(Request $request, $id_offer, $username) {
    $em = $this->getDoctrine()->getManager();
    $offer_has_cv = new Offers_has_CVs();
    $offer_has_cv->setVStatus("PENDING");
    $offer = $em->getRepository(Offers::class)->find($id_offer);
    $offer_has_cv->setOffer($offer);

    // Get logged in user's CV by username
    $cv = $em->getRepository(CV::class)->findCVByFormerStudentUsername($username);
    // TODO REVISE just implemented one CV for user
    $offer_has_cv->setCv($cv[0]);

    $em->persist($offer_has_cv);
    $em->flush();
    return $this->redirectToRoute('homepage', ['request' => $request]);
  }

  /**
   * Update the state of an offer
   * @Route("update/{id_offer}/{status}", name="update_offer", requirements={"id_offer"="\d+"})
   */
  public function updateStateOfOfferAction(Request $request, $id_offer, $status) {

    $em = $this->getDoctrine()->getManager();
    $offer_has_cv = $em->getRepository(Offers_has_CVs::class)->find($id_offer);
    $offer_has_cv->setVStatus($status);

    $em->merge($offer_has_cv);
    $em->flush();
    return $this->redirectToRoute('homepage', ['request' => $request]);
  }

  /**
   * @Route("/show-applications/{username}", name="show_appliances")
   */
  public function showApplicationsAction(Request $request, $username) {
    $em = $this->getDoctrine()->getManager();
    // The CV from the register student
    $cvs = $em->getRepository(CV::class)->findCVByFormerStudentUsername($username);
    // The CV is related to many offers
    $offer_has_cv = $em->getRepository(Offers_has_CVs::class)->findBy(['cv'=>$cvs]);
    // TODO REVISE just first CV implemented
    return $this->render('offermgr/offers_has_CVs/applications.html.twig', array(
      'applications' => $offer_has_cv
    ));
  }

  /**
   * @Route("/show-candidates/{id}", name="show_candidates")
   */
  public function showCandidatesAction(Request $request, $id) {
    $em = $this->getDoctrine()->getManager();
    // Find appliances
    $offer_has_cv = $em->getRepository(Offers_has_CVs::class)->findOfferHasCVsByOfferId($id);
    // TODO REVISE just first CV implemented
    return $this->render('offermgr/offers_has_CVs/candidates.html.twig', array(
      'candidates' => $offer_has_cv
    ));
  }

  /**
   * Finds and displays a cV entity.
   *
   * @Route("/show-cvs/{offerid}/{username}", name="candidate_cv_show")
   * @Method("GET")
   */
  public function showAction($offerid, $username)
  {
    $em = $this->getDoctrine()->getManager();
    // Get the CV by getting the user from logged in username
    $formerStudent = $em->getRepository(FormerStudents::class)->findOneBy([ 'username' => $username  ]);
    $cvs= $formerStudent->getCVs();

    return $this->render('offermgr/offers_has_CVS/show_cv.html.twig', array(
      'cv' => $cvs[0],
      'offerid' => $offerid
    ));
  }
}
