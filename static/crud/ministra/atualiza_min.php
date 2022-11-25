<?php
    $cursa		   = $_POST["cursa"];
    $prof             = $_POST["prof"];
    $id_min        = $_POST['id_min'];

    $sql = "update ministra set ";
    $sql .= "mat_prof='".$prof."', ";
    $sql .= "id_cursa='".$cursa."' ";
    $sql .= " where id_ministra= '".$id_min."';";

    $resultado = mysqli_query($con, $sql);

    if($resultado){
        header('location: \dashboard.php?page=lista_min&msg=2');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>
