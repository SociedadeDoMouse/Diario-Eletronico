<?php

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor'
);
include "base/testa_nivel.php";

$id = (int) @$_GET['id_curso'];

$sql = "delete from coordena where id_curso = '$id';"; 

$sql2 = "delete from curso where id_curso = '$id';"; 
 
$resultado = mysqli_query($con, $sql)or die(mysqli_error());

$resultado = mysqli_query($con, $sql2)or die(mysqli_error());

if($resultado){
    header('location: \dashboard.php?page=lista_curso&msg=3');
    mysqli_close($con);
}else{
    header('Location: \dashboard.php?page=lista_curso&msg=4');
    mysqli_close($con);
}
?>
