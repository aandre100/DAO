<?php
require_once("config.php");

// $sql = new Sql();
// $result = $sql->select("SELECT * FROM tb_utilizadores");
// echo '<pre>';
// var_dump($result);
// echo '</pre>';
$user = new Utilizador();
$user->loadById(3);
echo $user
 ?>
