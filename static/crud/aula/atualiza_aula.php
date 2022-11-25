<?php
    $min	             = $_POST["min"];
    $trim                = $_POST["trim"];
    $aula_prev           = $_POST["aula_prev"];
    $aula_min            = $_POST["aula_min"];
    $id_aula       = $_POST['id_aula'];

    $sql = "update aula set ";
    $sql .= "id_ministra='".$min."', ";
    $sql .= "trimestre='".$trim."', ";
    $sql .= "aula_prev='".$aula_prev."', ";
    $sql .= "aula_min='".$aula_min."' ";
    $sql .= " where id_aula= '".$id_aula."';";

    $resultado = mysqli_query($con, $sql);

    if($resultado){
        header('location: \dashboard.php?page=lista_aula&msg=2');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>
