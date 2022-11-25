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

include "base/functions/registrar.php";
reg(' Registrou novo Usuário '.$nome.'.');

$sql = "insert into usuario values ";
$sql .= "('0','$usuario', '".sha1($senha)."','$email','1','$nivel','$nome','0');";

$resultado = mysqli_query($con, $sql) or die(mysqli_error($con));


$sql4 = "SELECT id_usur";
$sql4 .= " FROM usuario where usuario = '$usuario'"; 
$data_all = mysqli_query($con, $sql4) or die(mysqli_error());
$info = mysqli_fetch_array($data_all);


if($nivel == 3 && $resultado){
	$sql2 = "insert into coordenador values ";
	$sql2 .= "('0','".$info['id_usur']."');";
	$resultado2 = mysqli_query($con, $sql2) or die(mysqli_error($con));
}
  

if(isset($_POST['mat']) && $resultado){
	$mat	= $_POST["mat"];

	$sql2 = "insert into professor values ";
	$sql2 .= "('$mat','".$info['id_usur']."');";
	$resultado2 = mysqli_query($con, $sql2);
}

 if($resultado){
  	header('Location: \dashboard.php?page=lista_usu&id_usur='.$info['id_usur'].'&mat='.$mat);
 	mysqli_close($con);
 }else{
 	header('Location: \dashboard.php?page=lista_usu&msg=6');
 	mysqli_close($con);
 }
?>