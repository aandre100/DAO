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

			$this->setData($results[0]);

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

			$this->setData($results[0]);

		} else {
			throw new Exception("Login e/ou senha inválidos", 1);
		}
	}
	public function setData($data){
		$this->setIdutilizador($data['idutilizador']);
		$this->setDeslogin($data['deslogin']);

		$this->setDessenha($data['dessenha']);

		$this->setDtcadastro(new DateTime($data['dtcadastro']));
	}
	public function insert(){
		$sql = new Sql();
		$results = $sql->select("CALL sp_utilizadores_insert(:LOGIN, :PASSWORD)", array(
			':LOGIN' => $this->getDeslogin(),
			':PASSWORD' => $this->getDessenha()
		));
		if(count($results) > 0){
			$this->setData($results[0]);
		}else {
			echo "Não deu";
		}
	}
	public function update($login, $password){
		$this->setDeslogin($login);
		$this->setDessenha($password);
		$sql = new Sql();
		$sql->query("UPDATE tb_utilizadores SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idutilizador = :ID", array(
			':LOGIN' => $this->getDeslogin(),
			':PASSWORD' => $this->getDessenha(),
			':ID' => $this->getIdutilizador()
		));
	}



	public function __construct($login = '', $password = ''){
		$this->setDeslogin($login);
		$this->setDessenha($password);
	}


}

 ?>
