<?php namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    public function sendMail($to, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 
            $mail->isSMTP();                                      
            $mail->Host       = 'smtp.gmail.com';  
            $mail->SMTPAuth   = true;                               
            $mail->Username   = 'bertrandorouganni@gmail.com';                 
            $mail->Password   = 'lycgmtrknindjoid';                           
            $mail->SMTPSecure = 'tls';                            
            $mail->Port       = 587;                                   

            //Recipients
            $mail->setFrom('bertrandorouganni@gmail.com', 'Mailer');
            $mail->addAddress($to);              

            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
}
