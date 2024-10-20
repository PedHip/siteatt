<?php

require_once 'db.php';
require_once 'Produto.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    $produto = new Produto($db);

    $nome_prod = $_POST['nome_prod'];
    $desc_prod = $_POST['desc_prod'];
    $tipo_prod = $_POST['tipo_prod'];
    $preco_prod = $_POST['preco_prod'];

    if (isset($_FILES['img_prod']) && $_FILES['img_prod']['error'] == 0) {
        $img_prod = 'uploads/' . basename($_FILES['img_prod']['name']);
        if (move_uploaded_file($_FILES['img_prod']['tmp_name'], $img_prod)) {
            echo $produto->cadastrar($nome_prod, $desc_prod, $img_prod, $tipo_prod, $preco_prod);
        } else {
            echo "Erro ao fazer upload da imagem.";
        }
    } else {
        echo "Imagem não enviada ou erro no envio.";
    }
}
?>
