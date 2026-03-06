<?php
session_start();
require_once '../config/database.php';
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['user_perfil'] != 'gestor') {
    echo json_encode([
        "success" => false,
        "message" => "Acesso negado."
    ]);
    exit;
}

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {

    case "GET":

        $sql = "SELECT id_tipo, nome, descricao
        FROM tipos_servico;";

        $result = $conn->query($sql);
        $blocos = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $blocos[] = $row;
            }
        }

        echo json_encode([
            "success" => true,
            "data" => $blocos
        ]);

        break;

case "POST":

    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->nome) || !isset($data->descricao)) {
        echo json_encode([
            "success" => false,
            "message" => "Dados incompletos. Informe nome e descricao."
        ]);
        exit;
    }

    $nome = $conn->real_escape_string($data->nome);
    $descricao = $conn->real_escape_string($data->descricao);

    $sql = "INSERT INTO tipos_servico (nome, descricao) 
            VALUES ('$nome', '$descricao')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "success" => true,
            "message" => "Bloco criado com sucesso.",
            "id_bloco" => $conn->insert_id
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Erro ao criar bloco: " . $conn->error
        ]);
    }

    break;
    
case "PUT":

    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->id_tipo) || 
        !isset($data->nome) || 
        !isset($data->descricao)) {

        echo json_encode([
            "success" => false,
            "message"=> "Dados incompletos para atualização."
        ]);
        exit;
    }

    $id_tipo = (int) $data->id_tipo;
    $nome = $conn->real_escape_string(trim($data->nome));
    $descricao = $conn->real_escape_string($data->descricao);

    $sql = "UPDATE tipos_servico 
            SET nome = '$nome', descricao = '$descricao'
            WHERE id_tipo = $id_tipo";

    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "success"=> true,
            "message" => "Tipos de serviços atualizado com sucesso."
        ]);
    } else {
        echo json_encode([
            "success"=> false,
            "message"=> "Erro ao atualizar tipos de serviços: " . $conn->error
        ]);
    }

    break;

case "DELETE":

    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->id_tipo)) {
        echo json_encode([
            "success" => false,
            "message"=> "Informe o id_ambiente para deletar."
        ]);
        exit;
    }

    $id_tipo = (int) $data->id_tipo;

    $sql = "DELETE FROM tipos_servico
            WHERE id_tipo = $id_tipo";

    if ($conn->query($sql) === TRUE) {
        echo json_encode([
            "success"=> true,
            "message" => "Tipo de serviço deletado com sucesso."
        ]);
    } else {
        echo json_encode([
            "success"=> false,
            "message"=> "Erro ao deletar tipo de serviço: " . $conn->error
        ]);
    }

    break;

default:
    echo json_encode(["success"=> false,"message"=> "Método HTTP não suportado"]);
    break;
}