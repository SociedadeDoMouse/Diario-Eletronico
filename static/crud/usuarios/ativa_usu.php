<?php

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";

$id = (int) $_GET['id_usur'];

$sql = "update usuario set ";
$sql .= "ativo='1' ";
$sql .= "where id_usur = '".$id."';";

$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if($resultado){
	header('Location: \dashboard.php?page=lista_usu&msg=5');
    mysqli_close($con);
}else{
	header('Location: \dashboard.php?page=lista_usu&msg=6');
    mysqli_close($con);
}
?>
