<?php

namespace App\Controller;

use App\Entity\UserMgr\Employer;
use App\Entity\UserMgr\Student;
use App\Entity\UserMgr\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods="post")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        // IMP! To get JSON format from POST method
        $data = $request->getContent();
        $content = json_decode($data);

        $username = $content->username;
        $password = $content->password;
        $type = $content->type;

        if($type === "student"){
            $user = new Student($username);
        }else{
            $user = new Employer($username);
        }
        $user->setPassword($encoder->encodePassword($user, $password));

        $em->persist($user);
        $em->flush();

        //return new Response(sprintf('User %s successfully created', $user->getUsername()));
        $expires_at = date('Y-m-d H:i:s', strtotime('+7200 seconds', time()));

        return new JsonResponse([
            'id_token' => $user->getPassword(),
            'expires_at' => $expires_at,
        ]);
    }
    /**
     * @Route("/role", name="role", methods="post")
     */
    public function role(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        // IMP! To get JSON format from POST method
        $data = $request->getContent();
        $content = json_decode($data);
        $username = $content->username;

        $db_user = $em->getRepository(User::class)->findOneBy([
            'username' => $username,
        ]);

        return new JsonResponse( $db_user->getRoles());
    }
}
