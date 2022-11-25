<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
);
	include "base/testa_nivel.php";
    include "base/functions/registrar.php";
    reg(' Registrou Novo(s) Dia(s) de Aula.');

    $min		   = $_POST["min"];

    $i = 0;
    while (isset($_POST[$i])) {
        $sql = "insert into data_aula values ";
        $sql .= "(0,'$min','".$_POST[$i]."');";

        $resultado = mysqli_query($con, $sql)or die(mysqli_error());
        $i++;
    }
    

    if($resultado){
        header('location: \dashboard.php?page=lista_dia&msg=1');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>