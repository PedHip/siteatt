<?php

require_once 'db.php';
require_once 'Produto.php';

class Pedido {
    private $conn;
    private $table_name = "pedidos";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Função para cadastrar um novo pedido
    public function cadastrarPedido($usuario_pedido, $usuario_contato, $produtos, $preco_total) {
        $query = "INSERT INTO " . $this->table_name . " (usuario_pedido, usuario_contato, produtos, preco_total) VALUES (:usuario_pedido, :usuario_contato, :produtos, :preco_total)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':usuario_pedido', $usuario_pedido);
        $stmt->bindParam(':usuario_contato', $usuario_contato);
        $produtosFormatadosString = implode(", ", $produtos);
        $stmt->bindParam(':produtos', $produtosFormatadosString);
        $stmt->bindParam(':preco_total', $preco_total); // Adiciona o preço total

        return $stmt->execute();
    }

    // Função para buscar pedido por ID
    public function buscarPedidoPorId($id_pedido) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_pedido = :id_pedido";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Função para listar pedidos com paginação
    public function listarPedidos($pagina = 1, $limite = 10) {
        $offset = ($pagina - 1) * $limite;
        $query = "SELECT * FROM " . $this->table_name . " LIMIT :limite OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limite', $limite, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
