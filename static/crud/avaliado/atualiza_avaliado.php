<?php
    $nota	           = $_POST["nota"];
    $id_aval           = $_GET['id_aval'];
    $id_avaliado       = $_POST['id_avaliado'];

    $sql = "update avaliado set ";
    $sql .= "nota_avaliado='".$nota."'";
    $sql .= "where id_avaliado='".$id_avaliado."'";
    $resultado = mysqli_query($con, $sql);

    if($resultado){
        header('location: \dashboard.php?page=lista_avaliado&msg=2&id_aval='.$id_aval);
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>
