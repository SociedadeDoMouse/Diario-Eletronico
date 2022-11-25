<?php
    $nivel_necessario = array(
        1 => 'Administrador',
        2 => 'Diretor',
        3 => 'Coodernador',
    );
    include "base/testa_nivel.php";

    $matricula		  = $_POST["mat_aluno"];
    $nome             = $_POST["nome_aluno"];

    $sql = "update aluno set ";
    $sql .= "nome_aluno='".$nome."'";
    $sql .= "where mat_aluno= '".$matricula."';";

    $resultado = mysqli_query($con, $sql);


    if($resultado){
        header('Location: \dashboard.php?page=lista_alu&msg=2');
        exit();
     
    }else{
        header('Location: \dashboard.php');
    }
?>
