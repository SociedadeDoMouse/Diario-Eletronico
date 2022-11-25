<?php
    $min	   = $_POST["min"];
    $titulo           = $_POST["titulo"];
    $desc            = $_POST["desc"];
    $data            = $_POST["data"];
    $id_cont       = $_POST['id_cont'];

    $sql = "update conteudo set ";
    $sql .= "id_ministra='".$min."', ";
    $sql .= "titulo_cont='".$titulo."', ";
    $sql .= "desc_cont='".$desc."', ";
    $sql .= "data_cont='".$data."' ";
    $sql .= " where id_cont= '".$id_cont."';";

    $resultado = mysqli_query($con, $sql);

    if($resultado){
        header('location: \dashboard.php?page=lista_cont&msg=2');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>
