<?php

    $txt     	     = $_POST["txt"];
    $tipo            = $_POST["tipo"];

    $sql = "insert into mensagem values ";
    $sql .= "(0,'".$txt."', ".$tipo.", current_timestamp ,'".$_SESSION['UsuarioID']."');";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('location: \dashboard.php?page=lista_alerta&msg=1');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
    
?>