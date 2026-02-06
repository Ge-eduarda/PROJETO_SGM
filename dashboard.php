<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location: login.php');
    exit;
}
$perfil = $_SESSION['user_perfil'];

switch($perfil){
    case 'gestor':
        header('Location: gestor_deshboard.php');
        break;
    case 'tecnico':
        header('Location: tecnico_deshboard.php');
        break;
    case 'solicitante':
        header('Location: solicitante_deshboard.php');
        break;
    default:
    session_destroy();
    header('location: login.php?error=perfil_invalido');
    break;
}
