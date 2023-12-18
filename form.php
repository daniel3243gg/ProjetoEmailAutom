<?php
require 'classes/Formulario.php';


session_start();

if(isset($_COOKIE["login"])){
  
    $login = unserialize($_COOKIE["login"]);
    $emailuser = $login['emailuser'];
    $senhagmail = $login["senhagmail"];
    $nomegmail = $login["nomegmail"];
    $tituloemail = $login["tituloEmail"];
    
    $form_obj = new Formulario($emailuser, $senhagmail, $nomegmail, $tituloemail);
    $_SESSION['form_obj'] = $form_obj;
    header("Location: envioemails/index.html");
    exit;

}else{

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $emailuser = $_POST["emailUser"];
    $senhagmail = $_POST["tokenLogin"];
    $nomegmail = $_POST["nomeUser"];
    $tituloemail = $_POST["tituloEmail"];
    $arraycookie = [
        'emailuser' => $emailuser,
        'senhagmail'=> $senhagmail,
        'nomegmail'=> $nomegmail,
        'tituloemail' => $tituloemail
    ];
    $array_val_cokkie = serialize($arraycookie);
    setcookie("login", $array_val_cokkie, time() + 3600, "/");
    
    $form_obj = new Formulario($emailuser, $senhagmail, $nomegmail, $tituloemail);
    $_SESSION['form_obj'] = $form_obj;
    header("Location: envioemails/index.html");
    exit;
}}