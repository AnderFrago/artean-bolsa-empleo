<?php

namespace App\Controller;

use App\Entity\OffersMgr\Offers;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffersController extends AbstractController
{
    /**
     * @Route("/offers", name="offers")
     */
    public function index(): Response
    {

        //$yesterday = new DateTime('yesterday');
        $offers = $this->getDoctrine()->getRepository(Offers::class)->findAll();
        /*$offers = $this->getDoctrine()->getRepository(Offers::class)->findBy(
            [ 'dActivationDate' >  $yesterday],
            [ 'dDueDate' => 'ASC']
        );*/

        $data = [];
        foreach($offers as $item) {
            $tmp = [
                'id' => $item->getId(),
                'name' => $item->getOfferCode(),
                'dueDate' => $item->getDueDate(),
                'position' => $item->getPosition(),
                'description' => [
                    'text' => $item->getDescription(),
                    'category' => $item->getOfferType(),
                    'level' => $item->getOfferType(),
                ],
                'requirements' => [
                   'minimumRequirements' => $item->getExperienceRequirements()
                ],
            ];
            $data[] = $tmp;
        }


        return $this->json( $data );
    }
}
