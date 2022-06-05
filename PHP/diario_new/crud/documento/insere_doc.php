<?php
    $tit              = $_POST["tit"];
    $desc             = $_POST["desc"];
    $status           = $_POST["status"];
    $versao           = $_POST["versao"];

    $date = new DateTime();
    $dataatu = $date->format('d.m.Y.H.i.s');
    $nomedoc = "DOCUMENTOS/".$dataatu.".pdf";

    move_uploaded_file($_FILES["arquivo"]["tmp_name"], $nomedoc);

    $sql = "insert into documento values ";
    $sql .= "('0','$tit','$desc','$nomedoc','$status','$versao');";

    $resultado = mysqli_query($con, $sql) or die(mysqli_error());

    if($resultado){
        header('Location: \siscrud/index.php?page=lista_doc&msg=1');
        mysqli_close($con);
    }else{
        header('Location: \siscrud/index.php?page=lista_doc&msg=4');
        mysqli_close($con);
    }
?>