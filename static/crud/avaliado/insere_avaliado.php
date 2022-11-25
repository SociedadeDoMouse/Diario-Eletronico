<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
	5 => 'Professor'
);



    include "base/testa_nivel.php";

    $id_aval = $_GET['id_aval'];

    $sql2 = mysqli_query($con, 'SELECT n_turma FROM avaliacao a INNER JOIN ministra m ON a.id_ministra = m.id_ministra INNER JOIN cursa c ON m.id_cursa = c.id_cursa WHERE id_aval = '.$id_aval.';');
    $info2 = mysqli_fetch_array($sql2);

    $turma = $info2[0];

    include "base/functions/registrar.php";
    reg(' Avaliou a turma '.$turma.'.');


    $date = $_POST["data"];

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
        $data = mysqli_query($con, "select * from matriculado m INNER JOIN aluno a ON m.mat_aluno = a.mat_aluno where nome_aluno = '$nome'") or die(mysqli_error("ERRO: ".$con));
        $info = mysqli_fetch_array($data);
        $mat = $info['id_mat'];
        $sql  = "insert into avaliado values (0,'$mat','$id_aval','".$pres[$i]."','$date')";

        $resultado = mysqli_query($con, $sql)or die(mysqli_error());
    }

    
    if($resultado){
        header('location: \dashboard.php?page=lista_avaliado&id_aval='.$id_aval);
        mysqli_close($con);
    }else{
        header('Location: \dashboard.php');
        mysqli_close($con);
    }
    
?>