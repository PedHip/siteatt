<?php
class ProdutoRepositorio
{
    private $conn; // Sua conexão com o banco de dados
    
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function cadastrar(Produto $produto)
    {
        $sql = "INSERT INTO produto (classificacao, nome, descprod, img_prod) VALUES (?, ?, ?, ?)";
        
        // Prepare a declaração
        $stmt = $this->conn->prepare($sql);

        // Verifique se a preparação da declaração falhou
        if ($stmt === false) {
            // Capture e exiba o erro
            die("Erro na preparação da declaração: " . $this->conn->error);
        }

        // Armazene os valores em variáveis temporárias
        $classificacao = $produto->getClassificacao();
        $nome = $produto->getNome();
        $descprod = $produto->getDescprod();
        $img_prod = $produto->getImg_prodDiretorio();

        // Bind dos parâmetros
        $stmt->bind_param("ssss", $classificacao, $nome, $descprod, $img_prod);

        // Execute a declaração
        $resultado = $stmt->execute();

        // Verifique se a execução falhou
        if ($resultado === false) {
            die("Erro ao executar a declaração: " . $stmt->error);
        }

        // Fecha a declaração
        $stmt->close();

        return $resultado;
    }
}
?>