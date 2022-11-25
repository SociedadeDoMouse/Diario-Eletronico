<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";


    $n_turma             = $_POST["n_turma"];
    $turno               = $_POST["turno"];
    $curso               = $_POST["curso"];
    $modalidade          = $_POST["modalidade"];
    $ano                 = $_POST["ano"];

    include "base/functions/registrar.php";
    reg(' Registrou Turma '.$n_turma.'.');

    $sql = "insert into turma values ";
    $sql .= "('$n_turma','$turno','$curso','$modalidade','$ano');";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('location: \dashboard.php?page=lista_turm&msg=1');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>