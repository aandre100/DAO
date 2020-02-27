<?php
require_once("config.php");

// $sql = new Sql();
// $result = $sql->select("SELECT * FROM tb_utilizadores");
// echo '<pre>';
// var_dump($result);
// echo '</pre>';
// $user = new Utilizador();
// $user->loadById(3);
// echo $user;
// echo json_encode($user->getList());
// $lista = Utilizador::search('andre');
//
// echo json_encode($lista);

// $usera = new Utilizador();
// $usera->login("pato","1234532");
// echo "<br>";
// echo $usera;

// $aluno = new Utilizador();
//
//
// $aluno->insert();
// echo $aluno;


$utilizador = new Utilizador();

$utilizador->loadById(6);

echo $utilizador;
$utilizador->update("teste id 6", "password do 6");
echo $utilizador;


 ?>
