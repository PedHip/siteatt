<?php
require_once 'db.php';
require_once 'Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Chama o método de autenticação
    $tipoUsuario = $usuario->autenticar($email, $senha);

    if ($tipoUsuario) {
        session_start();
        $_SESSION['usuario_logado'] = true;
        $_SESSION['tipo_usuario'] = $tipoUsuario;

        echo json_encode(['status' => 'success', 'message' => '<div style="color:green;">Login realizado com sucesso!</div>']);
    } else {
        echo json_encode(['status' => 'error', 'message' => '<div style="color:red;">Email ou senha inválidos.</div>']);
    }
}
?>
