<?php
    $min	                  = $_POST["min"];
    $trim                     = $_POST["trim"];
    $nt_max                   = $_POST["nt_max"];
    $tipo_aval                = $_POST["tipo_aval"];
    $desc_aval                = $_POST["desc_aval"];
    $id_aval                  = $_POST['id_aval'];

    $sql = "update avaliacao set ";
    $sql .= "id_ministra='".$min."', ";
    $sql .= "nota_max='".$nt_max."', ";
    $sql .= "desc_aval='".$desc_aval."', ";
    $sql .= "tipo_aval='".$tipo_aval."', ";
    $sql .= "trimestre='".$trim."' ";
    $sql .= " where id_aval= '".$id_aval."';";

    $resultado = mysqli_query($con, $sql);

    if($resultado){
        header('location: \dashboard.php?page=lista_aval&msg=2');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>
