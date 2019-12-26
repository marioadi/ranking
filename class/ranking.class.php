<?php

class Ranking{

	private $pdo;

	public function __construct(){
		try{
			$this->pdo = new PDO("mysql:dbname=new_ranking;host=localhost", "mariojunior", "admproject123");
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
		}catch(PDOException $e){
			die($e->getMessage());
		}	
	}


	public function searchResultPcj(){
		$sql = $this->pdo->query("SELECT id, nome, resultado FROM pcj ORDER BY resultado DESC");
		return $sql;
	}

	public function searchResultPtc(){
		$sql = $this->pdo->query("SELECT id, nome, resultado FROM ptc ORDER BY resultado DESC");
		return $sql;
	}

	public function searchResultP15(){
		$sql = $this->pdo->query("SELECT id, nome, resultado FROM p15 ORDER BY resultado DESC");
		return $sql;
	}

} 


?>