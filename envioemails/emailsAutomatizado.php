
<?php
require '../vendor/autoload.php';
require '../classes/Formulario.php';
use PHPMailer\PHPMailer\PHPMailer;


//if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
  // header("Location: ../index.php"); 
    //exit(); 
//}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $form_obj = $_SESSION['form_obj'];
    $emails = $_POST["emails"];
    $template = $_POST["template"];

    $mail = new PHPMailer();

    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';

    $mail->Port = 465;
    

    $mail->SMTPSecure ='ssl';

    $mail->SMTPAuth = true;
    
  
    $mail->Username = $form_obj->getEmailUser();
    
    
    $mail->Password = $form_obj->getSenhaGmail();
    

    $mail->setFrom($form_obj->getEmailUser(), $form_obj->getNomeGmail());

    $mail->Subject = $form_obj->getTituloEmail();
    
    
    $mail->msgHTML(file_get_contents("templates". DIRECTORY_SEPARATOR  .$template), __DIR__);
    
    
    $mail->AltBody = 'html n';
    
    
    
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->addAttachment('images/phpmailer_mini.png');
    
   
    foreach ($emails as $email) {
        $mail->clearAddresses();  
        $mail->addAddress($email, $form_obj->getTituloEmail());

        
        if (!$mail->send()) {

            $dadosDoPHP = array("resposta" => false );
            $dadosJS = json_encode($dadosDoPHP);
          
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $dadosDoPHP = array("resposta" => true );
            $dadosJS = json_encode($dadosDoPHP);
           
        }
    }
}
session_abort();
?>
<script>
    var dadosJS = <?php echo $dadosJS; ?>;
    if(dadosJS == false){
        alert('ERRO NO ENVIO');
        // Redireciona para a página index.html
        window.location.href = 'index.html';

    }else{
        alert('ENVIADO COM SUCESSO!')
        window.location.href = 'index.html';

    }
</script>