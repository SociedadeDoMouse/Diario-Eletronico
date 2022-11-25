<!-- MODAL EDIÇÃO TURMA-->
<?php
    if(isset($_GET['id_min'], $_GET['modal'])){
        $id_min = (int) $_GET['id_min'];
        $modal  = $_GET['modal'];

        $sql  = 'SELECT * FROM cursa INNER JOIN disciplina ON cursa.id_disc = disciplina.id_disc INNER JOIN ano_letivo ON cursa.id_ano = ano_letivo.id_ano';
        $resultado = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($resultado);

        $optcursa = "";

        $sql = mysqli_query($con, 'select * from cursa inner join disciplina ON cursa.id_disc = disciplina.id_disc INNER JOIN ano_letivo ON cursa.id_ano = ano_letivo.id_ano INNER JOIN ministra ON ministra.id_cursa = cursa.id_cursa where id_ministra = '.$id_min.';');
        if($modal == 'excluir'){
            $sql = mysqli_query($con, 'select * from cursa inner join disciplina ON cursa.id_disc = disciplina.id_disc INNER JOIN ano_letivo ON cursa.id_ano = ano_letivo.id_ano INNER JOIN ministra ON ministra.id_cursa = cursa.id_cursa where id_ministra = '.$id_min.';');
        }
        while($info = mysqli_fetch_array($sql)){ 
            $optcursa .= "<option value=".$info['id_cursa'].">".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']."</option>";
        }

        
        

        $turma = "";
        $sql = mysqli_query($con, 'select * from professor INNER JOIN usuario ON professor.id_usur = usuario.id_usur INNER JOIN ministra m ON professor.mat_prof = m.mat_prof where m.id_ministra = '.$id_min.';');
        if($modal == 'excluir'){
            $sql = mysqli_query($con, 'select * from professor INNER JOIN usuario ON professor.id_usur = usuario.id_usur INNER JOIN ministra m ON professor.mat_prof = m.mat_prof where m.id_ministra = '.$id_min.';');
        }
        while($info = mysqli_fetch_array($sql)){ 
            $turma .= "<option value=".$info['mat_prof'].">".$info['nome']."</option>";
        }

         if($modal == 'editar'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title h4' id='TituloModalCentralizado'>Edição de <strong>Ministra</strong></h1>
                            <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'></span>
                            </button>
                        </div>

                        <form action='?page=atualiza_min' method='post'>
                            <div class='modal-body'>
                            
                                <div class='row'>

                                    <input type='hidden' value='$id_min' name='id_min'>

                                    <div class='form-group col-md'>
                                        <label for='n_turma'> <div class='badge-modal'> Professor </div>
                                            <select class='form-control' name='prof'>
                                                $turma
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='form-group col-md'>
                                        <label for='n_turma'> <div class='badge-modal'> Cursa </div>

                                        <select class='form-control' name='cursa'>
                                            $optcursa;
                                        </select>
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
            </div>";
        }
        if($modal == 'excluir'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title h4' id='TituloModalCentralizado'>Excluir <strong>Ministra</strong></h1>
                            <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'></span>
                            </button>
                        </div>

                        <form action='?page=excluir_min&id_min=$id_min' method='post'>
                            <div class='modal-body'>
                            
                                <div class='row'>

                                    <input type='hidden' value='$id_min' name='id_min'>

                                    <div class='form-group col-md'>
                                        <label for='n_turma'> <div class='badge-modal'> Professor </div>
                                            <select class='form-control' name='prof'>
                                                $turma
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='form-group col-md'>
                                        <label for='n_turma'> <div class='badge-modal'> Cursa </div>

                                        <select class='form-control' name='cursa'>
                                            $optcursa;
                                        </select>
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