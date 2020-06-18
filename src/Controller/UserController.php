<?php

namespace App\Controller;

use App\Entity\UserMgr\User;
use App\Form\UserMgr\EmployeersType;
use App\Entity\UserMgr\Employeers;
use App\Form\UserRegistrationForm;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class UserController extends AbstractController
{
    // @Version Symfony 4.4 https://symfony.com/doc/4.4/security/guard_authentication.html
    private $authenticator;
    private $guardHandler;
    public function __construct(LoginFormAuthenticator $authenticator, GuardAuthenticatorHandler $guardHandler) {
        $this->authenticator = $authenticator;
        $this->guardHandler = $guardHandler;
    }
  /**
   * @Route("/register", name="user_register")
   */
  public function registerAction(Request $request, UserPasswordEncoderInterface $encoder) {
    $user_form = new UserRegistrationForm();
    $form = $this->createForm(UserRegistrationForm::class);

    $form->handleRequest($request);
    //if ($form->isValid() ) {
     if ($form->isSubmitted() && $form->isValid()) {
            // Values of the User object shared by FormerStudents and Employeers
      $user_form = $form->getData();

      // Save access values in session
      $session = $request->getSession();
      $session->set('username', $user_form->getUsername());
      $session->set('email', $user_form->getEmail());

      $plainPassword = $user_form->getPassword();
      $encoded = $encoder->encodePassword($user_form, $plainPassword);
      $session->set('password', $encoded);

      // Check user type
      if (in_array("ROLE_USER_FORMER_STUDENT", $user_form->getRoles())) {
        // Show cv creation form
        return $this->redirectToRoute('formerstudents_new', ['request' => $request]);
      }
      else {
        if (in_array("ROLE_USER_EMPLOYEER", $user_form->getRoles())) {
          // Show employee creation form
          return $this->redirectToRoute('employeers_new', ['request' => $request]);
        }
      }
         /**
          * @Version Symfony 3.4
      return $this->get('security.authentication.guard_handler')
        ->authenticateUserAndHandleSuccess(
          $user_form,
          $request,
          $this->get('app.security.login_form_authenticator'),
          'main'
        );
        */
         return $this->guardHandler->authenticateUserAndHandleSuccess(
             $user_form,
             $request,
             $this->authenticator,
             'main'
         );
    }
    return $this->render('usermgr/register.html.twig', [
      'form' => $form->createView(),
    ]);
  }
}
