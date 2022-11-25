<?php

    $turma_ano = explode('_',$_GET['turma']);

    $sql = "select * from cursa INNER JOIN disciplina ON cursa.id_disc = disciplina.id_disc INNER JOIN ano_letivo ON cursa.id_ano = ano_letivo.id_ano where n_turma = ".$turma_ano[0]." and cursa.id_ano= ".$turma_ano[1]." order by id_cursa ";

    if($_SESSION['UsuarioNivel'] == 5){
        $sql = "select * from cursa INNER JOIN disciplina ON cursa.id_disc = disciplina.id_disc INNER JOIN ano_letivo ON cursa.id_ano = ano_letivo.id_ano INNER JOIN ministra ON cursa.id_cursa = ministra.id_cursa INNER JOIN professor ON ministra.mat_prof = professor.mat_prof INNER JOIN usuario ON usuario.id_usur = professor.id_usur where n_turma = ".$turma_ano[0]." and cursa.id_ano= ".$turma_ano[1]." and usuario.id_usur = ".$_SESSION['UsuarioID']." order by cursa.id_cursa ";
    }
    
    $data = mysqli_query($con, $sql) or die(mysqli_error("ERRO: ".$con));

    

        echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
        echo "<thead><tr>";
        echo "<td><strong>Turma</strong></td>"; 
        echo "<td><strong>Disciplina</strong></td>"; 
        echo "<td><strong>Ano</strong></td>"; 
    
        echo "<td class='actions btn-group-sm text-center'><strong>Ações</strong></td>"; 
        echo "</tr></thead><tbody>";
        while($info = mysqli_fetch_array($data)){ 
            echo "<form action='dashboard.php?page=lista_freq' method='post'>";
            echo "<tr>";
            echo "<td><input type='none' class='form-control' id='turma' name='turma' value='".$info['n_turma']."' readonly></td>";
            echo "<td><input type='none' class='form-control' id='disc' name='disc' value='".$info['nome_disc']."' readonly></td>";
            echo "<td><input type='none' class='form-control' name='ano' value='".$info['nome_ano']."' readonly></td>";
            echo "<td class='actions btn-group-sm text-center'>";
            echo "
            
                <a class='btn btn-success btn-xs' data-toggle='tooltip' title='Adicionar' href='?page=fadd_freq&cursa=".$info['id_cursa']."'>  <i class='fa-solid fa-circle-plus'></i> </a>

                <a class='btn btn-primary btn-xs' data-toggle='tooltip' title='Detalhar' href='?page=lista_freq&ano=".$info['id_ano']."&turma=".$info['n_turma']."&disc=".$info['nome_disc']."'>  <i class='fa-solid fa-eye'></i> </a>
                
                </td>
            ";
            echo "</form>";
        }
echo "</tr></tbody></table>";
?>