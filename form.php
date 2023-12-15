<?php
require 'classes/Formulario.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $emailuser = $_POST["emailUser"];
    $senhagmail = $_POST["tokenLogin"];
    $nomegmail = $_POST["nomeUser"];
    $tituloemail = $_POST["tituloEmail"];

    // Use o namespace completo ao instanciar a classe
    $form_obj = new Formulario($emailuser, $senhagmail, $nomegmail, $tituloemail);
    $_SESSION['form_obj'] = $form_obj;
    header("Location: envioemails/index.html");
    exit;
}