<?php

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";

$nome 			= $_POST["nome"];
$usuario		= $_POST["usuario"];
$senha			= $_POST["senha"];
$email			= $_POST["email"];
$nivel			= $_POST["nivel"];

$sql = "insert into usuario values ";
$sql .= "('0','$usuario', '".sha1($senha)."','$email','1','$nivel','$nome');";

$resultado = mysqli_query($con, $sql) or die(mysqli_error($con));

if($resultado){
	header('Location: \diario_new/dashboard.php?page=lista_usu&msg=1');
	mysqli_close($con);
}else{
	header('Location: \diario_new/dashboard.php?page=lista_usu&msg=6');
	mysqli_close($con);
}
?>