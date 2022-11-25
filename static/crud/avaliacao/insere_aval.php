<?php
    $min	                  = $_POST["min"];
    $trim                     = $_POST["trim"];
    $nt_max                   = $_POST["nt_max"];
    $tipo_aval                = $_POST["tipo_aval"];
    $desc_aval                = $_POST["desc_aval"];
    $rec                      = isset($_POST["rec"]);

    $sql2 = mysqli_query($con, 'SELECT n_turma FROM ministra m INNER JOIN cursa c ON m.id_cursa = c.id_cursa WHERE id_ministra = '.$min.';');
    $info2 = mysqli_fetch_array($sql2);

    $turma = $info2[0];

    include "base/functions/registrar.php";
    reg(' Programou Nova Avaliação para a Turma '.$turma.'.');


    $sql = "insert into avaliacao values ";
    $sql .= "(0,'$min','$nt_max','$desc_aval','$tipo_aval','$trim','$rec');";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());
    

    if($resultado){
        header('location: \dashboard.php?page=lista_aval&msg=1');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>