<?php 
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;

require_once('vendor/autoload.php');
require_once("phpMailer/Exception.php");
require_once("phpMailer/PHPMailer.php");
require_once("phpMailer/SMTP.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mailReceived = new PHPMailer(true);
$mailSender = new PHPMailer(true);
$alert = '';

if(!empty($_POST["email"])){
    $email = $_POST["email"];

    try{
        $mailReceived->isSMTP();
        $mailReceived->Host = $_ENV['MAIL_FINAB_HOST_RECEIVED'];
        $mailReceived->SMTPAuth = true;
        $mailReceived->Username = $_ENV['MAIL_FINAB'];
        $mailReceived->Password = $_ENV['MAIL_FINAB_PASSWORD'];
        $mailReceived->SMTPSecure = "ssl";
        $mailReceived->Port = "465";
        $mailReceived->setFrom($_ENV['MAIL_FINAB']);
        $mailReceived->addAddress($_ENV['MAIL_FINAB']);

        $mailSender->isSMTP();
        $mailSender->Host = $_ENV['MAIL_FINAB_HOST_SEND'];
        $mailSender->SMTPAuth = true;
        $mailSender->Username = $_ENV['MAIL_FINAB'];
        $mailSender->Password = $_ENV['MAIL_FINAB_PASSWORD'];
        $mailSender->SMTPSecure = "ssl";
        $mailSender->Port = "465";
        $mailSender->setFrom($_ENV['MAIL_FINAB']);
        $mailSender->addAddress($email);

        $mailReceived->isHTML(true);
        $mailReceived->Subject = "Abonnement au newsletter Finab";
        $mailReceived->CharSet = "UTF-8";
        $mailReceived->Body = '
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="utf-8">
                </head>
                <body>
                    <div>
                        Le mail:<< <strong>'.$email.'</strong> >> vient de s\'inscrire au NewsLetter du Finab.
                    </div>
                </body>
            </html>';
        $mailReceived->send();

        $mailSender->isHTML(true);
        $mailSender->Subject = "Abonnement au newsletter Finab";
        $mailSender->CharSet = "UTF-8";
        $mailSender->Body = '
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="utf-8">
                </head>
                <body>
                    <div>
                        Abonnement au NewsLetter effectué avec SUCCÈS .
                    </div>
                </body>
            </html>';
        $mailSender->send();
        
        header('Location: index.php');
        exit();
    } catch (Exception $err){
        echo "Erreur lors de la soumission . (<a href='/'>CLIQUER ICI POUR RÉESSAYER)";
    }
}

?>