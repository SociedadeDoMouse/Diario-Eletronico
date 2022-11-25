<?php
    $mat             = $_POST["mat"];
    $disc               = $_POST["disc"];
    $ano               = $_POST["ano"];

    include "base/functions/registrar.php";
    reg(' Matriculou novo aluno.');

    $sql = "insert into matriculado values ";
    $sql .= "(0,'$ano','$disc','$mat');";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('location: \dashboard.php?page=lista_mat&msg=1');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>