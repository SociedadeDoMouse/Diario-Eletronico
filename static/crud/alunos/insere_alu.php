<?php
try {
    //code...
    include "base/functions/registrar.php";
    reg(' Inseriu novo(s) aluno(s).');

    $nivel_necessario = array(
        1 => 'Administrador',
        2 => 'Diretor',
        3 => 'Coodernador',
        5 => 'Professor'
    );
    include "base/testa_nivel.php";
    $a = 0;
    while (isset($_POST["nome_aluno".$a])) {
        $nome = $_POST["nome_aluno".$a];
        $mat = $_POST["matricula".$a];
        $n = $_POST["numero".$a];
        $ano = $_POST["ano"];
        $turma = $_POST["turma"];

        $sql  = "insert into aluno values ";
        $sql .= "('$mat','$nome');";
        $resultado = mysqli_query($con, $sql)or die(mysqli_error());

        $sql2  = "insert into enturmado values ";
        $sql2 .= "(0,$ano,$turma,$mat,$n);";
        $resultado2 = mysqli_query($con, $sql2)or die(mysqli_error());

        $a++;
    }
    if($resultado){
        header('location: \dashboard.php?page=lista_alu&msg=1');
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php');
        mysqli_close($con);
    }
}
    catch (\Throwable $th) {
        header('location: \dashboard.php?page=fadd_alu&msg=err');
    }
?>