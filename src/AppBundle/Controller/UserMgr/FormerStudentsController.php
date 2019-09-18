<?php

namespace AppBundle\Controller\UserMgr;

use AppBundle\Entity\CvMgr\CV;
use AppBundle\Entity\CvMgr\CVCategories;
use AppBundle\Entity\UserMgr\FormerStudents;
use AppBundle\Form\UserMgr\FormerStudentsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Formerstudent controller.
 *
 * @Route("user")
 */
class FormerStudentsController extends Controller
{
    /**
     * Lists all formerStudent entities.
     *
     * @Route("/", name="formerstudents_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formerStudents = $em->getRepository('AppBundle:UserMgr\FormerStudents')->findAll();

        return $this->render('usermgr/formerstudents/index.html.twig', array(
            'formerStudents' => $formerStudents,
        ));
    }

    /**
     * Creates a new formerStudent entity.
     *
     * @Route("/new", name="formerstudents_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $formerStudent = new FormerStudents();
        $form = $this->createForm('AppBundle\Form\UserMgr\FormerStudentsType', $formerStudent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();

          // Set values for the access in user table
          $session = $request->getSession();
          $formerStudent->setUsername($session->get("username"));
          $formerStudent->setPassword($session->get("password"));
          $formerStudent->setEmail($session->get("email"));
          // casting birth date from string in jq selector to php DateTime
          $birthdate = $formerStudent->getDBirthDate();
          $formerStudent->setDBirthDate(new \DateTime($birthdate));

          // Set database audit values
          $formerStudent->setCreationUser($formerStudent->getUsername());
          $formerStudent->setCreationDate(new \DateTime());
          $formerStudent->setModificationUser($formerStudent->getUsername());
          $formerStudent->setModificationDate(new \DateTime());


          $em->persist($formerStudent);
          $em->flush();

          // Is necessary to save de formerStudent for a later redirect when the CV creation wizard finished
          $session->set('formerStudentID',$formerStudent->getId());
          //CV Creation wizard
          return $this->redirectToRoute('cvs_new', ['request' => $request]);
        }

        return $this->render('usermgr/formerstudents/new.html.twig', array(
            'formerStudent' => $formerStudent,
            'form' => $form->createView(),
        ));
    }

  /**
   * Finds and displays a formerStudent entity.
   *
   * @Route("/{username}", name="formerstudents_show")
   */
  public function showAction($username)
  {
    $em = $this->getDoctrine()->getManager();
    // Get the CV by getting the user from logged in username
    $cvs = $em->getRepository(CV::class)->findCVByFormerStudentUsername($username);

    $formerStudent = $em->getRepository(FormerStudents::class)->findOneBy([ 'username' => $username  ]);

    return $this->render('usermgr/formerstudents/show.html.twig', array(
      'formerStudent' => $formerStudent,
      'cvs' => $cvs
    ));
  }

  /**
   * Displays a form to edit an existing formerStudent entity.
   * @Route("/{username}/edit/", name="formerstudents_edit")
   * @Method({"GET", "POST"})
   */
  public function editAction(Request $request, $username)
  {
    $em = $this->getDoctrine()->getManager();
    $formerStudent = $em->getRepository(FormerStudents::class)->findOneBy([ 'username' => $username ]);

    $editForm = $this->createForm('AppBundle\Form\UserMgr\FormerStudentsType', $formerStudent);
    $editForm->handleRequest($request);

    // We must find every CV of this FormedStudent and generate the view
    $cvs = $em->getRepository(CV::class)->findCVByFormerStudentUsername($formerStudent->getUsername());

    if ($editForm->isSubmitted() && $editForm->isValid()) {
      $this->getDoctrine()->getManager()->flush();

      return $this->redirectToRoute('formerstudents_edit', array(
        'id' => $formerStudent->getId()
      ));
    }

    // TODO REVISE just developed for one CV for user
    $wrkExperiences = $cvs[0]->getWorkexperiences();
    // Get position from last added experinece
    $vPosition = $wrkExperiences[count($wrkExperiences)-1]->getVPosition();
    // If the last position is "to complete" it is a new added position from editing page
    // a fixed list of values mus be returned for user selecion
    if($vPosition == 'to complete'){
      // When creation some values are fixed for example the position of employments
      // Getting the position from CVCategories Configuration entity
      $positions_list = $em->getRepository(CVCategories::class)->getWorExperiencesPositions();
      // Store position list in session variable
      $session = $request->getSession();
      $session->set('positions_list',$positions_list);
      $cvs[0]->getWorkexperienceByIndex(count($wrkExperiences)-1)->setVPosition($positions_list);
    }


    return $this->render('usermgr/formerstudents/edit.html.twig', array(
      'cvs' => $cvs,
      'formerStudent' => $formerStudent,
      'edit_form' => $editForm->createView()
    ));
  }

  /**
   * Deletes a formerStudent entity.
   *
   * @Route("/{id}", name="formerstudents_delete")
   * @Method("DELETE")
   */
  public function deleteAction(Request $request, $id)
  {
    $em = $this->getDoctrine()->getManager();
    $formerStudent = $em->getRepository(FormerStudents::class)->find($id);

    $form = $this->createDeleteForm($formerStudent);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->remove($formerStudent);
      $em->flush();
    }

    return $this->redirectToRoute('formerstudents_index');
  }

  /**
   * Creates a form to delete a formerStudent entity.
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDeleteForm(FormerStudents $formerStudent)
  {
    return $this->createFormBuilder()
      ->setAction($this->generateUrl('formerstudents_delete', array('id' => $formerStudent->getId())))
      ->setMethod('DELETE')
      ->getForm()
      ;
  }

}
