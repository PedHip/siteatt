<?php
session_start();

require_once 'db.php';
require_once 'Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

// Verifica se o usuário está logado e se é um administrador
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    http_response_code(403);
    echo json_encode(['message' => 'Acesso negado.']);
    exit;
}

// Recebe o termo de busca
$term = isset($_GET['term']) ? $_GET['term'] : '';

$usuarios = $usuario->buscarUsuarios($term);
echo json_encode($usuarios);
?>
