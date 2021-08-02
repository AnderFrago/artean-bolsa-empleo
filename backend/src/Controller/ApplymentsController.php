<?php

namespace App\Controller;

use App\Entity\OffersMgr\ApplymentsStates;
use App\Entity\CVsMgr\CV;
use App\Entity\OffersMgr\Applyments;
use App\Entity\OffersMgr\Offer;
use App\Entity\UserMgr\Employer;
use App\Entity\UserMgr\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplymentsController extends AbstractController
{
    /**
     * @Route("/api/v1/applyments/update-state",name="applyments_update_state")
     */
    public function updateState(Request $request){
        $data = $request->getContent();
        $content = json_decode($data);

        $id_offer = $content->offerId;
        $newstate = $content->newstate;
        $studentname = $content->studentname;

        $em = $this->getDoctrine()->getManager();

        $offer = $this->getDoctrine()->getRepository(Offer::class)->findOneBy([
            "id"=>$id_offer
        ]);
        $cv = $em->getRepository(CV::class)->findCVByUsername($studentname);

        $applys = $em->getRepository(Applyments::class)->findApplyOfferCV($offer, $cv);

        if(count($applys) == 1){
            $applys[0]->setState($newstate);
            $em->flush();
            return $this->json([
                "message" => "OK: state changed",
                "state" => $newstate
            ]);
        }
        return $this->json([
            "message" => "ERROR: no applyment found"
        ]);

    }


    /**
     * @Route("/api/v1/applyments/cvs-offer", name="applyments_cvs_offer")
     */
    public function cvsFromOfferApplyment(Request $request) {
        $data = $request->getContent();
        $content = json_decode($data);

        $username = $content->username;
        $id_offer = $content->id;

        $em = $this->getDoctrine()->getManager();

        $offer = $this->getDoctrine()->getRepository(Offer::class)->findOneBy([
            "id"=>$id_offer
        ]);

        if($offer !== null){
            // Get Applyments from offer
            $queryApplyments  = "select a
                               from App:OffersMgr\Applyments a
                               where a.offer = :offers";
            $query = $em->createQuery($queryApplyments);
            $query->setParameter('offers', $offer);
            $applyments =  $query->getResult();
            // Get CVs from Applyment
            $cv_ids=[];
            $cv_states=[];
            foreach ($applyments as $applyment){
                $cv_ids[] = $applyment->getCv()->getId();
                $cv_states[] = $applyment->getState();
            }
            // Load full CV information
            $queryCVs  = "select c
                            from App:CVsMgr\CV c
                            where c.id in (:cv_ids)";
            $query1 = $em->createQuery($queryCVs);
            $query1->setParameter('cv_ids', $cv_ids);
            $cvs = $query1->getResult();

            $data = [];
            //foreach($cvs as $item) {
            for ($cnt=0; $cnt < count($cvs); $cnt++){
                $student = $cvs[$cnt]->getStudent();

                $tmp = [
                    'id' => $cvs[$cnt]->getId(),
                    'originalName' => $cvs[$cnt]->getOriginalName(),
                    'file' => $cvs[$cnt]->getPathName(),
                    'username' => $student->getUsername(),
                    'state' => $cv_states[$cnt],
                ];
                $data[] = $tmp;
            }
            return $this->json([
                "message" => "OK: CVS found",
                "cvs"=> $data
            ], 200);
        }
        return $this->json([
            "message" => "ERROR: No offer found",
        ], 200);
    }

    /**
     * @Route("/api/v1/applyments/state", name="applyments_state", methods={"POST"})
     */
    public function stateApplayment(Request $request): Response
    {
        $data = $request->getContent();
        $content = json_decode($data);

        $username = $content->username;
        $id_offer = $content->id;

        $em = $this->getDoctrine();
        $cvs = $em->getRepository(CV::class)->findCVByUsername($username);

        $employer = $em->getRepository(Employer::class)->findOneBy([
            "username"=>$username
        ]);

        if($cvs != null ){
            // Las updated CV from user
            $cv = $cvs[count($cvs)-1];

            $offer = $em->getRepository(Offer::class)->findOneBy([
                "id" => $id_offer
            ]);

            $applys = $em->getRepository(Applyments::class)->findApplyOfferCV($offer, $cv);

            if($applys == null) {
                return $this->json([
                    'message' => 'OK: 0',
                ]);
            }
            // get state
            if(count($applys) == 1){
                $state = $applys[0]->getState();
            }
            /*   switch ($state) {
                   case ApplymentsStates::NoApplied:
                       $message = "Not applied";
                   case ApplymentsStates::Applied:
                       $message = "Applied";
                   case ApplymentsStates::Discard:
                       $message = "Discard";
                   case ApplymentsStates::Selected:
                       $message = "Selected";
                   case ApplymentsStates::WaitingResponse:
                       $message = "Waiting response";
               }*/
            return $this->json([
                'message' => "OK: $state",
            ]);
        }
        else if( $employer == null) {
            return $this->json([
                'message' => "ERROR: no CV for username"
            ]);
        } else {
            return $this->json([
                'message' => "OK: 6"
            ]);
        }

    }
}
