<?php

require_once 'db.php';
require_once 'Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idAtual = $_POST['idAtual'];
    $idNovo = $_POST['idNovo'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar se o novo email já existe
    if ($usuario->emailExistente($email, $idAtual)) {
        echo "Erro: O email já está em uso.";
        exit; // Para evitar a execução do código de atualização
    }

    // Verificar se o novo ID já existe
    if ($usuario->idExistente($idNovo, $idAtual)) {
        echo "Erro: O ID já está em uso.";
        exit; // Para evitar a execução do código de atualização
    }

    // Continuar com a atualização
    if ($usuario->editarUsuario($idAtual, $idNovo, $tipo_usuario, $nome, $telefone, $email, $senha)) {
        echo "Usuário atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar usuário.";
    }
}
?>
