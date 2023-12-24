<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $texto = $_POST["novoTemplate"];

    if (isset($_COOKIE["templatescriados"])) {
        $cont = $_COOKIE["templatescriados"];
        $cont = preg_replace("/[^a-zA-Z0-9]+/", "", $cont); 
        $cont++;
        setcookie("templatescriados", $cont, time() + 9999, "/");
    } else {
        $cont = 1;
        setcookie("templatescriados", $cont, time() + 9999, "/");
    }

    $caminhoArquivo = "template{$cont}.html";
    
    $arquivo = fopen($caminhoArquivo, "wb");

    if ($arquivo) {

        $textoUtf8 = mb_convert_encoding($texto, 'UTF-8');
        // Escreve o texto no arquivo usando utf8_encode
        fwrite($arquivo, $textoUtf8);

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
