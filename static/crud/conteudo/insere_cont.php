<?php
    $min	        = $_POST["min"];
    $titulo         = $_POST["titulo"];
    $desc           = $_POST["desc"];
    $date           = $_POST["data"];
    
    $sql2 = mysqli_query($con, 'SELECT n_turma FROM ministra m INNER JOIN cursa c ON m.id_cursa = c.id_cursa WHERE id_ministra = '.$min.';');
    $info2 = mysqli_fetch_array($sql2);

    $turma = $info2[0];

    include "base/functions/registrar.php";
    reg(' Registrou Novo conteúdo para a Turma '.$turma.'.');

    $sql = "insert into conteudo values ";
    $sql .= "(0,$min,'$titulo','$desc','$date');";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('location: \dashboard.php?page=lista_cont&msg=1');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>