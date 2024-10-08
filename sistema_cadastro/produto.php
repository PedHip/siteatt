<?php

class Produto {
    private $conn;
    private $table_name = "produtos";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function cadastrar($nome_prod, $desc_prod, $img_prod, $tipo_prod, $preco_prod) {
        $query = "INSERT INTO " . $this->table_name . " (nome_prod, desc_prod, img_prod, tipo_prod, preco_prod) VALUES (:nome_prod, :desc_prod, :img_prod, :tipo_prod, :preco_prod)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome_prod', $nome_prod);
        $stmt->bindParam(':desc_prod', $desc_prod);
        $stmt->bindParam(':img_prod', $img_prod);
        $stmt->bindParam(':tipo_prod', $tipo_prod);
        $stmt->bindParam(':preco_prod', $preco_prod);

        if($stmt->execute()) {
            return "Produto cadastrado com sucesso!";
        } else {
            return "Erro ao cadastrar produto.";
        }
    }

	public function buscarProdutos($term) {
		$query = "SELECT * FROM produtos WHERE nome_prod LIKE :term OR desc_prod LIKE :term OR id_prod LIKE :term OR tipo_prod LIKE :term";
		$stmt = $this->conn->prepare($query);
		$searchTerm = "%{$term}%";
		$stmt->bindParam(':term', $searchTerm);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	

	public function listarProdutos($pagina = 1, $limite = 10) {
        $offset = ($pagina - 1) * $limite;
        $query = "SELECT * FROM " . $this->table_name . " LIMIT :limite OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limite', $limite, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para contar o total de produtos
    public function contarProdutos() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

}

?>