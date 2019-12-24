<?php

class ColabP15{

	private $pdo;

	private $id;

	public function __construct(){
		try {
			$this->pdo = new PDO("mysql:dbname=new_ranking;host=localhost", "mariojunior", "admproject123");
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function listarTodos(){
		return $this->pdo->query("SELECT * FROM p15");
	}

	public function cadastrarColab($nome, $valor, $data){
		$nome = addslashes($nome);
        $valor = addslashes($valor);
        $data = addslashes($data);

        $sql = $this->pdo->prepare("INSERT INTO p15 SET nome = :nome, resultado = :valor, data = NOW()");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":valor", $valor);
        $sql->execute();
	}

	public function valorTotal(){
		$STH_SELECT = $this->pdo->query("SELECT sum(resultado) FROM p15");
        $totalSoma = $STH_SELECT->fetchColumn();
		return $value_formated = number_format($totalSoma, 2, ',', '.');
	}

	public function colabAuth($id_colab){
		$sql = $this->pdo->prepare("SELECT * FROM p15 WHERE id = :id");
		$sql->bindValue(":id", $id_colab);
		$sql->execute();
		if($sql->rowCount() > 0){
			$ln = $sql->fetch();
			$id = $ln['id'];
			$nome = $ln['nome'];
			$resultado = $ln['resultado'];
			$data = $ln['data'];
			return array('id' => $id, 'nome' => $nome, 'resultado' => $resultado, 'data' => $data);
		}else{
			return array();
		}
	}

	public function remove($id_remove){
		$sql = $this->pdo->prepare("DELETE FROM p15 WHERE id = :id");
		$sql->bindValue(":id", $id_remove);
		$sql->execute();
		$this->listarTodos();
	}

	public function updateColab($id_edit, $nome_edit, $valor_edit, $data_edit){
		 $sql = $this->pdo->prepare("UPDATE p15 SET nome = ?, resultado = ?, data = ? WHERE id = ?");
        $sql->execute(array($nome_edit, $valor_edit, $data_edit, $id_edit));
	}
}