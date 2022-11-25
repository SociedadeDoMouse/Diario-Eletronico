<?php
    $curso		     = $_POST["curso"];
    $nome            = $_POST["nome"];
    $nome2           = $_POST["nome2"];

    include "base/functions/registrar.php";
    reg(' Registrou Nova Disciplina.');

    $sql = "insert into disciplina values ";
    $sql .= "(0,'".$nome." ".$nome2."','$curso');";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('location: \dashboard.php?page=lista_disc&msg=1');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>