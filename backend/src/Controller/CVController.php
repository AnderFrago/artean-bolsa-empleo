<?php

namespace App\Controller;

use App\Entity\CVsMgr\CV;
use App\Entity\UserMgr\User;
use SplFileObject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
class CVController extends AbstractController
{
    /**
     * @Route("/cv-upload", name="cv", methods="post")
     */
    public function index(Request $request): Response
    {
        // How to get file upload without a form
        //https://stackoverflow.com/questions/18400216/how-to-get-file-upload-without-a-form
        $file = $request->files->get('cv');
        $username = $request->get('username');


        $filename = $file->getFilename();
        // Variables read from .env file to set location of PDF and TXT folders in the system
        $dir_pdf =  $_ENV['CV_PATH_PDF'];
        $dir_txt = $_ENV['CV_PATH_TXT'];
        $path_origin = "/tmp/$filename";
        $path_target = "$dir_pdf/$filename";
        $path_target_txt = "$dir_txt/$filename";
        // Execute shell from Symfony
        // https://symfony.com/doc/4.4/components/process.html
       // shell_exec("mv $path_origin $path_target");
        $process = new Process(['mv', "$path_origin", "$path_target"]);
        $process->run();
        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
       // $done =  $process->getOutput();
        $cv = new CV();
        $cv->setFileName($file->getFilename());
        $cv->setOriginalName($file->getClientOriginalName());
        $cv->setPathName($path_target);
        // Generate TXT file from PDF.
        //shell_exec("pdftotext $path_target $path_target_txt");
        $process = new Process(['pdftotext',  "$path_target", "$path_target_txt"]);
        $process->run();
        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
       // $done =  $process->getOutput();
        $cv->setTxtPath($path_target_txt);

        // Set TXT content to the DB Column
        $file = new SplFileObject($path_target_txt);
        $txt_content="";
        while(!$file->eof())
        {
            $txt_content .= $file->fgets()."<br/>";
        }
        $file = null;
        $cv->setTextcv($txt_content);


        $em = $this->getDoctrine()->getManager();
        // Relationship between CV and User
         $student = $em->getRepository(User::class)->findOneBy([
            'username' => $username
        ]);
        //$cv->setStudent($student);
        $student->addCV($cv);

        $em->persist($cv);
        $em->flush();

        return $this->json([
            'message' => 'OK: File correctly saved',
        ]);
    }
}
