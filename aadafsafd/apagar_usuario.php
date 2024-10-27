<?php
require_once 'db.php';
require_once 'Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    if ($usuario->apagarUsuario($id)) {
        echo "Usuário apagado com sucesso!";
    } else {
        echo "Erro ao apagar usuário.";
    }
}
?>
