
<?php

use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emails = $_POST["emails"];
    $emailuser = $_POST["emailuser"];
    $senhagmail = $_POST["senhagmail"];
    $nomegmail = $_POST["nomenogmail"];
    $tituloemail = $_POST["tituloemail"];
    $template = $_POST["template"];

    $mail = new PHPMailer();

    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';

    $mail->Port = 465;
    

    $mail->SMTPSecure ='ssl';
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    
    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = $emailuser;
    
    //Password to use for SMTP authentication
    $mail->Password = $senhagmail;
    

    //Do not use user-submitted addresses in here
    $mail->setFrom($emailuser, $nomegmail);

    //Set who the message is to be sent to
    
    //Set the subject line
    $mail->Subject = $tituloemail;
    
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML(file_get_contents("templates". DIRECTORY_SEPARATOR  .$template.'.html'), __DIR__);
    
    //Replace the plain text body with one created manually
    $mail->AltBody = 'html n';
    
    //Attach an image file
    $mail->addAttachment('images/phpmailer_mini.png');
    
    //send the message, check for errors
    foreach ($emails as $email) {
        $mail->clearAddresses(); // Limpa os destinatários anteriores
        $mail->addAddress($email, 'Progamando');

        // Envie o e-mail, verificando erros
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent to ' . $email . '!';
        }
    }
}

?>