<?php
    $cursa		   = $_POST["cursa"];
    $prof             = $_POST["prof"];

    include "base/functions/registrar.php";
    reg(' Registrou novo ministra.');

    $sql = "insert into ministra values ";
    $sql .= "(0,'$cursa','$prof');";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('location: \dashboard.php?page=lista_min&msg=1');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>