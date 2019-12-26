<?php 

class Usuario{

	private $pdo;
	private $id;
	private $nome;

	public function __construct(){
		try {
			$this->pdo = new PDO("mysql:dbname=new_ranking;host=localhost", "mariojunior", "admproject123");
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function logar($user, $pass){
	    $usuario = addslashes($user);
	    $senha = md5(addslashes($pass));

	    $sql = "SELECT * FROM users WHERE name = '".$usuario."'";
	    $sql = $this->pdo->query($sql);

	    // Definindo msg de possivéis erros
	    $message_error_login = "Usuario ou senha inválido!";

	      if($sql->rowCount() > 0){
	        $ln = $sql->fetch();
	        $id_user_db = $ln['id'];
	        $user_db = $ln['name'];
	        $pass_db = $ln['pass'];
	        if(isset($_POST['usuario']) && isset($_POST['senha'])){
	          if($usuario == $user_db && $senha == $pass_db){
	            $_SESSION['id_user'] = $id_user_db;
	            header("Location: dashboard.php");
	            exit;
	          }else{
	          	return $message_error_login; 
	          }
	        }else{
	        	return $message_error_login;           
	        }
	    }else{
	    	return $message_error_login;
	    }
	}

	public function loginAuth($session){

		if (isset($session) && !empty($session) ) {
    		$id_user_logado = $session;

			$sql = $this->pdo->prepare("SELECT id, name FROM users WHERE id = :id");
			$sql->bindValue(":id", $id_user_logado);
			$sql->execute();
			if($sql->rowCount() > 0){
				$ln = $sql->fetch();
				$this->id = $ln['id'];
				$this->nome = $ln['name'];;
			}
		}else{
			header("Location: index.php");
			exit;
		}
	}

	public function logout(){
		session_start();
		unset($_SESSION['id_user']);
	}

	public function getId(){
		return $this->id;
	} 

	public function getNome(){
		return $this->nome;
	}

}

