<?php
session_start();
require_once 'db.php';
require_once 'Produto.php'; 

// Verifica se o usuário está logado e se é um administrador
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header("Location: index.php");
    exit;
}

$database = new Database();
$db = $database->getConnection();
$produto = new Produto($db);

// Recebe o termo de busca
$term = isset($_GET['term']) ? $_GET['term'] : '';
$produtos = $produto->buscarProdutos($term);
$totalProdutos = count($produtos); // Conta o total de produtos encontrados

echo json_encode(['produtos' => $produtos, 'total' => $totalProdutos]);

?>
