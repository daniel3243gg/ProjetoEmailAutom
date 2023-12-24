<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $texto = htmlspecialchars($_POST["novoTemplate"]);

    if(isset($_COOKIE["templatescriados"])){
        $cont = $_COOKIE["templatescriados"];
        $cont = preg_replace("/[^a-zA-Z0-9]+/", "", $cont); 
        $cont++;
        setcookie("templatescriados", $cont, time() + 9999, "/");
    }else{
        $cont = 1;
        setcookie("templatescriados", $cont, time() + 9999, "/");
    }

    $caminhoArquivo = "template{$cont}.html";
    var_dump($caminhoArquivo);
    $arquivo = fopen($caminhoArquivo, "w");

    if ($arquivo) {
        // Escreve o texto no arquivo
        fwrite($arquivo, "\xEF\xBB\xBF");
        fwrite($arquivo, $texto);

        // Fecha o arquivo
        fclose($arquivo);

        echo "Texto gravado com sucesso no arquivo HTML.";
    } else {
        echo "Erro ao abrir o arquivo para escrita.";
    }
} else {
    echo "Este script deve ser acessado via POST.";
}
?>
