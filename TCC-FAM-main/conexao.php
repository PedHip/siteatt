<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "bd_fam";

//criação da conexão
$conn = new mysqli($servername, $username, $password, $databasename);

// verificando a conexão
// if (!$conn){
//     echo "não foi possível conectar ao banco de dados";
// } else
//     echo "conectado"
?>