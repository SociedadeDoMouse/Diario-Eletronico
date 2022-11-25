<?php
    $n_turma		   = $_POST["n_turma"];
    $turno             = $_POST["turno"];
    $curso             = $_POST["curso"];
    $modalidade        = $_POST["modalidade"];

    $sql = "update turma set ";
    $sql .= "id_turno='".$turno."', ";
    $sql .= "id_curso='".$curso."', ";
    $sql .= "id_modal='".$modalidade."' ";
    $sql .= "where n_turma= '".$n_turma."';";

    $resultado = mysqli_query($con, $sql);


    if($resultado){
        header('location: \dashboard.php?page=lista_turm&msg=2');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php&msg=4');
        mysqli_close($con);
    }
?>
