<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Obter a lista de templates existentes
    $templates = glob("template*.html");

    // Enviar a lista como uma resposta JSON
    header('Content-Type: application/json');
    echo json_encode($templates);
} else {
    // Se a solicitação não for GET, retorna uma mensagem de erro
    echo json_encode(['error' => 'Este script deve ser acessado via GET.']);
}