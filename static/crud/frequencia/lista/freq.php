<?php

    include "base/functions/formdata.php";

    $quantidade = 10;
    $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
    $inicio = ($quantidade * $pagina) - $quantidade;

    $turma = $_GET['turma'];
    $disc = $_GET['disc'];
    $ano = $_GET['ano'];
?>


    <div class="row">
        <a class='btn btn-info pull-left' style="max-width:30%;margin-left:15px;" href='\dashboard.php?page=lista_freq&turma=<?php echo $turma."_".$ano ?>'><strong>< Voltar</strong></a>
    </div>
    <br>

<?php
        $quantidade = 10;

        $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
        $inicio = ($quantidade * $pagina) - $quantidade;



        
        $turma = $_GET['turma'];
        $disc = $_GET['disc'];

        $data2 = mysqli_query($con, "select * from enturmado where n_turma = $turma;") or die(mysqli_error("ERRO: ".$con));

      
        echo "<form action='dashboard.php?page=lista_freq&turma=$turma&disc=$disc&ano=$ano' method='post'> <div class='row'> <div class='col-md-2'><input class='form-control' name='turma' value='$turma' disabled></div> 
              <div class='col-md-2'><input class='form-control' name='disc' value='$disc' disabled></h2></div>";
        
        echo "<div class='col-md-3'><select name='data_freq' class='form-control'>";
        
        $sql = mysqli_query($con, 'select DISTINCT data_freq from frequencia INNER JOIN matriculado ON frequencia.id_mat = matriculado.id_mat INNER JOIN disciplina ON matriculado.id_disc = disciplina.id_disc INNER JOIN aluno ON aluno.mat_aluno = matriculado.mat_aluno INNER JOIN enturmado ON enturmado.mat_aluno = aluno.mat_aluno where nome_disc = "'.$disc.'" and n_turma = "'.$turma.'" order by data_freq desc');
        $excl = "";
								while($info = mysqli_fetch_array($sql)){ 
                                    if($excl == ""){
                                        $excl = $info['data_freq'];
                                    }
									if(isset($_POST['data_freq'])){
										if ($_POST['data_freq'] == $info['data_freq']) {
											echo "<option value=".$info['data_freq']." selected>".formdata($info['data_freq'])."</option>";
                                            $excl = $info['data_freq'];
											continue;
										}
									}
									echo "<option value=".$info['data_freq'].">".formdata($info['data_freq'])."</option>";
								}

        echo "</select></div><div class='col-md-3'><button type='submit' class='btn btn-success'><i class='fa-solid fa-magnifying-glass'></i></button></div><div class='col-md-2'><a href='?page=excluir_freq&disc=$disc&turma=$turma&data_freq=".$excl."&ano=$ano' title='Deletar Frequencias deste dia' class='btn btn-danger'><i class='fa-solid fa-trash'></i></a></div>  </div> </form> </br>";
        

        echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
        echo "<thead><tr>";
        echo "<td><strong>Número</strong></td>";
        echo "<td><strong>Nome</strong></td>"; 
        echo "<td><strong>Trimestre</strong></td>"; 
        echo "<td><strong>Data</strong></td>"; 
        echo "<td><strong>Status</strong></td>"; 
        echo "<td class='actions d-flex justify-content-center'><strong>Ações</strong></td>"; 
        echo "</tr></thead><tbody>";

            while($info2 = mysqli_fetch_array($data2)){
                
                $mat = $info2['mat_aluno'];

                    
                    $sql = mysqli_query($con, 'select DISTINCT data_freq from frequencia INNER JOIN matriculado ON frequencia.id_mat = matriculado.id_mat INNER JOIN disciplina ON matriculado.id_disc = disciplina.id_disc INNER JOIN aluno ON aluno.mat_aluno = matriculado.mat_aluno INNER JOIN enturmado ON enturmado.mat_aluno = aluno.mat_aluno where nome_disc = "'.$disc.'" and n_turma = "'.$turma.'" order by data_freq desc');
                    $info = mysqli_fetch_array($sql);
                    if(isset($info['data_freq'])){

                    $data = mysqli_query($con, "SELECT * FROM frequencia INNER JOIN matriculado ON matriculado.id_mat = frequencia.id_mat INNER JOIN disciplina ON disciplina.id_disc = matriculado.id_disc INNER JOIN aluno on matriculado.mat_aluno = aluno.mat_aluno INNER JOIN enturmado ON enturmado.mat_aluno = aluno.mat_aluno WHERE aluno.mat_aluno = $mat AND disciplina.nome_disc = '$disc' AND data_freq = '".$info['data_freq']."';") or die(mysqli_error("ERRO: ".$con));

                    

                    if(isset($_POST['data_freq'])){
                        $data = mysqli_query($con, "SELECT * FROM frequencia INNER JOIN matriculado ON matriculado.id_mat = frequencia.id_mat INNER JOIN disciplina ON disciplina.id_disc = matriculado.id_disc INNER JOIN aluno on matriculado.mat_aluno = aluno.mat_aluno INNER JOIN enturmado ON enturmado.mat_aluno = aluno.mat_aluno WHERE aluno.mat_aluno = $mat AND disciplina.nome_disc = '$disc' AND data_freq = '".$_POST['data_freq']."';") or die(mysqli_error("ERRO: ".$con));
                        
                        $excl = $_POST['data_freq'];
                    }
                    
               
                
                    while($info = mysqli_fetch_array($data)){
                        echo "<tr>";
                        echo "<td>".$info['num_enturmado']."</td>";
                        echo "<td>".$info['nome_aluno']."</td>";
                        echo "<td>".$info['trimestre_freq']."</td>";
                        echo "<td>".formdata($info['data_freq'])."</td>";
                        if($info['status'] == 1){
                            $status = "Presente";
                        }else if($info['status'] == 0){
                            $status = "Falta";
                        }else{
                            $status = "Justificada";
                        }
                        echo "<td>".$status."</td>";
                        echo "<td class='actions btn-group-sm d-flex justify-content-center'>";
                        if($info['status'] == 0){
                            echo "<a class='btn btn-warning btn-xs' href='?page=just_freq&id_freq=".$info['id_freq']."&ano=$ano&turma=".$turma."&disc=".$disc."'>  <i class='fa-solid fa-circle-plus'></i> </a>"; 
                        }else{
                            echo "<button class='btn btn-warning btn-xs' href='?page=just_freq&id_freq=".$info['id_freq']."&ano=$ano&turma=".$turma."&disc=".$disc."' disabled>  <i class='fa-solid fa-circle-plus'></i> </button>"; 
                        }
                    }
                }
            }
        echo "</tr></tbody></table>";

        include "crud/frequencia/modal_freq.php";