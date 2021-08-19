<?php

namespace App\Controller;

use App\Entity\UserMgr\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
# 👇 Agregamos las referencias.
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;

class MailerController extends AbstractController
{
    /**
     * @Route("/api/v1/email/pending-validation", name="mail-pending-validation", methods={"POST"})
     */
    public function sendEmailPendingValidation(Request $request, MailerInterface $mailer): Response
    {
        $data = $request->getContent();
        $content = json_decode($data);
        $username = $content->username;
        $user = $this->getDoctrine()->getRepository(Student::class)->findOneBy([
            "username" => $username
        ]);
        $user_email = $user->getEmail();

        $email = (new Email())
            ->from(new Address('ander_frago@cuatrovientos.org', 'Ander F.L.'))
            ->to($user_email)
            ->subject('Pendiente de validación')
            ->text('La cuenta está pendiente de validación.')
            ->html('<p>Cuando el administrador active su cuenta será notificado.</p>');

        try {
            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            echo $e;
        }
        return $this->json([
            'message' => 'OK: Email send',
        ]);
    }
    /**
     * @Route("/api/v1/email/account-validated", name="mail-account-validated", methods={"POST"})
     */
    public function sendEmailAccountValidated(Request $request,MailerInterface $mailer): Response
    {
        $data = $request->getContent();
        $content = json_decode($data);
        $username = $content->username;

        $user = $this->getDoctrine()->getRepository(Student::class)->findOneBy([
            "username" => $username
        ]);
        $user_email = $user->getEmail();

        $email = (new Email())
            ->from(new Address('ander_frago@cuatrovientos.org', 'Ander F.L.'))
            ->to($user_email)
            ->subject('Cuenta validada')
            ->text('La cuenta ha sido validada por el administrador')
            ->html('<p>Puedes acceder a la bolsa de empleo.</p>');

        try {
            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            echo $e;
        }
        return $this->json([
            'message' => 'OK: Email send',
        ]);
    }

    /**
     * @Route("/api/v1/email/status-changed", name="mail-status-changed", methods={"POST"})
     */
    public function sendEmailStatusChanged(Request $request,MailerInterface $mailer): Response
    {
        $data = $request->getContent();
        $content = json_decode($data);
        $username = $content->username;

        $user = $this->getDoctrine()->getRepository(Student::class)->findOneBy([
            "username" => $username
        ]);
        $user_email = $user->getEmail();

        $email = (new Email())
            ->from(new Address('ander_frago@cuatrovientos.org', 'Ander F.L.'))
            ->to($user_email)
            ->subject('Cambio de estado')
            ->text('Cambio de estado en oferta de empleo')
            ->html('<p>Accede a la plataforma para visualizar tu nueva situación.</p>');

        try {
            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            echo $e;
        }
        return $this->json([
            'message' => 'OK: Email send',
        ]);
    }
}
