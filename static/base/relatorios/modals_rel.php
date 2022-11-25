<!-- MODAL EDIÇÃO TURMA-->
<?php
    if(isset($_GET['modal'])){

        $modal = $_GET['modal'];

             if($modal == 'BI'){
                echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h1 class='modal-title h4' id='TituloModalCentralizado'>Boletim Individual</strong></h1>
                                <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'></span>
                                </button>
                            </div>

                            <form action='base/relatorios/loading.php?rel=boletim_individual' method='post' target='_blank'>
                                <div class='modal-body'>
                                
                                    <div class='row'>

                                        <div class='form-group col-md-6'>
                                            <label for='n_turma'> <div class='badge-modal'> Turma </div>
                                                <select class='form-control' name='turma'>
                                                    ";

                                                    $sql = mysqli_query($con, 'select * from turma;');
                                                    while($info = mysqli_fetch_array($sql)){ 
                                                        echo "<option value=".$info['n_turma'].">".$info['n_turma']."</option>";
                                                    }
                                                    
                echo                           "</select>
                                            </label>
                                        </div>

                                        <div class='form-group col-md-6'>
                                            <label for='n_turma'> <div class='badge-modal'> Ano Letivo </div>
                                                <select class='form-control' name='ano'>
                                                    ";

                                                    $sql = mysqli_query($con, 'select * from ano_letivo;');
                                                    while($info = mysqli_fetch_array($sql)){ 
                                                        echo "<option value=".$info['id_ano'].">".$info['nome_ano']."</option>";
                                                    }
                                                    
                echo                           "</select>
                                            </label>
                                        </div>

                                    </div>

                                    <br>


                                </div>

                                <div class='modal-footer justify-content-center'>
                                    <button type='submit' class='btn btn-primary col-md-3'>Confirmar <i class='botoes' data-feather='check-circle'></i> </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>";
        }

        if($modal == 'RC'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title h4' id='TituloModalCentralizado'>Relatório de Conteúdos</strong></h1>
                            <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'></span>
                            </button>
                        </div>

                        <form action='base/relatorios/loading.php?rel=relatorio_conteudo' method='post' target='_blank'>
                            <div class='modal-body'>
                            
                                <div class='row'>

                                    <div class='form-group col-md-12'>
                                        <label for='n_turma'> <div class='badge-modal'> Ministra </div>
                                            <select class='form-control' name='min'>
                                                ";

                                                $sql = mysqli_query($con, 'SELECT distinct ministra.id_ministra, n_turma, nome_disc, nome_ano FROM ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano');
                                                while($info = mysqli_fetch_array($sql)){ 
                                                    echo "<option value=".$info['id_ministra'].">".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']."</option>";
                                                }
                                                
            echo                           "</select>
                                        </label>
                                    </div>

                                </div>

                                <br>


                            </div>

                            <div class='modal-footer justify-content-center'>
                                <button type='submit' class='btn btn-primary col-md-3'>Confirmar <i class='botoes' data-feather='check-circle'></i> </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>";
    }

        if($modal == 'BT'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title h4' id='TituloModalCentralizado'>Relatório de Boletim de Turma</strong></h1>
                            <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'></span>
                            </button>
                        </div>

                        <form action='base/relatorios/loading.php?rel=boletim_turma' method='post' target='_blank'>
                            <div class='modal-body'>
                            
                                <div class='row'>

                                    <div class='form-group col-md-12'>
                                        <label for='n_turma'> <div class='badge-modal'> Ministra </div>
                                            <select class='form-control' name='min'>
                                                ";

                                                $sql = mysqli_query($con, 'SELECT distinct ministra.id_ministra, n_turma, nome_disc, nome_ano FROM ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano');
                                                while($info = mysqli_fetch_array($sql)){ 
                                                    echo "<option value=".$info['id_ministra'].">".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']."</option>";
                                                }
                                                
            echo                           "</select>
                                        </label>
                                    </div>

                                </div>

                                <br>


                            </div>

                            <div class='modal-footer justify-content-center'>
                                <button type='submit' class='btn btn-primary col-md-3'>Confirmar <i class='botoes' data-feather='check-circle'></i> </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>";
        }

        if($modal == 'RF'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title h4' id='TituloModalCentralizado'>Relatório de Frequência</strong></h1>
                            <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'></span>
                            </button>
                        </div>

                        <form action='base/relatorios/loading.php?rel=frequencia_dia' method='post' target='_blank'>
                            <div class='modal-body'>
                            
                                <div class='row'>

                                    <div class='form-group col-md-12'>
                                        <label for='n_turma'> <div class='badge-modal'> Ministra </div>
                                            <select class='form-control' name='min'>
                                                ";

                                                $sql = mysqli_query($con, 'SELECT distinct ministra.id_ministra, n_turma, nome_disc, nome_ano FROM ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano');
                                                while($info = mysqli_fetch_array($sql)){ 
                                                    echo "<option value=".$info['id_ministra'].">".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']."</option>";
                                                }
                                                
            echo                           "</select>
                                        </label>
                                    </div>

                                </div>

                                <br>


                            </div>

                            <div class='modal-footer justify-content-center'>
                                <button type='submit' class='btn btn-primary col-md-3'>Confirmar <i class='botoes' data-feather='check-circle'></i> </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>";
        }
        if($modal == 'ERR'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title h4' id='TituloModalCentralizado'>ERROR</strong></h1>
                            <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'></span>
                            </button>
                        </div>

                        
                            <div class='modal-body'>
                            
                                <div class='row text-center' >
                                    <h4>Verifique se a turma possui <b>Avaliações</b>, <b>Frequência</b> e <b>Dias Letivos</b>.</h4>
                                </div>

                            </div>

                            <div class='modal-footer justify-content-center'>
                                <button data-dismiss='modal' aria-label='Close' class='btn btn-primary col-md-3'>Confirmar <i class='botoes' data-feather='check-circle'></i> </button>
                            </div>

                    </div>
                </div>
            </div>";
    }

    if($modal == 'CD'){
        echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Capa do Diário</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>

                    <form action='base/relatorios/loading.php?rel=capa_diario' method='post' target='_blank'>
                        <div class='modal-body'>
                        
                            <div class='row'>

                                <div class='form-group col-md-12'>
                                    <label for='n_turma'> <div class='badge-modal'> Ministra </div>
                                        <select class='form-control' name='min'>
                                            ";

                                            $sql = mysqli_query($con, 'SELECT distinct ministra.id_ministra, n_turma, nome_disc, nome_ano FROM ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano');
                                            while($info = mysqli_fetch_array($sql)){ 
                                                echo "<option value=".$info['id_ministra'].">".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']."</option>";
                                            }
                                            
        echo                           "</select>
                                    </label>
                                </div>

                            </div>

                            <br>


                        </div>

                        <div class='modal-footer justify-content-center'>
                            <button type='submit' class='btn btn-primary col-md-3'>Confirmar <i class='botoes' data-feather='check-circle'></i> </button>
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