<?php

/**
 * 
 */
class Colaboradores{
	
	private $pdo;

	public function __construct(){
		try{
			$this->pdo = new PDO("mysql:dbname=new_ranking;host=localhost","mariojunior","admproject123");
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}

	// LISTAR ********************************************************************************************
	public function listAllPcj(){
		return $this->pdo->query("SELECT * FROM pcj");
	}

	public function listAllPtc(){
		return $this->pdo->query("SELECT * FROM ptc");
	}

	public function listAllP15(){
		return $this->pdo->query("SELECT * FROM p15");
	}

	// CADASTRO ******************************************************************************************
	public function addColabPcj($nome, $valor){
		$nome = addslashes($nome);
		$valor = addslashes($valor);

		$sql = $this->pdo->prepare("INSERT INTO pcj SET nome = :nome, resultado = :valor, data = NOW()");
		$sql->bindValue(":nome", $nome);
		$sql->bindValue(":valor", $valor);
		$sql->execute();
	}

	public function addColabPtc($nome, $valor){
		$nome = addslashes($nome);
		$valor = addslashes($valor);

		$sql = $this->pdo->prepare("INSERT INTO ptc SET nome = :nome, resultado = :valor, data = NOW()");
		$sql->bindValue(":nome", $nome);
		$sql->bindValue(":valor", $valor);
		$sql->execute();
	}

	public function addColabP15($nome, $valor){
		$nome = addslashes($nome);
		$valor = addslashes($valor);

		$sql = $this->pdo->prepare("INSERT INTO p15 SET nome = :nome, resultado = :valor, data = NOW()");
		$sql->bindValue(":nome", $nome);
		$sql->bindValue(":valor", $valor);
		$sql->execute();
	}


	// ATUALIZAR DADOS ***********************************************************************************
	public function updateColabPcj($id_edit, $nome_edit, $valor_edit, $data_edit){
		$this->pdo->prepare("UPDATE p15 SET nome = ?, valor = ?, data = ? WHERE id = ?");
		$this->pdo->execute(array($nome_edit, $valor_edit, $data_edit, $id_edit));
	}

	public function updateColabPtc($id_edit, $nome_edit, $valor_edit, $data_edit){
		$this->pdo->prepare("UPDATE ptc SET nome = ?, valor = ?, data = ? WHERE id = ?");
		$this->pdo->execute(array($nome_edit, $valor_edit, $data_edit, $id_edit));
	}

	public function updateColabP15($id_edit, $nome_edit, $valor_edit, $data_edit){
		$this->pdo->prepare("UPDATE p15 SET nome = ?, valor = ?, data = ? WHERE id = ?");
		$this->pdo->execute(array($nome_edit, $valor_edit, $data_edit, $id_edit));
	}

	// PEGAR DADOS ***************************************************************************************
	public function colabAuthPcj($id_colab){
		$sql = $this->pdo->prepare("SELECT * FROM pcj WHERE id = :id");
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

	public function colabAuthPtc($id_colab){
		$sql = $this->pdo->prepare("SELECT * FROM ptc WHERE id = :id");
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

	public function colabAuthP15($id_colab){
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

	// REMOVER ********************************************************************************************
	public function removeColabPcj($id_remove){
		$sql = $this->pdo->prepare("DELETE FROM pcj WHERE id = :id");
		$sql->bindValue(":id", $id_remove);
		$sql->execute();
		$this->listAllPcj();
	}

	public function removeColabPtc($id_remove){
		$sql = $this->pdo->prepare("DELETE FROM ptc WHERE id = :id");
		$sql->bindValue(":id", $id_remove);
		$sql->execute();
		$this->listAllPtc();
	}

	public function removeColabP15($id_remove){
		$sql = $this->pdo->prepare("DELETE FROM p15 WHERE id = :id");
		$sql->bindValue(":id", $id_remove);
		$sql->execute();
		$this->listAllP15();
	}

	//VALOR TOTAL RESULTADO
	public function amountPcj(){
		$STH_SELECT = $this->pdo->query("SELECT sum(resultado) FROM pcj");
        $totalSoma = $STH_SELECT->fetchColumn();
		return $value_formated = number_format($totalSoma, 2, ',', '.');
	}

	public function amountPtc(){
		$STH_SELECT = $this->pdo->query("SELECT sum(resultado) FROM ptc");
        $totalSoma = $STH_SELECT->fetchColumn();
		return $value_formated = number_format($totalSoma, 2, ',', '.');
	}

	public function amountP15(){
		$STH_SELECT = $this->pdo->query("SELECT sum(resultado) FROM p15");
        $totalSoma = $STH_SELECT->fetchColumn();
		return $value_formated = number_format($totalSoma, 2, ',', '.');
	}
}


?>