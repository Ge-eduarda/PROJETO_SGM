<?php
session_start();
require_once '../config/database.php'; // Ajustado para o mesmo caminho do outro
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["success" => false, "message" => "Acesso negado."]);
    exit;
}

$id_chamado = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id_chamado > 0) {
    // Adicionado aliás para u.nome como solicitante_nome para bater com seu JS
    $sql = "SELECT c.*, a.nome as ambiente_nome, b.nome as bloco_nome, 
                   u.nome as solicitante_nome, t.nome as tipo_nome
            FROM chamados c
            JOIN ambientes a ON c.id_ambiente = a.id_ambiente
            JOIN blocos b ON a.id_bloco = b.id_bloco
            JOIN usuarios u ON c.id_solicitante = u.id_usuario
            JOIN tipos_servico t ON c.id_tipo_servico = t.id_tipo
            WHERE c.id_chamado = $id_chamado";
    
    $result = $conn->query($sql);
    $chamado = $result->fetch_assoc();
    
    if ($chamado) {
        echo json_encode($chamado);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Chamado não encontrado"]);
    }
    exit;
}