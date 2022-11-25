<?php
    include "base/functions/registrar.php";
    reg(' Inseriu novo Ano Letivo.');

    $dt_ini		   = $_POST["dt_ini"];
    $dt_fim            = $_POST["dt_fim"];
    $obs            = $_POST["obs"];


    $sql = "insert into ano_letivo values ";
    $sql .= "(0,'$dt_ini','$dt_fim','$obs');";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('location: \dashboard.php?page=lista_ano&msg=1');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>