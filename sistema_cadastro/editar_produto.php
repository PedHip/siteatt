<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

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
        if (move_uploaded_file($_FILES['img_prod']['tmp_name'], $img_prod)) {
            // Upload bem-sucedido, a variável $img_prod já contém o caminho
        } else {
            echo "Erro ao fazer upload da imagem.";
            exit;
        }
    } else {
        // Se nenhuma nova imagem foi enviada, manter a imagem atual
        $query = "SELECT img_prod FROM produtos WHERE id_prod = :id_atual";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_atual', $id_atual);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $img_prod = $result['img_prod']; // Mantém a imagem atual
    }

    // Atualiza os dados do produto
    $query = "UPDATE produtos SET id_prod = :id_novo, nome_prod = :nome_prod, desc_prod = :desc_prod, preco_prod = :preco_prod, img_prod = :img_prod, tipo_prod = :tipo_prod WHERE id_prod = :id_atual";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_novo', $id_novo);
    $stmt->bindParam(':nome_prod', $nome_prod);
    $stmt->bindParam(':desc_prod', $desc_prod);
    $stmt->bindParam(':preco_prod', $preco_prod);
    $stmt->bindParam(':img_prod', $img_prod);
    $stmt->bindParam(':tipo_prod', $tipo_prod);
    $stmt->bindParam(':id_atual', $id_atual);

    if ($stmt->execute()) {
        echo "Produto atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar produto.";
    }
} else {
    echo "Método não permitido.";
}
