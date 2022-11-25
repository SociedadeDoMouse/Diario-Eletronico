<!-- MODAL EDIÇÃO TURMA-->
<?php
    if(isset($_GET['id_avaliado'], $_GET['modal'])){
        $id_avaliado = (int) $_GET['id_avaliado'];
        $id_aval = (int) $_GET['id_aval'];
        $modal = $_GET['modal'];

        $sql  = "SELECT * FROM avaliado where id_avaliado = $id_avaliado";
        $resultado = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($resultado);

        $nota = $row['nota_avaliado'];

        $ministra = "";
        $sql = mysqli_query($con, 'select * from ministra inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on cursa.id_ano = ano_letivo.id_ano inner join professor on ministra.mat_prof = professor.mat_prof inner join usuario on professor.id_usur = usuario.id_usur;');

        while($info = mysqli_fetch_array($sql)){ 
            $ministra .= "<option value=".$info['id_ministra'].">".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']." - ".$info['nome']."</option>";
        }
        if($modal == 'editar'){
        echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Edição de <strong>Avaliado</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>

                    <form action='?page=atualiza_avaliado&id_aval=$id_aval' method='post'>
                        <div class='modal-body'>
                        
                            <div class='row'>
                                <input type='hidden' name='id_avaliado' class='form-control' value='$id_avaliado'>
                                <div class='form-group col-md-12'>
                                    <label for='titulo'> <div class='badge-modal'> Nota </div>
                                        <input type='number' min='0' step='0.01' name='nota' class='form-control' value='$nota'>
                                    </label>
                                </div>

                            </div>
                            
                            <br>


                        </div>

                        <div class='modal-footer justify-content-center'>
                            <button type='submit' class='btn btn-primary col-md-3'>Confirmar <i class='fa-solid fa-pen-to-square'></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>";}
        else if($modal == 'excluir'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Edição de <strong>Avaliado</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>

                    <form action='?page=excluir_avaliado&id_aval=$id_aval&id_avaliado=$id_avaliado' method='post'>
                        <div class='modal-body'>
                        
                            <div class='row'>
                                <input type='hidden' readonly name='id_avaliado' class='form-control' value='$id_avaliado'>
                                <div class='form-group col-md-12'>
                                    <label for='titulo'> <div class='badge-modal'> Nota </div>
                                        <input type='number'readonly name='nota' class='form-control' value='$nota'>
                                    </label>
                                </div>

                            </div>
                            
                            <br>


                        </div>

                        <div class='modal-footer justify-content-center'>
                            <button type='submit' class='btn btn-primary col-md-3'>Confirmar <i class='fa-solid fa-trash'></i> </button>
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