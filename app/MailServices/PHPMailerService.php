<?php

namespace App\MailServices;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class PHPMailerService
{
    public function sendMail($to, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_FROM_ADDRESS', 'jagomununej@gmail.com');
            $mail->Password   = env('MAIL_APP_PASSWORD', 'amrpq lwlp jvap nwob');
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom(env('MAIL_FROM_ADDRESS'), 'Panitia');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = strip_tags($body);

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
        if (!$mail->send()) {
            throw new \Exception('Gagal mengirim email: ' . $mail->ErrorInfo);
        }

    }
}
