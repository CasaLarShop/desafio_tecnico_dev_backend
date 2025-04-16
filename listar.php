<?php
// listar.php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $nota = isset($_GET['nota']) ? floatval($_GET['nota']) : null;

    // Conexão com o banco de dados
    $pdo = conectar();
    $query = "SELECT * FROM series";
    $params = [];

    if ($nota !== null) {
        $query .= " WHERE nota_imdb >= ?";
        $params[] = $nota;
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $series = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($series);
}
