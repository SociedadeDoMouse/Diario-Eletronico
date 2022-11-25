<!-- MODAL EDIÇÃO TURMA-->
<?php
    if(isset($_GET['id_cursa'], $_GET['modal'])){
        $nturma = (int) $_GET['id_cursa'];
        $modal = $_GET['modal'];

        $sql  = 'SELECT * FROM cursa INNER JOIN disciplina ON cursa.id_disc = disciplina.id_disc INNER JOIN ano_letivo ON cursa.id_ano = ano_letivo.id_ano';
        $resultado = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($resultado);



        // if($modal == 'detalhar'){
        //     echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
        //     <div class='modal-dialog modal-dialog-centered' role='document'>
        //         <div class='modal-content'>
        //             <div class='modal-header'>
        //                 <h1 class='modal-title h4' id='TituloModalCentralizado'>Detalhes de <strong>Turma</strong></h1>
        //                 <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
        //                 <span aria-hidden='true'></span>
        //                 </button>
        //             </div>

        //                 <div class='modal-body'>
                        
        //                     <div class='row'>

        //                         <div class='form-group col-md-4'>
        //                             <label for='n_turma'> <div class='badge-modal'> Turma </div>
        //                                 <select readonly class='form-control'>";
                                        

        //                                 $sql = mysqli_query($con, 'select * from cursa INNER JOIN turma where turma.n_turma = cursa.n_turma and cursa.id_cursa ='.$nturma.';');
                                
        //                                 while($info = mysqli_fetch_array($sql)){ 
        //                                     if($info['n_turma'] == $row['n_turma']){
        //                                         echo  "<option value='".$info['n_turma']."' selected>".$info['n_turma']."</option>";
        //                                         continue;
        //                                     }
        //                                     echo  "<option value='".$info['n_turma']."'>".$info['n_turma']."</option>";
        //                                 }
                                
                                            
        //                                 echo "</select>
        //                             </label>
        //                         </div>

        //                         <div class='form-group col-md-4'>
        //                             <label for='n_turma'> <div class='badge-modal'> Disciplina </div>
        //                                 <select readonly class='form-control'>";
                                        

        //                                 $sql = mysqli_query($con, 'select * from cursa INNER JOIN disciplina where disciplina.id_disc = cursa.id_disc and cursa.id_cursa ='.$nturma.';');
                                
        //                                 while($info = mysqli_fetch_array($sql)){ 
        //                                     if($info['id_disc'] == $row['id_disc']){
        //                                         echo  "<option value='".$info['id_disc']."' selected>".$info['nome_disc']."</option>";
        //                                         continue;
        //                                     }
        //                                     echo  "<option value='".$info['id_disc']."'>".$info['nome_disc']."</option>";
        //                                 }
                                
                                            
        //                                 echo "</select>
        //                             </label>
        //                         </div>

        //                         <div class='form-group col-md-4'>
        //                             <label for='n_turma'> <div class='badge-modal'> Ano Letivo </div>

        //                             <select readonly class='form-control'>";

        //                                 $sql = mysqli_query($con, 'select * from cursa INNER JOIN ano_letivo where ano_letivo.id_ano = cursa.id_ano and cursa.id_cursa ='.$nturma.';');
                                
        //                                 while($info = mysqli_fetch_array($sql)){ 
        //                                     if($info['id_ano'] == $row['id_ano']){
        //                                         echo  "<option value='".$info['id_ano']."' selected>".$info['nome_ano']."</option>";
        //                                         continue;
        //                                     }
        //                                     echo  "<option value='".$info['id_ano']."'>".$info['nome_ano']."</option>";
        //                                 }
                                
                                            
        //                             echo "</select>

        //                             </label>
        //                         </div>

        //                     </div>

        //                 </div>

        //         </div>
        //     </div>
        // </div>";
        // }
        // else if($modal == 'editar'){
        // echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
        //     <div class='modal-dialog modal-dialog-centered' role='document'>
        //         <div class='modal-content'>
        //             <div class='modal-header'>
        //                 <h1 class='modal-title h4' id='TituloModalCentralizado'>Edição de <strong>Turma</strong></h1>
        //                 <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
        //                 <span aria-hidden='true'></span>
        //                 </button>
        //             </div>

        //             <form action='?page=atualiza_turm' method='post'>
        //                 <div class='modal-body'>
                        
        //                     <div class='row'>

        //                         <div class='form-group col-md-4'>
        //                             <label for='n_turma'> <div class='badge-modal'> Turma </div>
        //                                 <select class='form-control'>";
                                        

        //                                 $sql = mysqli_query($con, 'select * from cursa INNER JOIN turma where turma.n_turma = cursa.n_turma and cursa.id_cursa ='.$nturma.';');
                                
        //                                 while($info = mysqli_fetch_array($sql)){ 
        //                                     if($info['n_turma'] == $row['n_turma']){
        //                                         echo  "<option value='".$info['n_turma']."' selected>".$info['n_turma']."</option>";
        //                                         continue;
        //                                     }
        //                                     echo  "<option value='".$info['n_turma']."'>".$info['n_turma']."</option>";
        //                                 }
                                
                                            
        //                                 echo "</select>
        //                             </label>
        //                         </div>

        //                         <div class='form-group col-md-4'>
        //                             <label for='n_turma'> <div class='badge-modal'> Disciplina </div>
        //                                 <select class='form-control'>";
                                        

        //                                 $sql = mysqli_query($con, 'select * from cursa INNER JOIN disciplina where disciplina.id_disc = cursa.id_disc and cursa.id_cursa ='.$nturma.';');
                                
        //                                 while($info = mysqli_fetch_array($sql)){ 
        //                                     if($info['id_disc'] == $row['id_disc']){
        //                                         echo  "<option value='".$info['id_disc']."' selected>".$info['nome_disc']."</option>";
        //                                         continue;
        //                                     }
        //                                     echo  "<option value='".$info['id_disc']."'>".$info['nome_disc']."</option>";
        //                                 }
                                
                                            
        //                                 echo "</select>
        //                             </label>
        //                         </div>

        //                         <div class='form-group col-md-4'>
        //                             <label for='n_turma'> <div class='badge-modal'> Ano Letivo </div>

        //                             <select class='form-control'>";

        //                                 $sql = mysqli_query($con, 'select * from cursa INNER JOIN ano_letivo where ano_letivo.id_ano = cursa.id_ano and cursa.id_cursa ='.$nturma.';');
                                
        //                                 while($info = mysqli_fetch_array($sql)){ 
        //                                     if($info['id_ano'] == $row['id_ano']){
        //                                         echo  "<option value='".$info['id_ano']."' selected>".$info['nome_ano']."</option>";
        //                                         continue;
        //                                     }
        //                                     echo  "<option value='".$info['id_ano']."'>".$info['nome_ano']."</option>";
        //                                 }
                                
                                            
        //                             echo "</select>
        //                             </label>
        //                         </div>

        //                     </div>

        //                     <br>


        //                 </div>

        //                 <div class='modal-footer justify-content-center'>
        //                     <button type='submit' class='btn btn-primary col-md-3'>Confirmar <i class='fa-solid fa-pen-to-square'></i> </button>
        //                 </div>
        //             </form>
        //         </div>
        //     </div>
        // </div>";}

        if($modal == 'excluir'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title h4' id='TituloModalCentralizado'> Excluir <strong>Turma</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>

                    <form action='?page=excluir_cursa' method='post'>
                        <div class='modal-body'>
                        
                            <div class='row'>
                                <input type='hidden' name='id_cursa' value='$nturma'>
                                <div class='form-group col-md-4'>
                                    <label for='n_turma'> <div class='badge-modal'> Turma </div>
                                        <select class='form-control'>";
                                        

                                        $sql = mysqli_query($con, 'select * from cursa INNER JOIN turma where turma.n_turma = cursa.n_turma and cursa.id_cursa ='.$nturma.';');
                                
                                        while($info = mysqli_fetch_array($sql)){ 
                                            if($info['n_turma'] == $row['n_turma']){
                                                echo  "<option value='".$info['n_turma']."' selected>".$info['n_turma']."</option>";
                                                continue;
                                            }
                                            echo  "<option value='".$info['n_turma']."'>".$info['n_turma']."</option>";
                                        }
                                
                                            
                                        echo "</select>
                                    </label>
                                </div>

                                <div class='form-group col-md-4'>
                                    <label for='n_turma'> <div class='badge-modal'> Disciplina </div>
                                        <select class='form-control'>";
                                        

                                        $sql = mysqli_query($con, 'select * from cursa INNER JOIN disciplina where disciplina.id_disc = cursa.id_disc and cursa.id_cursa ='.$nturma.';');
                                
                                        while($info = mysqli_fetch_array($sql)){ 
                                            if($info['id_disc'] == $row['id_disc']){
                                                echo  "<option value='".$info['id_disc']."' selected>".$info['nome_disc']."</option>";
                                                continue;
                                            }
                                            echo  "<option value='".$info['id_disc']."'>".$info['nome_disc']."</option>";
                                        }
                                
                                            
                                        echo "</select>
                                    </label>
                                </div>

                                <div class='form-group col-md-4'>
                                    <label for='n_turma'> <div class='badge-modal'> Ano Letivo </div>

                                    <select class='form-control'>";

                                        $sql = mysqli_query($con, 'select * from cursa INNER JOIN ano_letivo where ano_letivo.id_ano = cursa.id_ano and cursa.id_cursa ='.$nturma.';');
                                
                                        while($info = mysqli_fetch_array($sql)){ 
                                            if($info['id_ano'] == $row['id_ano']){
                                                echo  "<option value='".$info['id_ano']."' selected>".$info['nome_ano']."</option>";
                                                continue;
                                            }
                                            echo  "<option value='".$info['id_ano']."'>".$info['nome_ano']."</option>";
                                        }
                                
                                            
                                    echo "</select>
                                    </label>
                                </div>

                            </div>

                            <br>


                        </div>

                        <div class='modal-footer justify-content-center'>
                            <button type='submit' class='btn btn-primary col-md-3'> Excluir <i class='fa-solid fa-trash'></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>";
        }
    }
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script> $('#modal').modal('show') </script>