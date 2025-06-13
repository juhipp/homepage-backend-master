<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\PHPMailer;

class MailService
{
    public function phpmailer(string $to, string $subject, string $message)
    {
        $from = 'mailer@fjol-digital.de';
        $user = $from;
        $password = 'eHr)K7/e@JZ62!E';
        
        $mail = new PHPMailer();

        try {
            // Settings
            $mail->IsSMTP();
            $mail->CharSet = 'UTF-8';

            $mail->Host       = 'smtp.ionos.de';
            $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Port       = 465;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  
            $mail->Username   = $user;            // SMTP account username example
            $mail->Password   = $password;            // SMTP account password example

            foreach(explode(',', $to) as $t) {
                $mail->addAddress($t);     //Add a recipient
            }

            // Content
            $mail->isHTML(true);                       // Set email format to HTML
            $mail->From = $from;
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            if (!$mail->send()) Log::error("Message could not be sent. Mailer Error: {$mail->ErrorInfo}; ".print_r($mail, true));
        } catch (Exception $e) {
            Log::error("Message could not be sent. Mailer Error: {$mail->ErrorInfo}; ".print_r($mail, true).print_r($e, true));
        }
    }
}