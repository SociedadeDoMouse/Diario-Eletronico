<?php

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor'
);
	include "base/testa_nivel.php";

$id    		= $_GET['id_curso'];
$idnovo		= $_POST['id_curso'];
$nome 		= $_POST['nome_curso'];
$coord 		= $_POST['coordenador'];

$sql = "update curso set ";
$sql .= "id_curso = '$idnovo', nome_curso = '$nome'";
$sql .= " where id_curso = '".$id."';";

$sql2 = mysqli_query($con,"SELECT id_cord FROM coordenador WHERE id_usur = $coord");
$info = mysqli_fetch_array($sql2);

$sql3 = "update coordena set ";
$sql3 .= "id_curso = '$id', id_cord = '".$info['id_cord']."'";
$sql3 .= " where id_curso = '".$id."';";

$resultado = mysqli_query($con, $sql)or die(mysqli_error());

$resultado2 = mysqli_query($con, $sql3)or die(mysqli_error());

if($resultado){
	header('Location: \dashboard.php?page=lista_curso&msg=2');
    mysqli_close($con);
}else{
	header('Location: \dashboard.php?page=lista_curso&msg=6');
    mysqli_close($con);
}

?>
