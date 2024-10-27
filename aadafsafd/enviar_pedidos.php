<?php
session_start(); // Inicia a sessão para acessar as variáveis

error_reporting(E_ALL);
ini_set('display_errors', 1); // Altere para 1 para exibir erros durante o desenvolvimento

require_once 'db.php';
require_once 'Produto.php';
require_once 'Pedido.php'; // Inclui o arquivo da classe Pedido

$database = new Database();
$db = $database->getConnection();
$produto = new Produto($db);
$pedido = new Pedido($db); // Instancia a classe Pedido

// Recebe os dados enviados via POST
$usuario_pedido = $_SESSION['nome'] ?? ''; // Usa o nome do usuário da sessão
$usuario_contato = ($_SESSION['email'] ?? '') . ' ' . ($_SESSION['telefone'] ?? ''); // Concatena email e telefone

$produtosSelecionados = $_POST['produtos'] ?? []; // Os produtos selecionados

header('Content-Type: application/json'); // Define o tipo de conteúdo como JSON

if (empty($usuario_pedido) || empty($usuario_contato)) {
    echo json_encode(['status' => 'error', 'message' => '<div style="color:red;">Faça Login para pedir.</div>']);
    exit();
}

// Array para armazenar informações dos produtos
$produtosInfo = [];
$precoTotal = 0.0; // Inicializa o preço total

// Busca as informações dos produtos selecionados
foreach ($produtosSelecionados as $produtoSelecionado) {
    $id_prod = $produtoSelecionado['id'];
    $quantidade = $produtoSelecionado['quantidade'];

    $produtoInfo = $produto->buscarProdutoPorId($id_prod);
    if ($produtoInfo) {
        $produtosInfo[] = [
            'nome' => $produtoInfo['nome_prod'],
            'descricao' => $produtoInfo['desc_prod'],
            'preco' => $produtoInfo['preco_prod'],
            'quantidade' => $quantidade
        ];
        $precoTotal += (float)$produtoInfo['preco_prod'] * $quantidade; // Soma o preço multiplicado pela quantidade
    }
}

// Cria uma string formatada para os produtos e suas descrições
$produtosFormatados = [];
foreach ($produtosInfo as $info) {
    $produtosFormatados[] = $info['nome'] . " (Descrição: " . $info['descricao'] . ", Quantidade: " . $info['quantidade'] . ")";
}

// Insere o pedido no banco de dados utilizando a classe Pedido
if ($pedido->cadastrarPedido($usuario_pedido, $usuario_contato, $produtosFormatados, $precoTotal)) {
    echo json_encode(['status' => 'success', 'message' => '<div style="color:green;">Pedido registrado com sucesso!</div>']);
} else {
    echo json_encode(['status' => 'error', 'message' => '<div style="color:red;">Faça login para pedir.</div>']);
}
exit();
?>
