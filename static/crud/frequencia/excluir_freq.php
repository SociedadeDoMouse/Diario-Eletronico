<?php

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
include "base/testa_nivel.php";

if(isset($_GET['id_freq'])){
    $id_freq = (int) @$_GET['id_freq'];

    $turma = $_GET['turma'];
    $disc = $_GET['disc'];
    $ano = $_GET['ano'];
    
    $sql = "delete from frequencia where id_freq = '$id_freq';"; 

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());
}

if(isset($_GET['data_freq'])){
    $data_freq = $_GET['data_freq'];

    $turma = $_GET['turma'];
    $disc = $_GET['disc'];
    $ano = $_GET['ano'];
    
    $sql = "delete from frequencia where data_freq = '$data_freq';"; 

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());
}

if($resultado){
    header('location: \dashboard.php?page=lista_freq&turma='.$turma.'&disc='.$disc.'&ano='.$ano.'&msg=3');
    mysqli_close($con);
}else{
    header('Location: \dashboard.php?page=lista_freq&msg=4');
    mysqli_close($con);
}
?>
