<?php

namespace AppBundle\Controller;

use AppBundle\Entity\OfferMgr\Offers;
use AppBundle\Entity\UserMgr\Employeers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
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
