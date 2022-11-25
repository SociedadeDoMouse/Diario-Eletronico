<?php
    $turma             = $_POST["turma"];
    $ano              = $_POST["ano"];
    $dep              = isset($_POST["dep"]);

    include "base/functions/registrar.php";
    reg(' Registrou Nova disciplina para a Turma '.$turma.'.');

    $i = 0;
    $sql2 = mysqli_query($con, 'select * from disciplina;');

    while($info2 = mysqli_fetch_array($sql2)){ 
        $id_disc = $info2['id_disc'];
        if(isset($_POST["disc".$info2['id_disc']])){
        $sql = "insert into cursa values ";
        $sql .= "(0,'".$id_disc."','$turma','$ano', '$dep');";
        $resultado = mysqli_query($con, $sql)or die(mysqli_error());
        }
        $i++;
    }

    if($resultado){
        header('location: \dashboard.php?page=lista_cursa&msg=1');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>