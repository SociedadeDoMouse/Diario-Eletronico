<?php
    $curso		   = $_POST["curso"];
    $nome             = $_POST["nome"];
    $id_disc        = $_POST['id_disc'];

    $sql = "update disciplina set ";
    $sql .= "id_curso='".$curso."', ";
    $sql .= "nome_disc='".$nome."' ";
    $sql .= " where id_disc= '".$id_disc."';";

    $resultado = mysqli_query($con, $sql);

    if($resultado){
        header('location: \dashboard.php?page=lista_disc&msg=2');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>
