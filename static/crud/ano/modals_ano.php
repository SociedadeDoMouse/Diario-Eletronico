<?php
    if(isset($_GET['id_ano'], $_GET['modal'])){
        $id_ano = (int) $_GET['id_ano'];
        $modal = $_GET['modal'];

        $sql  = 'SELECT * FROM ano_letivo where id_ano = '.$id_ano;
        $resultado = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($resultado);

        $dt_ini = $row['data_inicio'];
        $dt_fim = $row['data_fim'];
        $obs = $row['observacao'];

        $optcurso = "";

        $sql = mysqli_query($con, 'select * from curso;');
        while($info = mysqli_fetch_array($sql)){ 
            $optcurso .= "<option value=".$info['id_curso'].">".$info['nome_curso']."</option>";
        }
        if($modal == 'detalhar'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Detalhes de <strong>Ano Letivo</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>
                        <div class='modal-body'>
                        
                            <div class='row'>

                                <input type='hidden' value='$id_ano' name='id_ano'>

                                <div class='form-group col-md-6'>
                                    <label for='n_turma'> <div class='badge-modal'> Data de Inicio </div>
                                        <input type='date' readonly name='dt_ini' class='form-control' value='$dt_ini'>
                                    </label>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='n_turma'> <div class='badge-modal'> Data de Fim </div>
                                        <input type='date' readonly name='dt_fim' class='form-control' value='$dt_fim'>
                                    </label>
                                </div>

                            </div>
                            <div class='row'>
                                <div class='form-group col-md-12'>
                                    <label for='n_turma'> <div class='badge-modal'> OBS </div>
                                        <input readonly type='text' name='obs' class='form-control' value='$obs'>
                                    </label>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>";
        }else if($modal == 'editar'){
        echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Edição de <strong>Ano Letivo</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>

                    <form action='?page=atualiza_ano' method='post'>
                        <div class='modal-body'>
                        
                            <div class='row'>

                                <input type='hidden' value='$id_ano' name='id_ano'>

                                <div class='form-group col-md-6'>
                                    <label for='n_turma'> <div class='badge-modal'> Data de Inicio </div>
                                        <input type='date' name='dt_ini' class='form-control' value='$dt_ini'>
                                    </label>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='n_turma'> <div class='badge-modal'> Data de Fim </div>
                                        <input type='date' name='dt_fim' class='form-control' value='$dt_fim'>
                                    </label>
                                </div>

                            </div>
                            <div class='row'>
                                <div class='form-group col-md-12'>
                                    <label for='n_turma'> <div class='badge-modal'> OBS </div>
                                        <input type='text' name='obs' class='form-control' value='$obs'>
                                    </label>
                                </div>
                            </div>

                            <br>


                        </div>

                        <div class='modal-footer justify-content-center'>
                            <button type='submit' class='btn btn-primary col-md-3'>Confirmar <i class='fa-solid fa-check'></i> </button>
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
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Excluir <strong>Ano Letivo</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>

                    <form action='?page=excluir_ano&id_ano=$id_ano' method='post'>
                        <div class='modal-body'>
                        
                            <div class='row'>

                                <input type='hidden' value='$id_ano' name='id_ano'>

                                <div class='form-group col-md-6'>
                                    <label for='n_turma'> <div class='badge-modal'> Data de Inicio </div>
                                        <input type='date' readonly name='dt_ini' class='form-control' value='$dt_ini'>
                                    </label>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='n_turma'> <div class='badge-modal'> Data de Fim </div>
                                        <input type='date' readonly name='dt_fim' class='form-control' value='$dt_fim'>
                                    </label>
                                </div>

                            </div>
                            <div class='row'>
                                <div class='form-group col-md-12'>
                                    <label for='n_turma'> <div class='badge-modal'> OBS </div>
                                        <input type='text' readonly name='obs' class='form-control' value='$obs'>
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
        </div>";}
    }
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script> $('#modal').modal('show') </script>