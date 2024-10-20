<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Dia das Mães</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="pedir.css">
</head>

<body>

    <div class="container">
        <h1 class="text-center">Produtos Dia das Mães</h1>
        <div class="card-container" id="maesProductsContainer">
            <!-- Os produtos serão inseridos aqui via AJAX -->
        </div>
        <div class="text-center mt-4">
            <button id="sendButton" class="btn btn-primary">Enviar</button>
            <div id="messageContainer"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function listarProdutosMaes() {
                $.ajax({
                    url: 'listar_produtos.php',
                    type: 'GET',
                    data: { term: 'dia_das_maes' },
                    dataType: 'json',
                    success: function(response) {
                        if (response.produtos && response.produtos.length > 0) {
                            atualizarCards(response.produtos);
                        } else {
                            alert("Nenhum produto encontrado.");
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(jqXHR.responseText);
                    }
                });
            }

            listarProdutosMaes();

            function atualizarCards(produtos) {
                const container = $("#maesProductsContainer");
                container.empty();

                produtos.forEach(p => {
                    const card = `
                        <div class="product-card" data-id="${p.id_prod}">
                            <img src="${p.img_prod}" alt="Imagem do Produto">
                            <div class="product-info">
                                <h5>${p.nome_prod}</h5>
                                <p>${p.desc_prod}</p>
                                <div class="price">R$ ${p.preco_prod}</div>
                            </div>
                            <div class="quantity-control" style="display: none;">
                                <button class="botaoquantidade decrease-quantity">-</button>
                                <div class="quantity">1</div>
                                <button class="botaoquantidade increase-quantity">+</button>
                            </div>
                        </div>
                    `;
                    container.append(card);
                });

                $('.product-card').on('click', function() {
                    $(this).toggleClass('selected');
                    const quantityControl = $(this).find('.quantity-control');
                    if ($(this).hasClass('selected')) {
                        quantityControl.show();
                    } else {
                        quantityControl.hide();
                        quantityControl.find('.quantity').text(1);
                    }
                });

                $('.increase-quantity').on('click', function(e) {
                    e.stopPropagation();
                    const quantityElement = $(this).siblings('.quantity');
                    let currentQuantity = parseInt(quantityElement.text());
                    quantityElement.text(currentQuantity + 1);
                });

                $('.decrease-quantity').on('click', function(e) {
                    e.stopPropagation();
                    const quantityElement = $(this).siblings('.quantity');
                    let currentQuantity = parseInt(quantityElement.text());
                    if (currentQuantity > 1) {
                        quantityElement.text(currentQuantity - 1);
                    }
                });
            }

            $('#sendButton').on('click', function() {
                const selectedProducts = [];
                $('.product-card.selected').each(function() {
                    const productId = $(this).data('id');
                    const quantity = parseInt($(this).find('.quantity').text());
                    selectedProducts.push({ id: productId, quantidade: quantity });
                });

                if (selectedProducts.length > 0) {
                    $.ajax({
                        url: 'enviar_produtos.php',
                        type: 'POST',
                        data: { produtos: selectedProducts },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                $('#messageContainer').html(response.message);
                            } else {
                                $('#messageContainer').html('<div style="color:red;">' + response.message + '</div>');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Erro ao enviar a requisição:', textStatus, errorThrown);
                            $('#messageContainer').html('<div style="color:red;">Erro ao enviar produtos. Por favor, tente novamente.</div>');
                        }
                    });
                } else {
                    $('#messageContainer').html('<div style="color:gray;">Nenhum produto selecionado.</div>');
                }
            });
        });
    </script>

</body>

</html>
