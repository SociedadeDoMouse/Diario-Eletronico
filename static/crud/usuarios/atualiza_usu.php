<?php

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";

$id		  		= $_POST["id_usur"];
$nome 			= $_POST["nome"];
$usuario		= $_POST["usuario"];
$email			= $_POST["email"];
$nivel			= $_POST["funcao"];

$sql = "update usuario set ";
$sql .= " usuario= '$usuario', email= '$email', funcao= '$nivel', nome= '$nome'";
$sql .= " where id_usur = '".$id."';";

$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if($resultado){
	header('Location: \dashboard.php?page=lista_usu&msg=2');
    mysqli_close($con);
}else{
	header('Location: \dashboard.php?page=lista_usu&msg=6');
    mysqli_close($con);
}

?>
