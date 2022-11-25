<?php
    $nivel_necessario = array(
        1 => 'Administrador',
        2 => 'Diretor',
        3 => 'Coodernador'
    );
    include "base/testa_nivel.php";

    $freq		  = $_GET["id_freq"];

    $turma = $_GET['turma'];
    $disc = $_GET['disc'];
    $ano = $_GET['ano'];

    $sql = "update frequencia set status='2' where id_freq = $freq";

    $resultado = mysqli_query($con, $sql);


    if($resultado){
        header('location: \dashboard.php?page=lista_freq&turma='.$turma.'&disc='.$disc.'&ano='.$ano);
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php');
        mysqli_close($con);
    }
?>
