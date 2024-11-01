<?php

require_once 'db.php';
require_once 'Produto.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    $produto = new Produto($db);

    // Coleta os dados do formulário
    $id_novo = $_POST['id_novo'];
    $id_atual = $_POST['id_atual'];
    $nome_prod = $_POST['nome_prod'];
    $desc_prod = $_POST['desc_prod'];
    $preco_prod = $_POST['preco_prod'];
    
    // Coleta o tipo de produto de forma segura
    $tipo_prod = isset($_POST['tipo_prod']) ? $_POST['tipo_prod'] : null;

    // Inicializa a variável da imagem
    $img_prod = null;

    // Lida com o upload da nova imagem se existir
    if (isset($_FILES['img_prod']) && $_FILES['img_prod']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Diretório onde as imagens serão salvas
        $img_prod = $uploadDir . basename($_FILES['img_prod']['name']);
        
        // Move a imagem para o diretório
        if (!move_uploaded_file($_FILES['img_prod']['tmp_name'], $img_prod)) {
            echo "Erro ao fazer upload da imagem.";
            exit;
        }
    } else {
        // Se nenhuma nova imagem foi enviada, manter a imagem atual
        $img_prod = $produto->getImagemAtual($id_atual);
    }

    // Verifica se o novo ID já existe no banco de dados
    if ($id_novo !== $id_atual) {
        if ($produto->idExistente($id_novo)) {
            echo "Erro: O novo ID do produto já existe. Por favor, escolha um ID diferente.";
            exit;
        }
    }

    // Atualiza os dados do produto
    if ($produto->atualizarProduto($id_novo, $nome_prod, $desc_prod, $preco_prod, $img_prod, $tipo_prod, $id_atual)) {
        echo "Produto atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar produto.";
    }
} else {
    echo "Método não permitido.";
}

?>
