<?php

session_start();

// Verifica se o usuário está logado e se é um administrador
if (!isset($_SESSION['tipo_usuario']) || $_SESSION['tipo_usuario'] !== 'administrador') {
    header("Location: index.php");
    exit; // Certifique-se de usar exit após o redirecionamento
}

require_once 'db.php';
require_once 'Usuario.php';

$database = new Database();
$db = $database->getConnection();
$usuario = new Usuario($db);
$usuarios = $usuario->listarUsuarios();
?>




<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Usuários</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Registros de Usuários</h1>

    <input type="text" id="search" placeholder="Pesquisar">



    <table border="3" id="usuariosTable">
        <tr>
            <th>ID Atual</th>
            <th>ID Novo</th>
            <th>Tipo de Usuário</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Nova Senha</th>
            <th>Ações</th>
        </tr>
    </table>

    <script>
        
    $(document).ready(function() {
        $(document).ready(function() {
    let timer; // Variável para armazenar o timer

    // Função para listar usuários
    function listarUsuarios() {
        $.ajax({
            url: 'listar_usuarios.php',
            type: 'GET',
            dataType: 'json',
            success: function(usuarios) {
                atualizarTabela(usuarios);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(jqXHR.responseText);
            }
        });
    }

    // Função para atualizar a tabela
    function atualizarTabela(usuarios) {
        const tableBody = $("table tbody");
        tableBody.empty(); // Limpa a tabela

        usuarios.forEach(u => {
            tableBody.append(`
                <tr data-id="${u.id}">
                    <td><input type="text" value="${u.id}" class="id_atual" readonly></td>
                    <td><input type="text" value="${u.id}" class="id_novo"></td>
                    <td><input type="text" value="${u.tipo_usuario}" class="tipo_usuario"></td>
                    <td><input type="text" value="${u.nome}" class="nome"></td>
                    <td><input type="text" value="${u.telefone}" class="telefone"></td>
                    <td><input type="text" value="${u.email}" class="email"></td>
                    <td><input type="text" class="senha" placeholder="Nova Senha"></td>
                    <td>
                        <button class="editar">Editar</button>
                        <button class="apagar">Apagar</button>
                    </td>
                </tr>
            `);
        });
    }

    // Chama a função para listar usuários ao carregar a página
    listarUsuarios();

    // Busca usuários em tempo real
    $("#search").on("keyup", function() {
        clearTimeout(timer); // Limpa o timer anterior
        const searchTerm = $(this).val();

        // Define um novo timer
        timer = setTimeout(function() {
            $.ajax({
                url: 'buscar_usuarios.php',
                type: 'GET',
                data: { term: searchTerm },
                dataType: 'json',
                success: function(usuarios) {
                    atualizarTabela(usuarios);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(jqXHR.responseText);
                }
            });
        }, ); 
    });
});


        $(document).on('click', '.editar', function() {
            const row = $(this).closest('tr');
            const idAtual = row.find('.id_atual').val();
            const idNovo = row.find('.id_novo').val();
            const tipo_usuario = row.find('.tipo_usuario').val();
            const nome = row.find('.nome').val();
            const telefone = row.find('.telefone').val();
            const email = row.find('.email').val();
            const senha = row.find('.senha').val();

            $.ajax({
                url: 'editar_usuario.php',
                type: 'POST',
                data: { idAtual, idNovo, tipo_usuario, nome, telefone, email, senha },
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        });

        $(document).on('click', '.apagar', function() {
            const row = $(this).closest('tr');
            const id = row.data('id');

            if (confirm("Tem certeza que deseja apagar?")) {
                $.ajax({
                    url: 'apagar_usuario.php',
                    type: 'POST',
                    data: { id },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    }
                });
            }
        });

       

});
    </script>
</body>
</html>

