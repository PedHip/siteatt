<?php
require_once 'db.php';
require_once 'Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idAtual = $_POST['idAtual'];
    $idNovo = $_POST['idNovo'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'] ?? null;

    if ($usuario->editarUsuario($idAtual, $idNovo, $tipo_usuario, $nome, $telefone, $email, $senha)) {
        echo "Usuário atualizado com sucesso!";
    } else {
        echo "Erro: O email já está em uso por outro usuário ou houve um problema na atualização.";
    }
}
?>
