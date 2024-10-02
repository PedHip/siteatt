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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="backend.css">
</head>
<body>
    <div class="container-fluid">
        <h1 class="mb-4">Registros de Usuários</h1>

        <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Pesquisar">
        </div>

        <table class="table table-bordered table-hover" id="usuariosTable">
            <thead class="table-light">
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
            </thead>
            <tbody>
                <!-- Dados serão inseridos aqui via AJAX -->
            </tbody>
        </table>

        <nav aria-label="Page navigation">
            <ul class="pagination" id="paginacao">
                <!-- Paginação será inserida aqui -->
            </ul>
        </nav>
    </div>

    <script>
    $(document).ready(function() {
        let timer; // Variável para armazenar o timer
        let paginaAtual = 1; // Variável para acompanhar a página atual

        function listarUsuarios() {
            $.ajax({
                url: 'listar_usuarios.php',
                type: 'GET',
                data: { pagina: paginaAtual },
                dataType: 'json',
                success: function(response) {
                    atualizarTabela(response.usuarios);
                    atualizarPaginas(response.total); // Atualiza a paginação
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(jqXHR.responseText);
                }
            });
        }

        function atualizarTabela(usuarios) {
            const tableBody = $("table tbody");
            tableBody.empty(); // Limpa a tabela

            usuarios.forEach(u => {
                tableBody.append(`
                    <tr data-id="${u.id}">
                        <td><input type="text" value="${u.id}" class="form-control id_atual" readonly></td>
                        <td><input type="text" value="${u.id}" class="form-control id_novo"></td>
                        <td><input type="text" value="${u.tipo_usuario}" class="form-control tipo_usuario"></td>
                        <td><input type="text" value="${u.nome}" class="form-control nome"></td>
                        <td><input type="text" value="${u.telefone}" class="form-control telefone"></td>
                        <td><input type="text" value="${u.email}" class="form-control email"></td>
                        <td><input type="text" class="form-control senha" placeholder="Nova Senha"></td>
                        <td>
                            <button class="btn btn-secondary editar">Editar</button>
                            <button class="btn btn-secondary apagar">Apagar</button>
                        </td>
                    </tr>
                `);
            });
        }

        function atualizarPaginas(totalUsuarios) {
            const totalPaginas = Math.ceil(totalUsuarios / 15);
            let paginacao = '';

            // Botão "Anterior"
            if (paginaAtual > 1) {
                paginacao += `<li class="page-item"><button class="page-link pagina" data-pagina="${paginaAtual - 1}">Anterior</button></li>`;
            }

            // Limitar a 10 botões de paginação
            let start = Math.max(1, paginaAtual - 4); // Começar a partir de 4 páginas antes, mas no mínimo 1
            let end = Math.min(totalPaginas, start + 9); // Limitar a 10 páginas no máximo

            if (end - start < 9) {
                start = Math.max(1, end - 9); // Ajustar para mostrar sempre 10 páginas se possível
            }

            for (let i = start; i <= end; i++) {
                paginacao += `<li class="page-item ${i === paginaAtual ? 'active' : ''}"><button class="page-link pagina" data-pagina="${i}">${i}</button></li>`;
            }

            // Botão "Próximo"
            if (paginaAtual < totalPaginas) {
                paginacao += `<li class="page-item"><button class="page-link pagina" data-pagina="${paginaAtual + 1}">Próximo</button></li>`;
            }

            $('#paginacao').html(paginacao); // Atualiza a div de paginação
        }

        // Captura evento de clique nas páginas
        $(document).on('click', '.pagina', function() {
            paginaAtual = $(this).data('pagina');
            listarUsuarios(); // Recarrega a lista de usuários para a página selecionada
        });

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
            }, 300); 
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
            if (response.includes("Erro:")) {
                alert(response); // Exibe a mensagem de erro
            } else {
                alert(response);
                location.reload();
            }
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
