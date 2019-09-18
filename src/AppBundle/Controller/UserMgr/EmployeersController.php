<?php

namespace AppBundle\Controller\UserMgr;

use AppBundle\Entity\UserMgr\User;
use AppBundle\Entity\UserMgr\Employeers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\UserRegistrationForm;

/**
 * Employeer controller.
 *
 * @Route("employeers")
 */
class EmployeersController extends Controller
{
    /**
     * Lists all employeer entities.
     *
     * @Route("/", name="employeers_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $employeers = $em->getRepository('AppBundle:UserMgr\Employeers')->findAll();

        return $this->render('usermgr/employeers/index.html.twig', array(
            'employeers' => $employeers,
        ));
    }

    /**
     * Creates a new employeer entity.
     *
     * @Route("/new", name="employeers_new")
     */
    public function newAction(Request $request)
    {
        $employeer = new Employeers();

      $form = $this->createForm('AppBundle\Form\UserMgr\EmployeersType', $employeer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // Set values for the access in user table
            $session = $request->getSession();
            $employeer->setUsername($session->get("username"));
            $employeer->setPassword($session->get("password"));
            $employeer->setEmail($session->get("email"));

            // Set database audit values
            $employeer->setCreationUser($employeer->getUsername());
            $employeer->setCreationDate(new \DateTime());
            $employeer->setModificationUser($employeer->getUsername());
            $employeer->setModificationDate(new \DateTime());

            $em->persist($employeer);
            $em->flush();

          return $this->get('security.authentication.guard_handler')
            ->authenticateUserAndHandleSuccess(
              $employeer,
              $request,
              $this->get('app.security.login_form_authenticator'),
              'main'
            );
        }

        return $this->render('usermgr/employeers/new.html.twig', array(
            'employeer' => $employeer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a employeer entity.
     *
     * @Route("/{id}", name="employeers_show")
     * @Method("GET")
     */
    public function showAction(Employeers $employeer)
    {
        $deleteForm = $this->createDeleteForm($employeer);

        return $this->render('usermgr/employeers/show.html.twig', array(
            'employeer' => $employeer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing employeer entity.
     *
     * @Route("/{id}/edit", name="employeers_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Employeers $employeer)
    {
        $deleteForm = $this->createDeleteForm($employeer);
        $editForm = $this->createForm('AppBundle\Form\UserMgr\EmployeersType', $employeer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usermgr_employeers_edit', array('id' => $employeer->getId()));
        }

        return $this->render('usermgr/employeers/edit.html.twig', array(
            'employeer' => $employeer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a employeer entity.
     *
     * @Route("/{id}", name="usermgr_employeers_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Employeers $employeer)
    {
        $form = $this->createDeleteForm($employeer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($employeer);
            $em->flush();
        }

        return $this->redirectToRoute('employeers_index');
    }

    /**
     * Creates a form to delete a employeer entity.
     *
     * @param Employeers $employeer The employeer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Employeers $employeer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usermgr_employeers_delete', array('id' => $employeer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
