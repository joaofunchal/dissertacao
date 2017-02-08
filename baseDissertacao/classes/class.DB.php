<?php
class DB{
	
	var $con = null;
	var $res = null;
	var $record = array();
	private $usuario = 'postgres';
	private $senha = 'develop';
	private $host = 'localhost';
	private $nomeBanco = 'postgres';
	
	public function __construct(){
		$this->con = new PDO("pgsql:dbname={$this->nomeBanco};host={$this->host}", $this->usuario, $this->senha);
		return $this->con;
	}

	public function query($str){
		$this->res = $this->con->prepare($str);
		$this->res->execute();
		return $this->res;
	}
	
	public function numRows(){
		return $this->con->rowCount();
	}
	
	
}



?>