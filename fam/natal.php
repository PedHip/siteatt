<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Natal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="pedir.css">
</head>

<body>

    <div class="container">
        <h1 class="text-center">Produtos Natal</h1>
        <div class="card-container" id="natalProductsContainer">
            <!-- Os produtos serão inseridos aqui via AJAX -->
        </div>
        <div class="resumopedido">
            <div class="summary-container mt-4" id="summaryContainer">
                <h3>Resumo do Pedido</h3>
                <div class="summary-list">
                    <!-- Resumo dos itens selecionados será inserido aqui -->
                </div>
                <div class="summary-total mt-2">
                    <strong>Total: R$ <span id="totalPrice">0.00</span></strong>
                </div>
            </div>
            <div class="">
                <button id="sendButton" class="btn btn-primary">Enviar</button>
                <div id="messageContainer"></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function listarProdutosNatal() {
                $.ajax({
                    url: 'listar_produtos.php',
                    type: 'GET',
                    data: {
                        term: 'natal'
                    },
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

            listarProdutosNatal();

            function atualizarCards(produtos) {
                const container = $("#natalProductsContainer");
                container.empty();

                produtos.forEach(p => {
                    const card = `
            <div class="product-card" data-id="${p.id_prod}" data-preco="${p.preco_prod}">
                <img src="${p.img_prod}" alt="Imagem do Produto">
                <div class="product-info">
                    <h5>${p.nome_prod}</h5>
                    <div class="desc_prod">${p.desc_prod}</div>
                    <div class="price">R$ <span class="price-value">${p.preco_prod}</span></div>
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

                // Adiciona os eventos após criar os elementos de produto
                $('.product-card').off('click').on('click', function() {
                    $(this).toggleClass('selected');
                    const quantityControl = $(this).find('.quantity-control');
                    if ($(this).hasClass('selected')) {
                        quantityControl.show(); // Mostra o controle de quantidade
                    } else {
                        quantityControl.hide(); // Esconde o controle de quantidade
                        quantityControl.find('.quantity').text(1); // Reseta a quantidade para 1
                        atualizarPrecoTotal($(this), 1); // Reseta o preço para o inicial
                    }
                    atualizarResumo(); // Atualiza o resumo após a seleção/deseleção do produto
                });

                // Evento para aumentar a quantidade
                $('.increase-quantity').off('click').on('click', function(e) {
                    e.stopPropagation(); // Evita que o clique no botão deselecione o produto
                    const quantityElement = $(this).siblings('.quantity');
                    let currentQuantity = parseInt(quantityElement.text());
                    currentQuantity++;
                    quantityElement.text(currentQuantity);
                    atualizarPrecoTotal($(this).closest('.product-card'), currentQuantity);
                    atualizarResumo(); // Atualiza o resumo quando a quantidade é alterada
                });

                // Evento para diminuir a quantidade
                $('.decrease-quantity').off('click').on('click', function(e) {
                    e.stopPropagation(); // Evita que o clique no botão deselecione o produto
                    const quantityElement = $(this).siblings('.quantity');
                    let currentQuantity = parseInt(quantityElement.text());
                    if (currentQuantity > 1) {
                        currentQuantity--;
                        quantityElement.text(currentQuantity);
                        atualizarPrecoTotal($(this).closest('.product-card'), currentQuantity);
                        atualizarResumo(); // Atualiza o resumo quando a quantidade é alterada
                    }
                });
            }


            // Função para atualizar o resumo dos produtos selecionados
            function atualizarResumo() {
                const summaryList = $('#summaryContainer .summary-list');
                summaryList.empty(); // Limpa a lista de resumo

                let precoTotal = 0;

                // Itera sobre os produtos selecionados e atualiza a lista de resumo
                $('.product-card.selected').each(function() {
                    const imgSrc = $(this).find('img').attr('src');
                    const nomeProduto = $(this).find('h5').text();
                    const quantidade = parseInt($(this).find('.quantity').text());
                    const precoUnitario = parseFloat($(this).data('preco'));
                    const precoProduto = precoUnitario * quantidade;
                    precoTotal += precoProduto;

                    const resumoItem = `
            <div class="summary-item d-flex align-items-center mb-2">
                <img src="${imgSrc}" alt="${nomeProduto}" class="img-thumbnail mr-2" style="width: 5rem; height: 5rem;">
                <div>
                    <strong>${nomeProduto}</strong><br>
                    Quantidade: ${quantidade}<br>
                    Preço: R$ ${precoProduto.toFixed(2)}
                </div>
            </div>
        `;
                    summaryList.append(resumoItem);
                });

                // Atualiza o preço total no resumo
                $('#totalPrice').text(precoTotal.toFixed(2));
            }

            // Atualize a função de clique para selecionar/deselecionar produtos para chamar atualizarResumo()
            $('.product-card').on('click', function() {
                $(this).toggleClass('selected');
                const quantityControl = $(this).find('.quantity-control');
                if ($(this).hasClass('selected')) {
                    quantityControl.show(); // Mostra o controle de quantidade
                } else {
                    quantityControl.hide(); // Esconde o controle de quantidade
                    quantityControl.find('.quantity').text(1); // Reseta a quantidade para 1
                    atualizarPrecoTotal($(this), 1); // Reseta o preço para o inicial
                }
                atualizarResumo(); // Atualiza o resumo após a seleção/deseleção do produto
            });

            // Atualize as funções de aumento e diminuição de quantidade para chamar atualizarResumo()
            $('.increase-quantity').on('click', function(e) {
                e.stopPropagation(); // Evita que o clique no botão deselecione o produto
                const quantityElement = $(this).siblings('.quantity');
                let currentQuantity = parseInt(quantityElement.text());
                currentQuantity++;
                quantityElement.text(currentQuantity);
                atualizarPrecoTotal($(this).closest('.product-card'), currentQuantity);
                atualizarResumo(); // Atualiza o resumo quando a quantidade é alterada
            });

            $('.decrease-quantity').on('click', function(e) {
                e.stopPropagation(); // Evita que o clique no botão deselecione o produto
                const quantityElement = $(this).siblings('.quantity');
                let currentQuantity = parseInt(quantityElement.text());
                if (currentQuantity > 1) {
                    currentQuantity--;
                    quantityElement.text(currentQuantity);
                    atualizarPrecoTotal($(this).closest('.product-card'), currentQuantity);
                    atualizarResumo(); // Atualiza o resumo quando a quantidade é alterada
                }
            });


            // Função para atualizar o preço total com base na quantidade selecionada
            function atualizarPrecoTotal(card, quantidade) {
                const precoUnitario = parseFloat(card.data('preco'));
                const precoTotal = precoUnitario * quantidade;
                card.find('.price-value').text(precoTotal.toFixed(2));
            }

            // Enviar pedido
            $('#sendButton').on('click', function() {
                const selectedProducts = [];
                $('.product-card.selected').each(function() {
                    const productId = $(this).data('id');
                    const quantity = parseInt($(this).find('.quantity').text());
                    selectedProducts.push({
                        id: productId,
                        quantidade: quantity
                    });
                });

                console.log('Produtos selecionados:', selectedProducts); // Log para depuração

                if (selectedProducts.length > 0) {
                    $.ajax({
                        url: 'enviar_pedidos.php',
                        type: 'POST',
                        data: {
                            produtos: selectedProducts
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log('Resposta do servidor:', response); // Log da resposta do servidor
                            if (response.status === 'success') {
                                $('#messageContainer').html(response.message);
                            } else {
                                $('#messageContainer').html('<div style="color:red;">' + response.message + '</div>');
                            }
                        },
                        error: function(jqXHR) {
                            try {
                                const response = JSON.parse(jqXHR.responseText); // Tenta analisar a resposta como JSON
                                $('#messageContainer').html('<div style="color:red;">' + response.message + '</div>'); // Exibe a mensagem de erro do servidor
                            } catch (e) {
                                $('#messageContainer').html('<div style="color:red;">Erro desconhecido. Por favor, tente novamente.</div>'); // Exibe mensagem padrão se não for JSON
                            }
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