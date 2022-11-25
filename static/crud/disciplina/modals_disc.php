<!-- MODAL EDIÇÃO TURMA-->
<?php
    if(isset($_GET['id_disc'], $_GET['modal'])){

        $id_disc = (int) $_GET['id_disc'];
        $modal = $_GET['modal'];

        $sql  = 'SELECT * FROM disciplina where id_disc = '.$id_disc;
        $resultado = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($resultado);

        $nome_disc = $row['nome_disc'];

        $optcurso = "";

        $sql = mysqli_query($con, 'select * from curso INNER JOIN disciplina ON disciplina.id_curso = curso.id_curso where id_disc ='.$_GET['id_disc'].';');
        while($info = mysqli_fetch_array($sql)){ 
            $optcurso .= "<option value=".$info['id_curso']." selected>".$info['nome_curso']."</option>";
        }

             if($modal == 'editar'){
                echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h1 class='modal-title h4' id='TituloModalCentralizado'>Edição de <strong>Disciplina</strong></h1>
                                <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'></span>
                                </button>
                            </div>

                            <form action='?page=atualiza_disc' method='post'>
                                <div class='modal-body'>
                                
                                    <div class='row'>

                                        <input type='hidden' value='$id_disc' name='id_disc'>

                                        <div class='form-group col-md-6'>
                                            <label for='n_turma'> <div class='badge-modal'> Nome </div>
                                                <input type='text' name='nome' class='form-control' value='$nome_disc'>
                                            </label>
                                        </div>
                                        <div class='form-group col-md-6'>
                                            <label for='n_turma'> <div class='badge-modal'> Curso </div>
                                                <select class='form-control' name='curso'>
                                                    $optcurso;
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
            else if($modal == 'excluir'){
                echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title h4' id='TituloModalCentralizado'>Excluir <strong>Disciplina</strong></h1>
                            <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'></span>
                            </button>
                        </div>

                        <form action='?page=excluir_disc&id_disc=$id_disc' method='post'>
                            <div class='modal-body'>
                            
                                <div class='row'>

                                    <input type='hidden' value='$id_disc' name='id_disc'>

                                    <div class='form-group col-md-6'>
                                        <label for='n_turma'> <div class='badge-modal'> Nome </div>
                                            <input type='text' readonly name='nome' class='form-control' value='$nome_disc'>
                                        </label>
                                    </div>
                                    <div class='form-group col-md-6'>
                                        <label for='n_turma'> <div class='badge-modal'> Curso </div>
                                            <select class='form-control' name='curso'>
                                                $optcurso;
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