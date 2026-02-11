<?php
session_start();
require_once '../config/database.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['user_perfil'] !== 'solicitante') {
    echo json_encode(["success" => false, "message" => "Acesso negado."]);
    exit;
}

$sql = "SELECT
            chamados.id_chamado,
            ambientes.nome,
            chamados.descricao_problema,
            chamados.data_abertura,
            status
        FROM chamados inner join ambientes on ambientes.id_ambiente = chamados.id_ambiente";

        $res = $conn->query($sql);
        $dados = $res->fetch_all(MYSQLI_ASSOC);
        echo json_encode($dados);