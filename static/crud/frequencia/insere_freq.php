<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
	5 => 'Professor'
);
    include "base/testa_nivel.php";

    $trim = $_POST["trim"];
    $date = $_POST["data"];
    $disc = $_POST['disc'];
    $nturma = $_POST['turma'];
    $ano = $_POST['ano'];

    include "base/functions/registrar.php";
    reg(' Cadastrou uma Frequência para a turma '.$nturma.'.');

    $a = 1;
    while (isset($_POST['nome_aluno'.$a])) {
        $nome_alu[$a] = $_POST['nome_aluno'.$a];
        if(isset($_POST['pres'.$a])){
            $pres[$a] = $_POST['pres'.$a];
            
        }
        $a++;
    }
    for ($i=1; $i <= count($nome_alu); $i++) { 
        $nome = $nome_alu[$i];
        $data = mysqli_query($con, "select * from matriculado m INNER JOIN disciplina d ON m.id_disc = d.id_disc INNER JOIN aluno a ON m.mat_aluno = a.mat_aluno where m.mat_aluno = '$nome' and d.nome_disc = '$disc'") or die(mysqli_error("ERRO: ".$con));
        $info = mysqli_fetch_array($data);
        $mat = $info['id_mat'];
        if(isset($pres[$i])){
            $status_alu = 1;
        }else{
            $status_alu = 0;
        }
        $sql  = "insert into frequencia values (0,$mat,$trim,'$date',$status_alu)";
        $resultado = mysqli_query($con, $sql)or die(mysqli_error());
    }

   


    
    $min	            = $_POST["min"];
    if($_POST["titulo"] != ""){
        $titulo           = $_POST["titulo"];
        $desc            = $_POST["desc"];

        $sql2 = "insert into conteudo values ";
        $sql2 .= "(0,$min,'$titulo','$desc','$date');";

        $resultado = mysqli_query($con, $sql2)or die(mysqli_error());
    }

    $sqla = "UPDATE aula SET aula_min = aula_min+1 WHERE trimestre = $trim AND id_ministra = $min";

    $resultadoa = mysqli_query($con, $sqla)or die(mysqli_error());
    
    if($resultado){
        header('location: \dashboard.php?page=lista_freq&turma='.$nturma.'&disc='.$disc.'&ano='.$ano);
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php');
        mysqli_close($con);
    }
    
?>