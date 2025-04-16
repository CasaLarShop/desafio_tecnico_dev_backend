<?php
// importar.php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];

    if (empty($titulo)) {
        echo json_encode(['erro' => 'O título da série é obrigatório']);
        exit;
    }

    // Consulta na API OMDB
    $apiKey = 'API_KEY';
    $url = "http://www.omdbapi.com/?apikey=$apiKey&t=" . urlencode($titulo);
    $response = file_get_contents($url);
    $dadosSerie = json_decode($response, true);

    if (isset($dadosSerie['Error'])) {
        echo json_encode(['erro' => 'Série não encontrada']);
        exit;
    }

    // Conexão com o banco de dados
    $pdo = conectar();
    $stmt = $pdo->prepare("INSERT INTO series (titulo, ano, nota_imdb, descricao, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $dadosSerie['Titulo'],
        $dadosSerie['Ano'],
        $dadosSerie['Nota'],
        $dadosSerie['Descrição'],
        date('Y-m-d H:i:s'),
        date('Y-m-d H:i:s'),
    ]);

    echo json_encode(['mensagem' => 'Série importada com sucesso']);
}
