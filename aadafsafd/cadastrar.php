<?php

require_once 'db.php';
require_once 'Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); // Criptografando a senha

    // Chame o método para cadastrar o usuário
    if ($usuario->cadastrar($nome, $telefone, $email, $senha)) {
        echo json_encode(['status' => 'success', 'message' => '<div style="color:green;">Cadastro realizado com sucesso!</div>']);
    } else {
        echo json_encode(['status' => 'error', 'message' => '<div style="color:red;">Erro ao realizar o cadastro.</div>']);
    }
}
?>
