<?php
    $id               = $_POST["id"];
    $tit              = $_POST["tit"];
    $desc             = $_POST["desc"];
    $status           = $_POST["status"];
    $versao           = $_POST["versao"];

    

    $sql = "update documento set ";
    $sql .= "tit_doc='".$tit."',";

    if (isset($_FILES["arquivo"]["tmp_name"])) {

        $date = new DateTime();
        $dataatu = $date->format('d.m.Y.H.i.s');
        $nomedoc = "DOCUMENTOS/".$dataatu.".pdf";
        
        move_uploaded_file($_FILES["arquivo"]["tmp_name"], $nomedoc);

        $sql .= "local_doc='".$nomedoc."',";
    }



    
    $sql .= "desc_doc='".$desc."', status_doc='".$status."', versao_doc='".$versao."'";
    $sql .= "where id_doc = '".$id."';";

    $resultado = mysqli_query($con, $sql) or die(mysqli_error());

    if($resultado){
        header('Location: \siscrud/index.php?page=lista_doc&msg=2');
        mysqli_close($con);
    }else{
        header('Location: \siscrud/index.php?page=lista_doc&msg=4');
        mysqli_close($con);
    }
?>
