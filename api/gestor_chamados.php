<?php
session_start();
require_once '../config/database.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['user_perfil'] !== 'gestor') {
    echo json_encode(["success" => false, "message" => "Acesso negado."]);
    exit;
}

$sql = "SELECT chamados.id_chamado, usuarios.nome as solicitante, ambientes.nome as local , chamados.prioridade, status FROM chamados inner join usuarios on chamados.id_solicitante = usuarios.id_usuario join ambientes on ambientes.id_ambiente = chamados.id_ambiente";

        $res = $conn->query($sql);
        $dados = $res->fetch_all(MYSQLI_ASSOC);
        echo json_encode($dados);