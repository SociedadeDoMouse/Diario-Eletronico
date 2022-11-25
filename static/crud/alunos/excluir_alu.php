<?php

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
include "base/testa_nivel.php";

$matricula = (int) @$_GET['mat_aluno'];
 
$sql = "delete from aluno where mat_aluno = '$matricula';"; 

$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if($resultado){
    header('location: \dashboard.php?page=lista_alu&msg=3');
    mysqli_close($con);
}else{
    header('Location: \dashboard.php?page=lista_alu&msg=4');
    mysqli_close($con);
}
?>
