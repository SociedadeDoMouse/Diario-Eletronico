<?php

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";

$turma = (int) $_POST['n_turma'];


$sql = "delete from enturmado where n_turma = $turma;"; 
$resultado = mysqli_query($con, $sql)or die(mysqli_error());

$sql2 = "delete from cursa where n_turma = $turma;"; 
$resultado = mysqli_query($con, $sql2)or die(mysqli_error());

$sql3 = "delete from turma where n_turma = $turma;"; 
$resultado = mysqli_query($con, $sql3)or die(mysqli_error());

if($resultado){
    header('location: \dashboard.php?page=lista_turm&msg=3');
    mysqli_close($con);
}else{
    header('Location: \dashboard.php?page=lista_turm&msg=4');
    mysqli_close($con);
}

?>
