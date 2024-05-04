<?php 
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;

require_once('vendor/autoload.php');
require_once("phpMailer/Exception.php");
require_once("phpMailer/PHPMailer.php");
require_once("phpMailer/SMTP.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mail = new PHPMailer(true);
$alert = '';

if(!empty($_POST["nom_prenom"])&&!empty($_POST["email"])&&!empty($_POST["objet"])&&!empty($_POST["message"])){
    $name = $_POST["nom_prenom"];
    $email = $_POST["email"];
    $subject = $_POST["objet"];
    $message = $_POST["message"];

    try{
        $mail->isSMTP();
        $mail->Host = $_ENV['MAIL_FINAB_HOST_RECEIVED'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_FINAB'];
        $mail->Password = $_ENV['MAIL_FINAB_PASSWORD'];
        $mail->SMTPSecure = "ssl";
        $mail->Port = "465";

        $mail->setFrom($_ENV['MAIL_FINAB']);
        $mail->addAddress($_ENV['MAIL_FINAB']);

        $mail->isHTML(true);
        $mail->Subject = "FINAB CONTACT";
        $mail->CharSet = "UTF-8";
        $mail->Body = '
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="utf-8">
                </head>
                <body>
                    <div>
                        <strong>Nom/Prénoms/Institution</strong>: '.$name.' <br>
                        <strong>Email</strong>: '.$email.' <br>
                        <strong>Objet</strong>: '.$subject.' <br>
                        <strong>Message</strong>: '.$message.'
                    </div>
                </body>
            </html>';
        $mail->send();
        
        echo "Votre message a été envoyé avec succès.";
        header('Location: index.php');
        exit();
    } catch (Exception $err){
        echo "Erreur lors de l'envoi du message. Veuillez réessayer. (<a href='contact.php'>CLIQUER ICI POUR RÉESSAYER)";
    }
}

?>