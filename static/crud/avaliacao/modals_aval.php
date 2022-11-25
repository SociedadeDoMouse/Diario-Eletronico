<!-- MODAL EDIÇÃO TURMA-->
<?php
    if(isset($_GET['id_aval'], $_GET['modal'])){
        $id_aval = (int) $_GET['id_aval'];
        $modal = $_GET['modal'];

        $sql  = "SELECT * FROM avaliacao inner join ministra on avaliacao.id_ministra = ministra.id_ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano where $id_aval = avaliacao.id_aval";
        $resultado = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($resultado);

        $nota_max = $row['nota_max'];
        $desc_aval = $row['desc_aval'];
        $tipo_aval = $row['tipo_aval'];
        $trim = $row['trimestre'];

        $ministra = "";
        $sql = mysqli_query($con, 'select * from ministra inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on cursa.id_ano = ano_letivo.id_ano inner join professor on ministra.mat_prof = professor.mat_prof inner join usuario on professor.id_usur = usuario.id_usur;');

        while($info = mysqli_fetch_array($sql)){ 
            $ministra .= "<option value=".$info['id_ministra'].">".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']." | ".$info['nome']."</option>";
        }

        if($modal == 'detalhar'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title h4' id='TituloModalCentralizado'>Detalhes de <strong>Avaliação</strong></h1>
                            <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'></span>
                            </button>
                        </div>
                            <div class='modal-body'>
                            
                                <div class='row'>

                                    <input type='hidden' value='$id_aval' name='id_aval'>

                                    <div class='form-group col-md-6'>
                                        <label for='min'> <div class='badge-modal'> Ministra </div>
                                            <select class='form-control' readonly='readonly' disabled name='min'>
                                                $ministra;
                                            </select>
                                        </label>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label for='titulo'> <div class='badge-modal'> Trimestre </div>
                                            <input type='number' readonly name='trim' class='form-control' value='$trim'>
                                        </label>
                                    </div>

                                </div>
                                <div class='row'>
                                    <div class='form-group col-md-6'>
                                        <label for='desc'> <div class='badge-modal'> Nota Máxima </div>
                                            <input type='number' readonly name='nt_max' class='form-control' value='$nota_max'>
                                        </label>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label for='data'> <div class='badge-modal'> Tipo de Avaliação </div>
                                        <input type='text' readonly name='tipo_aval' class='form-control' value='$tipo_aval'>
                                        </label>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='form-group col-md-12'>
                                        <label for='data'> <div class='badge-modal'> Descrição </div>
                                            <input type='text' readonly name='desc_aval' class='form-control' value='$desc_aval'>
                                        </label>
                                    </div>
                                </div>
                                <br>


                            </div>
                    </div>
                </div>
            </div>";
        }else if($modal == 'editar'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title h4' id='TituloModalCentralizado'>Edição de <strong>Avaliação</strong></h1>
                            <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'></span>
                            </button>
                        </div>

                        <form action='?page=atualiza_aval' method='post'>
                            <div class='modal-body'>
                            
                                <div class='row'>

                                    <input type='hidden' value='$id_aval' name='id_aval'>

                                    <div class='form-group col-md-6'>
                                        <label for='min'> <div class='badge-modal'> Ministra </div>
                                            <select class='form-control' name='min'>
                                                $ministra;
                                            </select>
                                        </label>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label for='titulo'> <div class='badge-modal'> Trimestre </div>
                                            <input type='number' name='trim' class='form-control' value='$trim'>
                                        </label>
                                    </div>

                                </div>
                                <div class='row'>
                                    <div class='form-group col-md-6'>
                                        <label for='desc'> <div class='badge-modal'> Nota Máxima </div>
                                            <input type='number' min='1' name='nt_max' class='form-control' value='$nota_max'>
                                        </label>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label for='data'> <div class='badge-modal'> Tipo de Avaliação </div>
                                        <input type='text' name='tipo_aval' class='form-control' value='$tipo_aval'>
                                        </label>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='form-group col-md-12'>
                                        <label for='data'> <div class='badge-modal'> Descrição </div>
                                            <input type='text' name='desc_aval' class='form-control' value='$desc_aval'>
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
                            <h1 class='modal-title h4' id='TituloModalCentralizado'>Excluir <strong>Avaliação</strong></h1>
                            <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'></span>
                            </button>
                        </div>

                        <form action='?page=excluir_aval&id_aval=$id_aval' method='post'>
                            <div class='modal-body'>
                            
                                <div class='row'>

                                    <input type='hidden' value='$id_aval' name='id_aval'>

                                    <div class='form-group col-md-6'>
                                        <label for='min'> <div class='badge-modal'> Ministra </div>
                                            <select class='form-control' name='min'>
                                                $ministra;
                                            </select>
                                        </label>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label for='titulo'> <div class='badge-modal'> Trimestre </div>
                                            <input type='number' readonly name='trim' class='form-control' value='$trim'>
                                        </label>
                                    </div>

                                </div>
                                <div class='row'>
                                    <div class='form-group col-md-6'>
                                        <label for='desc'> <div class='badge-modal'> Nota Máxima </div>
                                            <input type='number' readonly name='nt_max' class='form-control' value='$nota_max'>
                                        </label>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label for='data'> <div class='badge-modal'> Tipo de Avaliação </div>
                                        <input type='text' readonly name='tipo_aval' class='form-control' value='$tipo_aval'>
                                        </label>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='form-group col-md-12'>
                                        <label for='data'> <div class='badge-modal'> Descrição </div>
                                            <input type='text' readonly name='desc_aval' class='form-control' value='$desc_aval'>
                                        </label>
                                    </div>
                                </div>
                                <br>


                                <div class='alert alert-danger' role='alert'>
                                    <h5>CASO VOCÊ CONFIRME, TODAS AS NOTAS REFERENTES A ESTA AVALIAÇÃO SERÃO EXCLUÍDAS!</h5>
                                </div>

                            </div>

                            <div class='modal-footer justify-content-center'>
                                <button type='submit' class='btn btn-primary col-md-3'> Excluir <i class='fa-solid fa-trash'></i> </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>";}
    }
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script> $('#modal').modal('show') </script>