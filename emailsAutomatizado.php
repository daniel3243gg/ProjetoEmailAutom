
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

    $mail->SMTPAuth = true;
    
  
    $mail->Username = $emailuser;
    
    
    $mail->Password = $senhagmail;
    

    $mail->setFrom($emailuser, $nomegmail);

    $mail->Subject = $tituloemail;
    
    
    $mail->msgHTML(file_get_contents("templates". DIRECTORY_SEPARATOR  .$template.'.html'), __DIR__);
    
    
    $mail->AltBody = 'html n';
    
    
    $mail->addAttachment('images/phpmailer_mini.png');
    
   
    foreach ($emails as $email) {
        $mail->clearAddresses();  
        $mail->addAddress($email, 'Progamando');

        
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message sent to ' . $email . '!';
        }
    }
}

?>