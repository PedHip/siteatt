<?php
session_start();
require_once 'db.php';
require_once 'Produto.php'; 



$database = new Database();
$db = $database->getConnection();
$produto = new Produto($db);

// Recebe o termo de busca e a página atual
$term = isset($_GET['term']) ? $_GET['term'] : '';
$pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$limite = 10; // Defina o limite de produtos por página

// Busca os produtos considerando a paginação e o termo de busca
$produtos = $produto->buscarProdutosComPaginacao($term, $pagina, $limite);
$totalProdutos = $produto->contarProdutosComTermo($term); // Conta o total de produtos encontrados com o termo

// Retorna os produtos e o total de produtos encontrados como JSON
echo json_encode([
    'produtos' => $produtos,
    'total' => $totalProdutos
]);
?>
