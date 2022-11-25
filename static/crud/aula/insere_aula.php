<?php
    include "base/functions/registrar.php";
    reg(' Inseriu novo Registro de Aulas.');

    $min	             = $_POST["min"];
    $trim                = $_POST["trim"];
    $aula_prev           = $_POST["aula_prev"];
    $aula_min            = $_POST["aula_min"];


    $sql = "insert into aula values ";
    $sql .= "(0,'$min','$trim','$aula_prev','$aula_min');";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());
    

    if($resultado){
        header('location: \dashboard.php?page=lista_aula&msg=1');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>