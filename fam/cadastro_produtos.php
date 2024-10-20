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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="backend.css">
    <title>Cadastro e Listagem de Produtos</title>
</head>

<body>
    <div class="container">
        <h1>Cadastro de Produtos</h1>
        <form id="cadastroProduto" enctype="multipart/form-data">
            <input type="text" class="form-control2" id="nome_prod" name="nome_prod" placeholder="Nome do Produto" required>
            <textarea class="form-control2 desc" id="desc_prod" name="desc_prod" placeholder="Descrição" required></textarea>
            <input type="number" class="form-control2" id="preco_prod" name="preco_prod" step="0.01" placeholder="Preço" required>
            <input type="file" class="form-control2" id="img_prod" name="img_prod" required>
            <select class="form-control2" id="tipo_prod" name="tipo_prod" required>
                <option value="" disabled selected>Tipo de Produto</option>
                <option value="bubble">Bubble</option>
                <option value="bubble_box">Bubble na Box</option>
                <option value="bubble_acrilico">Bubble Acrílico</option>
                <option value="box_luxo">Box de Luxo</option>
                <option value="natal">Natal</option>
                <option value="dia_das_maes">Dia das Mães</option>
                <option value="caneca">Caneca</option>
            </select><br>
            <button type="submit" class="btn cadastro">Cadastrar Produto</button>
        </form>
    </div>

    <div class="container">
        <h1>Listagem de Produtos</h1>

        <input type="text" id="search" class="form-control2" placeholder="Pesquisar">

        <table id="produtosTable">
            <thead>
                <tr>
                    <th>ID Atual</th>
                    <th>ID Novo</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Imagem</th>
                    <th>Tipo</th>
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

            $('#cadastroProduto').on('submit', function(event) {
                event.preventDefault(); // Evita o envio padrão do formulário

                const formData = new FormData(this);

                $.ajax({
                    url: 'cadastrar_produto.php', // Endpoint para o cadastro
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert(response);
                        $('#cadastroProduto')[0].reset(); // Limpa o formulário
                        listarProdutos(); // Atualiza a lista de produtos
                    },
                    error: function() {
                        alert('Erro ao cadastrar produto.');
                    }
                });
            });

            function listarProdutos(searchTerm = '') {
                $.ajax({
                    url: 'listar_produtos.php',
                    type: 'GET',
                    data: {
                        pagina: paginaAtual,
                        term: searchTerm // Passa o termo de busca para o backend
                    },
                    dataType: 'json',
                    success: function(response) {
                        atualizarTabela(response.produtos); // Atualiza a tabela com produtos
                        atualizarPaginas(response.total); // Atualiza a paginação
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(jqXHR.responseText);
                    }
                });
            }


            function atualizarTabela(produtos) {
                const tableBody = $("#produtosTable tbody");
                tableBody.empty(); // Limpa a tabela

                produtos.forEach(p => {
                    tableBody.append(`
                        <tr data-id="${p.id_prod}">
                            <td><input type="text" value="${p.id_prod}" class="form-control id_atual" readonly></td>
                            <td><input type="text" value="${p.id_prod}" class="form-control id_novo"></td>
                            <td><input type="text" value="${p.nome_prod}" class="form-control nome_prod"></td>
                            <td><textarea class="form-control desc_prod">${p.desc_prod}</textarea></td>
                            <td><input type="number" value="${p.preco_prod}" class="form-control preco_prod" step="0.01"></td>
                            <td>
                                <img src="${p.img_prod}" alt="Imagem Atual" width="150" class="img-fluid mb-2"> 
                                <input type="file" class="form-control img_prod" style="display: none;"> 
                            </td>
                            <td>
                                <select class="form-control tipo_prod">
                                    <option value="bubble" ${p.tipo_prod === 'bubble' ? 'selected' : ''}>Bubble</option>
                                    <option value="bubble_box" ${p.tipo_prod === 'bubble_box' ? 'selected' : ''}>Bubble na Box</option>
                                    <option value="bubble_acrilico" ${p.tipo_prod === 'bubble_acrilico' ? 'selected' : ''}>Bubble Acrílico</option>
                                    <option value="box_luxo" ${p.tipo_prod === 'box_luxo' ? 'selected' : ''}>Box de Luxo</option>
                                    <option value="natal" ${p.tipo_prod === 'natal' ? 'selected' : ''}>Natal</option>
                                    <option value="dia_das_maes" ${p.tipo_prod === 'dia_das_maes' ? 'selected' : ''}>Dia das Mães</option>
                                    <option value="caneca" ${p.tipo_prod === 'caneca' ? 'selected' : ''}>Caneca</option>
                                </select>
                            </td>
                            <td>
                                <button class="btn editar">Editar</button>
                                <button class="btn apagar">Apagar</button>
                            </td>
                        </tr>
                    `);
                });
            }

            $('#search').on('keyup', function() {
                const searchTerm = $(this).val();
                clearTimeout(timer); // Limpa o timer anterior
                timer = setTimeout(function() {
                    listarProdutos(searchTerm); // Chama a função de listagem com o termo de busca
                }, ); // Adicionando o tempo de espera de 300 ms
            });

            function atualizarPaginas(totalProdutos) {
                const totalPaginas = Math.ceil(totalProdutos / 10);
                let paginacao = '';

                // Botão "Anterior"
                if (paginaAtual > 1) {
                    paginacao += `<li><button class="pagina" data-pagina="${paginaAtual - 1}">Anterior</button></li>`;
                }

                // Exibe um máximo de 5 páginas de cada vez
                const maxPaginasVisiveis = 5;
                const inicioPagina = Math.max(1, paginaAtual - Math.floor(maxPaginasVisiveis / 2));
                const fimPagina = Math.min(totalPaginas, inicioPagina + maxPaginasVisiveis - 1);

                for (let i = inicioPagina; i <= fimPagina; i++) {
                    paginacao += `<li><button class="pagina ${i === paginaAtual ? 'active' : ''}" data-pagina="${i}">${i}</button></li>`;
                }

                // Botão "Próximo"
                if (paginaAtual < totalPaginas) {
                    paginacao += `<li><button class="pagina" data-pagina="${paginaAtual + 1}">Próximo</button></li>`;
                }

                $('#paginacao').html(paginacao); // Atualiza a lista de páginas
            }

            $(document).on('click', '.pagina', function() {
                paginaAtual = $(this).data('pagina');
                listarProdutos(); // Atualiza a lista de produtos ao trocar de página
            });

            $(document).on('click', '.editar', function() {
                const row = $(this).closest('tr');
                const idAtual = row.find('.id_atual').val();
                const idNovo = row.find('.id_novo').val();
                const nome = row.find('.nome_prod').val();
                const desc = row.find('.desc_prod').val();
                const preco = row.find('.preco_prod').val();
                const img = row.find('.img_prod')[0].files[0]; // Captura a nova imagem
                const tipo = row.find('.tipo_prod').val(); // Captura o tipo do produto

                const formData = new FormData();
                formData.append('id_atual', idAtual);
                formData.append('id_novo', idNovo);
                formData.append('nome_prod', nome); // Corrigido o nome do campo
                formData.append('desc_prod', desc); // Corrigido o nome do campo
                formData.append('preco_prod', preco); // Corrigido o nome do campo
                if (img) {
                    formData.append('img_prod', img); // Adiciona a nova imagem se existir
                }
                formData.append('tipo_prod', tipo); // Corrigido o nome do campo

                $.ajax({
                    url: 'editar_produto.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert(response);
                        listarProdutos(); // Atualiza a lista de produtos após editar
                    },
                    error: function() {
                        alert('Erro ao editar produto.');
                    }
                });
            });


            $(document).on('click', '.apagar', function() {
                const row = $(this).closest('tr');
                const id = row.find('.id_atual').val();

                if (confirm("Tem certeza que deseja apagar este produto?")) {
                    $.ajax({
                        url: 'apagar_produto.php',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            alert(response);
                            listarProdutos(); // Atualiza a lista de produtos após apagar
                        },
                        error: function() {
                            alert('Erro ao apagar produto.');
                        }
                    });
                }
            });

            listarProdutos(); // Chama a função ao carregar a página
        });
    </script>
</body>

</html>