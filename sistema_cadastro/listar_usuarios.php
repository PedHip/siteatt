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

// Pega a página da requisição
$pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$usuarios = $usuario->listarUsuarios($pagina);
$totalUsuarios = $usuario->contarUsuarios();

echo json_encode(['usuarios' => $usuarios, 'total' => $totalUsuarios]);

?>
