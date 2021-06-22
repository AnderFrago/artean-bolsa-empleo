<?php

namespace App\Controller;

use App\Entity\OffersMgr\Offers;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class OffersController extends AbstractController
{
    /**
     * @Route("/offers", name="offers")
     */
    public function index(): Response
    {

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $yesterday = new DateTime('yesterday');
        // echo $yesterday->format('Y-m-d');
        $offers = $this->getDoctrine()->getRepository(Offers::class)->findAll();
        /*$offers = $this->getDoctrine()->getRepository(Offers::class)->findBy(
            [ 'dActivationDate' >  $yesterday],
            [ 'dDueDate' => 'ASC']
        );*/

        $json_offers = $serializer->serialize($offers, 'json');

        return $this->json([
            'message' => 'Ofertas de empleo en Cuatrovientos ITC!',
            'offers' => $json_offers,
        ]);
    }
}
