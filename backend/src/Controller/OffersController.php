<?php

namespace App\Controller;

use App\Entity\OffersMgr\ApplymentsStates;
use App\Entity\CVsMgr\CV;
use App\Entity\OffersMgr\Applyments;
use App\Entity\OffersMgr\Offer;
use App\Entity\UserMgr\Employer;
use App\Entity\UserMgr\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Annotation\Method;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class OffersController extends AbstractController
{


    /**
     * @Route("/offers/load-offer", name="applyments_load_offer")
     */
    public function loadOffer(Request $request) {
        $data = $request->getContent();
        $content = json_decode($data);

        $username = $content->username;
        $fileName = $content->fileName;

        $offer = $this->getDoctrine()->getManager()->getRepository(Offer::class)->findOneBy([
            "originalName" => $fileName
        ]);
        $pdfPath = $offer->getFilePath();


        return $this->json([
            "message" => "OK: pdf loaded",
            "file" => $this->file($pdfPath)
        ], 200);
    }

    /**
     * @Route("/p/offers/apply", name="offer_apply", methods={"POST"})
     */
    public function applyToOffer( Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $data = $request->getContent();
        $content = json_decode($data);
        $username = $content->username;
        $id = $content->id;

        // Verify is not applied already
        $offer = $em->getRepository(Offer::class)->findOneBy([
            "id" => $id
        ]);
        $cvs = $em->getRepository(CV::class)->findCVByUsername($username);
        $cv = $cvs[count($cvs)-1];

        $apply = $em->getRepository(Applyments::class)->findApplyOfferCV($offer, $cv);

        if($apply == null) {
            $apply = new Applyments();
            $apply->setOffer($offer);

            $apply->setCv($cv);

            $apply->setState(ApplymentsStates::Applied);

            $em->persist($apply);
            $em->flush();

            return $this->json( [
                'message' => 'OK: 1',

            ], 200);
        }
        return $this->json( [
            "message"=> "CANCEL: Already applied"
        ], 200, [], [
            'groups' => ['offer'],
        ]);
    }




    /**
     * @Route("/offers/{id}", name="offer_delete", methods={"DELETE"})
     */
    public function deleteOffer($id, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $offer = $this->getDoctrine()
            ->getRepository(Offer::class)
            ->find($id);
        $em->remove($offer);
        $em->flush();
        return $this->json( $offer, 200, [], [
            'groups' => ['offer'],
        ]);
    }
    /**
     * @Route("/offers/{id}", name="offer_update", methods={"PUT"})
     */
    public function updateOffer($id, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        $offer = $this->getDoctrine()
            ->getRepository(Offer::class)
            ->find($id);
        $em->remove($offer);

        $item = json_decode($request->getContent(), true);
        $offer->setCompany( $item['company'] );
        try {
            $offer->setDueDate(new DateTime($item['dueDate']));
        } catch (\Exception $e) {
        }
        $offer->setPosition( $item['position'] );
        $offer->setDescription( $item['description'] );
        $offer->setMinimumRequirements( $item['requirements'] );
        $offer->setNumberOfApplyments(0);
        $offer->setOriginalName($item['originalFileName'])

        $em->persist($offer);
        $em->flush();

        return $this->json( $offer, 200, [], [
            'groups' => ['offer'],
        ]);
    }

    /**
     * @Route("/offers/offer-upload", name="offer_upload", methods={"POST", "PUT"})
     */
    public function offerUpload(Request $request){
        $file = $request->files->get('cv');
        $filename = $file->getFilename();
        $originalfilename = $file->getClientOriginalName();
        $dir_pdf =  $_ENV['OFFER_PATH_PDF'];
        $path_origin = "/tmp/$filename";
        $path_target = "$dir_pdf/$filename";
        // shell_exec("mv $path_origin $path_target");
        $process = new Process(['mv', "$path_origin", "$path_target"]);
        $process->run();
        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $offer = $this->getDoctrine()->getRepository(Offer::class)
            ->findOneBy([
                "originalName" => $originalfilename
            ]);

        $offer->setFileNam($file->getFilename());
        $offer->setOriginalName($file->getClientOriginalName());
        $offer->setFilePath($path_target);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->json([
            'message' => 'OK: File correctly saved',
        ]);
    }

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
        // Empty until file is loaded
        $offer->setOriginalName($item['originalFileName']);
        $offer->setFileNam("nofile");
        $offer->setFilePath("nofile");


        $employer_username= $item['owner'];
        $employer = $this->getDoctrine()->getRepository(Employer::class)->findOneBy([
            "username" =>$employer_username
        ]);

        $offer->setEmployer($employer);
        $em = $this->getDoctrine()->getManager();
        $em->persist($offer);
        $em->flush();

        $offer_readable = [
            'id' => $offer->getId(),
            'company' => $offer->getCompany(),
            'dueDate' => $offer->getDueDate(),
            'position' => $offer->getPosition(),
            'description' => $offer->getDescription(),
            'minimumRequirements' => $offer->getMinimumRequirements()
        ];
        return $this->json( [
            "message" => "OK: File saved without PDF",
            "offer" => $offer_readable
        ]);
    }
    /**
     * @Route("/p/offers/{id}", name="offer_by_id_from_owner", methods={"POST"}, requirements={"id"="\d+"}))
     */
    public function offerByIdFromOwner($id, Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $data = $request->getContent();
        $content = json_decode($data);
        $username = $content->username;

        $offer = $this->getDoctrine()
            ->getRepository(Offer::class)
            ->findByIdFromOwner($id,$username);

        if(count($offer) > 0 ){
            return $this->json( [
                "message" => "OK: owner",
                "offer" => $offer[0]
            ]);
        } else {
            $tmp = $this->getDoctrine()->getRepository(Offer::class)->find([
                'id' => $id
            ]);
            $offer_readable = [
                'id' => $tmp->getId(),
                'company' => $tmp->getCompany(),
                'dueDate' => $tmp->getDueDate(),
                'position' => $tmp->getPosition(),
                'description' => $tmp->getDescription(),
                'minimum_requirements' => $tmp->getMinimumRequirements(),
                'original_name' => $tmp->getOriginalName()
            ];

            return $this->json([
                "message" => "OK: reader",
                "offer" =>  $offer_readable
            ]);
        }

        return $this->json( [
            "message" => "ERROR: Not value found"
        ] );;
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
