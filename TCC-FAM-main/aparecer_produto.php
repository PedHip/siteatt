<?php

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
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cadastro de produtos</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/produtos.css">
    <link rel="stylesheet" href="styles/form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>
<body>


    
</body>
</html>