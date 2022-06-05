<?php


    $nivel_necessario = array(
        1 => 'Administrador',
        2 => 'Diretor',
        3 => 'Coodernador'
    );
    include "base/testa_nivel.php";

    $matricula		  = $_POST["mat_aluno"];
    $nome             = $_POST["nome_aluno"];

    $sql = "update aluno set ";
    $sql .= "nome_aluno='".$nome."'";
    $sql .= "where mat_aluno= '".$matricula."';";

    $resultado = mysqli_query($con, $sql);


    if($resultado){
        header('Location: \diario_new/dashboard.php');
        header('location: \diario_new/dashboard.php?page=lista_alu');
        mysqli_close($con);
    }else{
        header('Location: \diario_new/dashboard.php');
        mysqli_close($con);
    }
?>
