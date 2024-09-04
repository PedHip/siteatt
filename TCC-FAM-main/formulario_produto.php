

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
    <div class="FormContainer">
                
        <form action="processar_produto.php" method="POST" enctype="multipart/form-data">
            <br>
            <div class="inputBox">
                <label for="nome">nome do produto</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
            <br>
            <div class="inputBox">
                <label for="descprod">Descrição do produto</label>
                <input type="text" name="descprod" id="descprod" class="form-control" required>
            </div>
            <br>
            <div class="inputBox">
                <label for="classificacao">classificação do produto</label>
                <input type="text" name="classificacao" id="classificacao" class="form-control" required>
            </div>
            <br>
            <div class="inputBox">
                <label for="img_prod">imagem do produto</label>
                <input type="file" name="img_prod" id="img_prod" class="form-control" required>
            </div>
            <br>
            <input type="submit" name="submit" id="submit" class="btn btn-primary mb-2">
        </form>
    </div>
    
</body>
</html>