<?php

namespace App\Controller;

use App\Entity\CVsMgr\CV;
use App\Entity\UserMgr\Artean;
use App\Entity\UserMgr\Employer;
use App\Entity\UserMgr\EmployerState;
use App\Entity\UserMgr\Student;
use App\Entity\UserMgr\StudentState;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


////////
// Both student and employer have two management methods,
// one in charge of retrieve all register pending of activation
// another which updates the state of a user by its username
////////
// The method create admin user is use to create a user in database of role ARTEAN,
// the username and password are stored in .env file.
////////
// The search method is used to filter the CVs in TXT format in the database table
// by a keyword.
////////

class ArteanController extends AbstractController
{

    /**
     * Method executed when a employer changes the state of an student in
     * a applyment.
     * @Route("/api/v1/artean/students-update-state",name="student_update_state")
     */
    public function updateStudentsState(Request $request){
        $data = $request->getContent();
        $content = json_decode($data);
        $newstate = $content->newstate;
        $studentname = $content->studentname;
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository(Student::class)->findOneBy([
            "username" => $studentname
        ]);
        if($newstate == 2) {
            $em->remove($student);
        } else {
            $student->setState($newstate);
        }
        $em->flush();

        return $this->json([
            "message" => "OK: state updated",
            "state" => $newstate
        ]);
    }

    /**
     * Retrieves all students that are not yet activated
     *
     * @Route("/api/v1/artean/students-pending-activation",name="students-pending-activation")
     */
    public function studentsPendingActivation(){
        $em = $this->getDoctrine()->getManager();
        $students = $em->getRepository(Student::class)->findBy([
            'state' => StudentState::WaitingValidation
        ]);
        $data = [];
        for ($cnt=0; $cnt < count($students); $cnt++){
            $username = $students[$cnt]->getUsername();
            $cvs = $em->getRepository(CV::class)->findCVByUsername($username);
            if(count($cvs) > 0){
                $cv = $cvs[count($cvs)-1];
                $originalName = $cv->getOriginalName();
            } else {
                $originalName ="No CV";
            }
            $tmp = [
                'username' => $username,
                'state' => $students[$cnt]->getState(),
                'cv' =>  $originalName ,
            ];
            $data[] = $tmp;
        }
        return $this->json([
            'students'=>$data
        ]);
    }
    /**
     * Retrieves all employers that are not yet activated
     *
     * @Route("/api/v1/artean/employers-pending-activation",name="employer-pending-activation")
     */
    public function employerPendingActivation(){
        $em = $this->getDoctrine()->getManager();
        $employers = $em->getRepository(Employer::class)->findBy([
            'state' => EmployerState::WaitingValidation
        ]);
        $data = [];
        for ($cnt=0; $cnt < count($employers); $cnt++){
            $username = $employers[$cnt]->getUsername();
            $tmp = [
                'username' => $username,
                'state' => $employers[$cnt]->getState(),
            ];
            $data[] = $tmp;
        }
        return $this->json([
            'employers'=>$data
        ]);
    }
    /**
     * @Route("/api/v1/artean/employers-update-state",name="employer_update_state")
     */
    public function updateEmployersState(Request $request){
        $data = $request->getContent();
        $content = json_decode($data);
        $newstate = $content->newstate;
        $employername = $content->employername;
        $em = $this->getDoctrine()->getManager();
        $employer = $em->getRepository(Employer::class)->findOneBy([
            "username" => $employername
        ]);
        if($newstate == 2) {
            $em->remove($employer);
        } else {
            $employer->setState($newstate);
        }
        $em->flush();
        return $this->json([
            "message" => "OK: state updated",
            "state" => $newstate
        ]);
    }

    /**
     * @Route("/api/v1/artean/search", name="artean")
     */
    public function index(Request $request): Response
    {
        $data = $request->getContent();
        $content = json_decode($data);
        $keyword = $content->keyword;

        $em = $this->getDoctrine()->getManager();

        $result = $em->getRepository(CV::class)->createQueryBuilder('cv')
            ->where('cv.textcv LIKE :keyword')
            ->setParameter('keyword', "%$keyword%" )
            ->getQuery()
            ->getResult();
        $cvs_names = [];
        foreach ($result as $item){
            $cvs_names[] = $item->getOriginalName();
        }
        return $this->json([
            'message' => 'OK: search',
            'cvs' => $cvs_names,

        ]);
    }
}
