<?php

$nivel_necessario = array(
    1 => 'Administrador',
    2 => 'Diretor',
    3 => 'Coodernador'
);

include "base/testa_nivel.php";
?>
<?php
        use PhpOffice\PhpSpreadsheet\Spreadsheet; //classe responsável pela manipulação da planilha
        
        $alunos = "";
        $nchamadatur = "";
        $mat;
        if(isset($_POST['enviar'])){
            echo "<form action='dashboard.php?page=inserexls_alu' method='post'>";

            require 'vendor/autoload.php';

            $arquivo = $_FILES['userfile']['tmp_name'];

            $reader = PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");

            $spreadsheet = $reader->load($arquivo);

            $frow = 0;

            $nomes;

            for ($sheetnum=0; $sheetnum < $spreadsheet -> getSheetCount(); $sheetnum++) { 

                $sheet = $spreadsheet->getSheet($sheetnum);

                $nome = $spreadsheet->getSheetNames()[$sheetnum];

                for ($i=2; $i <= $sheet->getHighestRow(); $i++) { 
                
                    foreach ($sheet->getRowIterator($i,$i) as $row) {

                        $cellInteratorn = $row->getCellIterator('a','a');
                        $cellInteratorn->setIterateOnlyExistingCells(false);

                        foreach ($cellInteratorn as $celln) {
                            if(!isset($nchamada)){
                             $nchamada = $celln->getCalculatedValue(); 
                            }else{
                             $nchamada .= ",".$celln->getCalculatedValue(); 
                            }
                            
                         }

                        $cellInterator = $row->getCellIterator('b','c');
                        $cellInterator->setIterateOnlyExistingCells(false);
                        
                        $index = 0;
                        
                        if($frow == 0){
                            $valores = '(';
                            $frow = 1;
                        }else{
                            $valores = ',(';
                        }
                        
                        //Linha
                        foreach ($cellInterator as $cell) {
                            
                            if(!is_null($cell)){
                                $value = $cell->getCalculatedValue();
                                

                                if($index == 0){
                                    $valores .= '"'.$value.'",';
                                    $index = 1;
                                    if(isset($mat[$nome])){
                                        $mat[$nome] .= ','.$value;
                                    }else{
                                        $mat[$nome] = $value;}
                                }else{
                                    $valores .= '"'.$value.'"';
                                    $index = 0;
                                }
                            }
                            
                            
                        }
                        $valores .=')'; 

                }

                    $alunos .= $valores;
                }

                $nchamadatur .= $nchamada.";";

                $nomes[] = $nome;

                $optturno = "";
                $sql = mysqli_query($con, 'select * from turno;');

                while($info = mysqli_fetch_array($sql)){ 

                    $sql2 = mysqli_query($con, "select id_turno from turma where n_turma = $nome;");
                    $info2 = mysqli_fetch_array($sql2);
                    
										if ($info['id_turno'] == $info2['id_turno']) {
                                            
											$optturno .= "<option value=".$info['id_turno']." selected>".$info['turno']."</option>";
											continue;

										}

                                    $optturno .= "<option value=".$info['id_turno'].">".$info['turno']."</option>";		
                    
                }     

                $optano = "";
                $sql = mysqli_query($con, 'select * from ano_letivo;');
                while($info = mysqli_fetch_array($sql)){ 
                    $optano .= "<option value=".$info['id_ano'].">".$info['nome_ano']."</option>";
                }
                
                echo "
                <h2>$nome</h2>
                <div class='row'> 
                    <div class='form-group col-md-2 col-sm-2'>
                        <label for='turno'>Turno</label>
                        <select class='form-control' name='turno-$nome'>
                            $optturno
                        </select>
                    </div>
                    <div class='form-group col-md-3 col-sm-3'>
                        <label for='mat_aluno'>Ano Letivo</label>
                            <select class='form-control' name='ano-$nome'>
                            $optano
                        </select>
                    </div>
                </div>
                ";
                
            }
            echo "<div class='form-group col-md-3 col-sm-3 mt-5'><input name='turmas'  value='".implode(",",$nomes)."' type='hidden'><input name='alunos'  value='$alunos' type='hidden'><input name='nchamada'  value='".$nchamadatur."' type='hidden'><input name='mat'  value='".implode(";",$mat)."' type='hidden'><input name='importar' type='submit' class='form-control btn btn-success'></input></div></form>";
        }
                

            // ------ inserindo ------

            
            if (isset($_POST['alunos'])) {

                $mat = explode(";", $_POST['mat']);

                $alunos = $_POST['alunos'];

                $nchamadatur = explode(";", $_POST['nchamada']);

                $sql = "replace into aluno values ";
                $sql .= "$alunos;";

                $turmas = explode(",",$_POST["turmas"]);     
                
    
        
                $resultado = mysqli_query($con, $sql);

                
                include "base/functions/registrar.php";
                reg(' Inseriu novo(s) aluno(s).');
        
                for ($i=0; $i < count($turmas); $i++) {
                    
                        
                    
                        $mattur = explode(",", $mat[$i]);
                        $turno = $_POST["turno-".$turmas[$i]];
                        $ano = $_POST["ano-".$turmas[$i]];

                        $sqlvtur  = "select * from turma where n_turma = ".$turmas[$i].";";
                        $resultado = mysqli_query($con, $sqlvtur); 
                        $row = mysqli_num_rows($resultado);

                        if (strlen($turmas[$i]) == 4) {
                            $curso = $turmas[$i][2];
                            $modal = 1;
                            $ano_mdl = $turmas[$i][0];
                        }else{
                            $curso = $turmas[$i][1];
                            $modal = 0;
                            $ano_mdl = $turmas[$i][0];
                        }

                        $sqlvert  = "SELECT n_turma FROM turma where n_turma = '".$turmas[$i]."'";
                        $resultadovert = mysqli_query($con, $sqlvert);
                        $infovert = mysqli_fetch_array($resultadovert);

                        if(!isset($infovert)){
                            $sqlturma  = "replace into turma values ";
                            $sqlturma .= "('".$turmas[$i]."','$turno','".$curso."','$modal','$ano_mdl');";
                            $resultado = mysqli_query($con, $sqlturma);
                        }
                            $nchamadaalu = explode(",", $nchamadatur[$i]);
                    
                        for ($m=0; $m < count($mattur); $m++) { 
                            $sqlentur  = "replace into enturmado values ";
                            $sqlentur .= "('0','$ano','".$turmas[$i]."','".$mattur[$m]."','".$nchamadaalu[$m]."');";
                            $resultado = mysqli_query($con, $sqlentur);
                        }
                        
                        for ($m=0; $m < count($mattur); $m++) { 
                            $sqldisc  = "SELECT id_disc FROM cursa where n_turma = '".$turmas[$i]."' AND id_ano = '$ano'";
                            
                            $resultadodisc = mysqli_query($con, $sqldisc);

                                while($info = mysqli_fetch_array($resultadodisc)){
                                    $sqlmat  = "replace into matriculado values ";
                                    $sqlmat .= "('0','$ano','".$info['id_disc']."','".$mattur[$m]."');";
                                    $resultado = mysqli_query($con, $sqlmat);
                                }
                        }
                }
            
            if($resultado){
                header('location: \dashboard.php?page=lista_alu&msg=1');
                mysqli_close($con);
            }else{
                header('Location: \dashboard.php');
                mysqli_close($con);
            }
        }
?>