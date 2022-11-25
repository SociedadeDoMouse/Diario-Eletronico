<?php

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";
	include "base/functions/registrar.php";
    reg(' Registrou Novo Curso.');

$id   = $_POST['id_curso'];
$nome = $_POST['nome_curso'];
$coord = $_POST['coordenador'];


$sql = "insert into curso values ";
$sql .= "('$id','$nome');";

$sql2 = mysqli_query($con,"SELECT id_cord FROM coordenador WHERE id_usur = $coord");
$info = mysqli_fetch_array($sql2);

$sql3 = "insert into coordena values ";
$sql3 .= "(0,'$id','".$info['id_cord']."');";

$resultado = mysqli_query($con, $sql) or die(mysqli_error($con));
$resultado3 = mysqli_query($con, $sql3) or die(mysqli_error($con));

if($resultado){
	header('Location: \dashboard.php?page=lista_curso&msg=1');
	mysqli_close($con);
}else{
	header('Location: \dashboard.php?page=lista_curso&msg=6');
	mysqli_close($con);
}
?>