<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
    include "base/testa_nivel.php";

    $nome = $_POST["nome_aluno"];
    $sql  = "insert into aluno values ";
    $sql .= "('0','$nome');";

    $resultado = mysqli_query($con, $sql)or die(mysqli_error());

    if($resultado){
        header('Location: \diario_new/dashboard.php');
        header('location: \diario_new/dashboard.php?page=lista_alu');
        mysqli_close($con);
    }else{
        header('Location: \diario_new/dashboard.php');
        mysqli_close($con);
    }
?>