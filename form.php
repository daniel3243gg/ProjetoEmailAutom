<?php
require 'classes/Formulario.php';

session_start();

// Verifica se o cookie 'login' está presente e não está vazio
if (!empty($_COOKIE["login"])) {
    // Deserializa o cookie e recupera os dados
    $login = unserialize($_COOKIE["login"]);
    $emailuser = $login['emailuser'];
    $senhagmail = $login["senhagmail"];
    $nomegmail = $login["nomegmail"];
    $tituloemail = $login["tituloemail"];

    // Cria um objeto Formulario com os dados do cookie
    $form_obj = new Formulario($emailuser, $senhagmail, $nomegmail, $tituloemail);
    $_SESSION['form_obj'] = $form_obj;

    
    header("Location: envioemails/index.html");
    
}

// Se não houver cookie ou se não for uma requisição POST, renderiza o formulário normalmente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailuser = $_POST["emailUser"];
    $senhagmail = $_POST["tokenLogin"];
    $nomegmail = $_POST["nomeUser"];
    $tituloemail = $_POST["tituloEmail"];

    // Cria um cookie com os dados do formulário
    $arraycookie = [
        'emailuser' => $emailuser,
        'senhagmail'=> $senhagmail,
        'nomegmail'=> $nomegmail,
        'tituloemail' => $tituloemail
    ];
    $array_val_cokkie = serialize($arraycookie);
    setcookie("login", $array_val_cokkie, time() + 3600, "/");

    // Cria um objeto Formulario com os dados do formulário
    $form_obj = new Formulario($emailuser, $senhagmail, $nomegmail, $tituloemail);
    $_SESSION['form_obj'] = $form_obj;

    // Redireciona para a página desejada
    header("Location: envioemails/index.html");
    exit;
}
?>