<?php

namespace App\Controller;

use App\Entity\OffersMgr\Offer;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Annotation\Method;

class OffersController extends AbstractController
{
    /**
     * @Route("/offers", name="offer_insert", methods={"POST"})
     */
    public function insertOffer(Request $request): Response
    {
        $item = json_decode($request->getContent(), true);

        $offer = new Offer();
        $offer->setCompany( $item['company'] );
        try {
            $offer->setDueDate(new DateTime($item['dueDate']));
        } catch (\Exception $e) {
        }
        $offer->setPosition( $item['position'] );
        $offer->setDescription( $item['description'] );
        $offer->setMinimumRequirements( $item['requirements'] );
        $offer->setNumberOfApplyments(0);

        $em = $this->getDoctrine()->getManager();
        $em->persist($offer);
        $em->flush();
        return $this->json( $offer );
    }
    /**
     * @Route("/offers/{id}", name="offer_by_id")
     */
    public function offerById($id): Response
    {
        $item = $this->getDoctrine()->getRepository(Offer::class)->find($id);
        $offer = [
            'id' => $item->getId(),
            'company' => $item->getCompany(),
            'dueDate' => $item->getDueDate(),
            'position' => $item->getPosition(),
            'description' => $item->getDescription(),
            'minimumRequirements' => $item->getMinimumRequirements()
        ];
        return $this->json( $offer );
    }

    /**
     * @Route("/offers", name="offers", methods={"GET"})
     */
    public function index(): Response
    {
        $offers = $this->getDoctrine()->getRepository(Offer::class)->findAll();
        /*$offers = $this->getDoctrine()->getRepository(Offers::class)->findBy(
            [ 'dActivationDate' >  $yesterday],
            [ 'dDueDate' => 'ASC']
        );*/
        $data = [];
        foreach($offers as $item) {
            $tmp = [
                'id' => $item->getId(),
                'company' => $item->getCompany(),
                'dueDate' => $item->getDueDate(),
                'position' => $item->getPosition(),
                'description' => $item->getDescription(),
                'minimumRequirements' => $item->getMinimumRequirements()
            ];
            $data[] = $tmp;
        }
        return $this->json( $data );
    }
}
