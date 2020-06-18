<?php

namespace App\Controller;

use App\Entity\OfferMgr\Offers;
use App\Entity\UserMgr\Employeers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
      $offers = $this->getDoctrine()
        ->getRepository(Offers::class)
        ->findAllActive();

      return $this->render('default/index.html.twig', array(
        'offers' => $offers,
      ));
    }
}
