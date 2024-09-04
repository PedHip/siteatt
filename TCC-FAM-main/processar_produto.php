<!-- 

    if(isset($_POST['submit']))
    {
        // print_r($_POST['nome']);
        // print_r($_POST['desc']);
        // print_r($_POST['classificacao']);
        // print_r($_POST['imagem']);
        
        include('conexao.php');

        $classificacao = $_POST['classificacao'];
        $nome = $_POST['nome'];
        $descprod = $_POST['descprod'];
        $img_prod = $_POST['img_prod'];

        $result = mysqli_query($conn, "INSERT INTO produtos(classificacao,nome,descprod,img_prod) VALUES ('$classificacao','$nome','$descprod','$img_prod')");
    } -->



<!-- 
require "conexao.php";
require "produto.php";
require "produto_repositorio.php";

//if (isset($_POST['cadastro'])){ ou
if (isset($_POST['submit'])){
    $classificacao = $_POST["classificacao"];
    $nome = $_POST["nome"];
    $descprod = $_POST["descprod"];
    $img_prod = $_FILES['img_prod'];


    
    $produto = new Produto(
        $classificacao,
        $nome,
        $descprod,
        $img_prod
    );

    $ProdutoRepositorio = new ProdutoRepositorio($conn);
    if (isset($_FILES['img_prod']) && ($_FILES['img_prod']['error'] == 0)){
        $produto->setImg_prod(uniqid() . $_FILES['img_prod']);
        move_uploaded_file($_FILES['img_prod'], $produto->getImg_prodDiretorio());
    }
    $sucess = $ProdutoRepositorio->cadastrar($produto);
} -->
<?php

require "conexao.php";
require "produto.php";
require "produto_repositorio.php";

if (isset($_POST['submit'])) {
    $classificacao = $_POST["classificacao"];
    $nome = $_POST["nome"];
    $descprod = $_POST["descprod"];

    // Verifique se o diretório de upload existe e crie-o se não existir
    if (!is_dir('uploads')) {
        mkdir('uploads', 0755, true);
    }

    // Verifique se o arquivo foi enviado corretamente
    if (isset($_FILES['img_prod']) && $_FILES['img_prod']['error'] == 0) {
        $img_prod = $_FILES['img_prod'];
        $img_prod_nome = uniqid() . '-' . basename($img_prod['name']); // Cria um nome único para o arquivo
        $img_prod_destino = 'uploads/' . $img_prod_nome; // Diretório de destino

        // Crie uma instância do Produto com o nome do arquivo
        $produto = new Produto(
            $classificacao,
            $nome,
            $descprod,
            $img_prod_destino // Passa o caminho completo do arquivo
        );

        // Movendo o arquivo para o diretório de destino
        if (move_uploaded_file($img_prod['tmp_name'], $img_prod_destino)) {
            // Arquivo movido com sucesso
        } else {
            // Trate o erro ao mover o arquivo
            echo 'Erro ao mover o arquivo.';
        }
    } else {
        // Trate o caso em que o arquivo não foi enviado ou ocorreu um erro
        echo 'Arquivo não enviado ou erro no upload.';
    }

    // Crie uma instância do repositório e cadastre o produto
    $ProdutoRepositorio = new ProdutoRepositorio($conn);
    $sucess = $ProdutoRepositorio->cadastrar($produto);

    if (!$sucess) {
        echo 'Erro ao cadastrar o produto.';
    } else {
        header("location: formulario_produto.php");
        exit();
    }
}
