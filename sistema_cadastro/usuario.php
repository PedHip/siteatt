<?php
require_once 'db.php';

class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

	public function cadastrar($nome, $telefone, $email, $senha) {
		// Primeiro, verifica se o email já está cadastrado
		$query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE email = :email";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		
		if ($stmt->fetchColumn() > 0) {
			return false; // Email já cadastrado
		}
	
		// Se não existir, insira o novo usuário
		$query = "INSERT INTO " . $this->table_name . " (nome, telefone, email, senha) VALUES (:nome, :telefone, :email, :senha)";
		$stmt = $this->conn->prepare($query);
	
		// Bind dos parâmetros
		$stmt->bindParam(':nome', $nome);
		$stmt->bindParam(':telefone', $telefone);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':senha', $senha);
	
		return $stmt->execute(); // Retorna true se a inserção for bem-sucedida
	}

	public function autenticar($email, $senha) {
		$query = "SELECT senha, tipo_usuario FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$email = htmlspecialchars(strip_tags($email));
		$stmt->bindParam(':email', $email);
		$stmt->execute();
	
		if ($stmt->rowCount() == 1) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if (password_verify($senha, $row['senha'])) {
				return $row['tipo_usuario']; // Retorna o tipo de usuário se a autenticação for bem-sucedida
			}
		}
		return false; // Login falhou
	}
	

	public function getTipoUsuario($email) {
		$query = "SELECT tipo_usuario FROM " . $this->table_name . " WHERE email = :email LIMIT 1";
		$stmt = $this->conn->prepare($query);
		$email = htmlspecialchars(strip_tags($email));
		$stmt->bindParam(':email', $email);
		$stmt->execute();
	
		if ($stmt->rowCount() == 1) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['tipo_usuario']; // Retorna o tipo de usuário
		}
		return null; // Se não encontrado
	}
	

	public function editarUsuario($idAtual, $idNovo, $tipo_usuario, $nome, $telefone, $email, $senha = null) {
		// Verifica se o novo email já existe
		if ($this->emailExistente($email, $idAtual)) {
			return false; // Email já está em uso
		}
	
		// Verifica se o novo ID já existe
		if ($this->idExistente($idNovo, $idAtual)) {
			return false; // ID já está em uso
		}
	
		// Resto da lógica de atualização
		$query = "UPDATE " . $this->table_name . " SET id = :idNovo, tipo_usuario = :tipo_usuario, nome = :nome, telefone = :telefone, email = :email";
		
		if (!empty($senha)) {
			$query .= ", senha = :senha";
		}
		
		$query .= " WHERE id = :idAtual";
		
		$stmt = $this->conn->prepare($query);
		
		// Bind dos parâmetros
		$stmt->bindParam(':idAtual', $idAtual);
		$stmt->bindParam(':idNovo', $idNovo);
		$stmt->bindParam(':tipo_usuario', $tipo_usuario);
		$stmt->bindParam(':nome', $nome);
		$stmt->bindParam(':telefone', $telefone);
		$stmt->bindParam(':email', $email);
		
		// Se a senha não for nula ou vazia, faz o hash e faz bind
		if (!empty($senha)) {
			$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
			$stmt->bindParam(':senha', $senhaHash);
		}
		
		return $stmt->execute();
	}
	

    public function apagarUsuario($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function emailExistente($email, $idAtual) {
        $query = "SELECT COUNT(*) FROM usuarios WHERE email = :email AND id <> :idAtual";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':idAtual', $idAtual);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Retorna true se o email já existe
    }

	public function idExistente($idNovo, $idAtual) {
        $query = "SELECT COUNT(*) FROM usuarios WHERE id = :idNovo AND id <> :idAtual";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idNovo', $idNovo);
        $stmt->bindParam(':idAtual', $idAtual);
        $stmt->execute();
        return $stmt->fetchColumn() > 0; // Retorna true se o ID já existe
    }
	

	public function buscarUsuarios($term) {
		// Prepara a consulta
		$query = "SELECT * FROM " . $this->table_name . " WHERE 
				  nome LIKE :term OR 
				  email LIKE :term OR 
				  telefone LIKE :term";
	
		// Adiciona a pesquisa por ID com LIKE
		if (is_numeric($term)) {
			$query .= " OR id LIKE :id";
		}
	
		$stmt = $this->conn->prepare($query);
		
		// Prepara o termo de pesquisa
		$likeTerm = "%" . $term . "%"; // Para busca parcial
		$stmt->bindParam(':term', $likeTerm);
	
		// Para a pesquisa por ID
		if (is_numeric($term)) {
			$stmt->bindParam(':id', $likeTerm); // Usa o mesmo LIKE
		}
	
		$stmt->execute();
		
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function listarUsuarios($pagina = 1, $limite = 15) {
		$offset = ($pagina - 1) * $limite;
		$query = "SELECT * FROM " . $this->table_name . " LIMIT :limite OFFSET :offset";
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindParam(':limite', $limite, PDO::PARAM_INT);
		$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		
		$stmt->execute();
		
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function contarUsuarios() {
		$query = "SELECT COUNT(*) as total FROM " . $this->table_name;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		return $resultado['total'];
	}
	
}
?>
