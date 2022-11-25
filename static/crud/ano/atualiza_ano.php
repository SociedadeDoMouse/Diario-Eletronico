<?php
    $dt_ini		   = $_POST["dt_ini"];
    $dt_fim             = $_POST["dt_fim"];
    $obs       = $_POST['obs'];
    $id_ano       = $_POST['id_ano'];

    $sql = "update ano_letivo set ";
    $sql .= "data_inicio='".$dt_ini."', ";
    $sql .= "data_fim='".$dt_fim."', ";
    $sql .= "observacao='".$obs."' ";
    $sql .= " where id_ano= '".$id_ano."';";

    $resultado = mysqli_query($con, $sql);

    if($resultado){
        header('location: \dashboard.php?page=lista_ano&msg=2');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>
