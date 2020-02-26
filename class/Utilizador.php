<?php
class Utilizador {
	private $idutilizador;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdutilizador(){
		return $this->idutilizador;
	}
	public function setIdutilizador($iduser){
		$this->idutilizador = $iduser;
	}
	public function getDeslogin(){
		return $this->deslogin;
	}
	public function setDeslogin($deslogin){
		$this->deslogin = $deslogin;
	}
	public function getDessenha(){
		return $this->dessenha;
	}
	public function setDessenha($dessenha){
		$this->dessenha = $dessenha;
	}
	public function getDtcadastro(){
		return $this->dtcadastro;
	}
	public function setDtcadastro($dtcadastro){
		$this->dtcadastro = $dtcadastro;
	}

	public function loadById($id){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_utilizadores WHERE idutilizador = :ID", array(
			":ID" => $id
		));
		if( count($results) > 0 ) {
			$row = $results[0];

			$this->setIdutilizador($row['idutilizador']);
			$this->setDeslogin($row['deslogin']);

			$this->setDessenha($row['dessenha']);

			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}
	}
	public function __toString(){
		return json_encode(array(
			"idutilizador" => $this->getIdutilizador(),
			"deslogin" => $this->getDeslogin(),
			"dessenha" => $this->getDessenha(),
			"dtcadastro" => $this->getDtcadastro()->format("d/m/Y"),
		));
	}

	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_utilizadores ORDER BY deslogin");
	}
	public static function search($login) {
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_utilizadores WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
		':SEARCH' => "%" .$login. "%"
		));
	}
	public function login($login, $password) {
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_utilizadores WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			':LOGIN' => $login,
			':PASSWORD' => $password
		));
		if( count($results) > 0 ) {
			$row = $results[0];

			$this->setIdutilizador($row['idutilizador']);
			$this->setDeslogin($row['deslogin']);

			$this->setDessenha($row['dessenha']);

			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		} else {
			throw new Exception("Login e/ou senha inválidos", 1);
		}
	}

}

 ?>
