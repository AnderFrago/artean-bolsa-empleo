<?php

namespace AppBundle\Controller\OfferMgr;

use AppBundle\Entity\OfferMgr\Offers;
use AppBundle\Entity\UserMgr\Employeers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("offers")
 */
class OffersController extends Controller {

  /**
   * Lists all offer entities from logged in Employeer
   * @Route("/", name="offers_index")
   * @Method("GET")
   */
  public function indexAction(Request $request) {
    $em = $this->getDoctrine()->getManager();
    // Get all the offers published by the logged employer
    $loggedin_username = is_null($request->getSession()->get(Security::LAST_USERNAME))? $request->getSession()->get('username') : $request->getSession()->get(Security::LAST_USERNAME)  ;
    $offers = $em->getRepository('AppBundle:OfferMgr\Offers')
      ->findOffersFromEmployeer($loggedin_username);

    return $this->render('offermgr/offers/index.html.twig', [
      'offers' => $offers,
    ]);
  }

  /**
   * Creates a new offer entity.
   * @Route("/new", name="offers_new")
   * @Method({"GET", "POST"})
   */
  public function newAction(Request $request) {
    $offer = new Offers();
    $form = $this->createForm('AppBundle\Form\OfferMgr\OffersType', $offer);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();

      // casting birth date from string in jq selector to php DateTime
      $activationdate = $offer->getDActivationDate();
      $offer->setDActivationDate(new \DateTime($activationdate));
      $duedate = $offer->getDDueDate();
      $offer->setDDueDate(new \DateTime($duedate));

      // Add database offer table's audit values
      $loggedin_username = is_null($request->getSession()->get(Security::LAST_USERNAME))? $request->getSession()->get('username') : $request->getSession()->get(Security::LAST_USERNAME)  ;

      $offer->setCreationUser($loggedin_username);
      $offer->setCreationDate(new \DateTime());
      $offer->setModificationUser($loggedin_username);
      $offer->setModificationDate(new \DateTime());
      // Set current employer user as owner of the offer
      $employeer =$this->getDoctrine()->getManager()->getRepository(Employeers::class)->findOneBy( ['username' => $loggedin_username] );
      $offer->setEmployeer($employeer);

      $em->persist($offer);
      $em->flush();
      return $this->redirectToRoute('offers_show', ['id' => $offer->getId()]);
    }
    return $this->render('offermgr/offers/new.html.twig', [
      'offer' => $offer,
      'form' => $form->createView(),
    ]);
  }

  /**
   * Finds and displays a offer entity.
   * @Route("/{id}", name="offers_show")
   * @Method("GET")
   */
  public function showAction(Request $request, Offers $offer) {
    $deleteForm = $this->createDeleteForm($offer);
    // Getting the owner of the offer to avoid editing by other users
    $owner = $this->getDoctrine()->getManager()->getRepository(Offers::class)->findOwnerById($offer->getId());
    // If the offer has no Id, the user is creating $loggedin_user
    if(empty($owner))
    {
      // Set as an object in an array to simulate an object of Employeers
      // (For a correct use in TWIG conditional)
      $owner[]= ['username' => $request->getSession()->get('username') ]  ;
    }
    return $this->render('offermgr/offers/show.html.twig', [
      'offer' => $offer,
      'owner' => $owner,
      'delete_form' => $deleteForm->createView(),
    ]);
  }

  /**
   * Displays a form to edit an existing offer entity.
   * @Route("/{id}/edit", name="offers_edit")
   * @Method({"GET", "POST"})
   */
  public function editAction(Request $request, Offers $offer) {
    $deleteForm = $this->createDeleteForm($offer);
    // Casting date to string format to show them in the form
    $offer->setDActivationDate($offer->getDActivationDate()->format('Y/m/d'));
    $offer->setDDueDate($offer->getDDueDate()->format('Y/m/d'));

    $editForm = $this->createForm('AppBundle\Form\OfferMgr\OffersType', $offer);
    $editForm->handleRequest($request);

    if ($editForm->isSubmitted() && $editForm->isValid()) {
      // Casting date to string format to show them in the form
      $offer->setDActivationDate(new \DateTime($offer->getDActivationDate()));
      $offer->setDDueDate(new \DateTime($offer->getDDueDate()));

      $this->getDoctrine()->getManager()->flush();
      return $this->redirectToRoute('offers_show', ['id' => $offer->getId()]);
    }

    return $this->render('offermgr/offers/edit.html.twig', [
      'offer' => $offer,
      'edit_form' => $editForm->createView(),
      'delete_form' => $deleteForm->createView(),
    ]);
  }

  /**
   * Deletes a offer entity.
   * @Route("/{id}/delete", name="offers_delete")
   * @Method("DELETE")
   */
  public function deleteAction(Request $request, Offers $offer) {
    $form = $this->createDeleteForm($offer);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($offer);
      $em->flush();
    }
    return $this->redirectToRoute('offers_index');
  }

  /**
   * Creates a form to delete a offer entity.
   * @param Offers $offer The offer entity
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm(Offers $offer) {
    return $this->createFormBuilder()
      ->setAction($this->generateUrl('offers_delete', ['id' => $offer->getId()]))
      ->setMethod('DELETE')
      ->getForm();
  }
}
