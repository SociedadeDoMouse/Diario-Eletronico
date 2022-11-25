<?php
    $usur	   = $_POST["usur"];
    $data	   = $_POST["data"];
    $tipo	   = $_POST["tipo"];
    $txt	   = $_POST["txt"];
    $id	       = $_POST["id"];

    $sql = "update mensagem set ";
    $sql .= "txt_msg='".$txt."', ";
    $sql .= "tipo_msg='".$tipo."', ";
    $sql .= "data_msg='".$data."', ";
    $sql .= "id_usur='".$usur."' ";
    $sql .= " where id_msg= '".$id."';";

    $resultado = mysqli_query($con, $sql);

    if($resultado){
        header('location: \dashboard.php?page=lista_alerta&msg=2');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>
