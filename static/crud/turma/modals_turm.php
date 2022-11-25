 <!-- MODAL EDIÇÃO TURMA--> 
 <?php

 
    if(isset($_GET['n_turma'], $_GET['modal'])){
        $nturma = (int) $_GET['n_turma'];
        $modal = $_GET['modal'];

        $sql  = 'SELECT t.n_turma, t.id_turno, t.id_curso, t.id_modal, t.ano_modulo, tr.turno, c.nome_curso, 
        m.nome_modal FROM turma AS t ';
        $sql .= 'INNER JOIN turno AS tr ON t.id_turno = tr.id_turno ';
        $sql .= 'INNER JOIN curso AS c ON t.id_curso = c.id_curso ';
        $sql .= 'INNER JOIN modalidade AS m ON t.id_modal = m.id_modal ';
        $sql .= 'WHERE t.n_turma ='.$nturma;
        $resultado = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($resultado);

        $sqlturno = 'SELECT * FROM turno ';
        $resultadoturno = mysqli_query($con, $sqlturno);

        $sqlcurso = 'SELECT * FROM curso ';
        $resultadocurso = mysqli_query($con, $sqlcurso);

        $sqlmodalidade = 'SELECT * FROM modalidade ';
        $resultadomodalidade = mysqli_query($con, $sqlmodalidade);

    if($modal == 'editar'){
        echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Edição de <strong>Turma</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>

                    <form action='?page=atualiza_turm' method='post'>
                        <div class='modal-body'>
                        
                            <div class='row'>

                                <div class='form-group col-md-6'>
                                    <label for='n_turma'> <div class='badge-modal'> Turma </div>
                                        <input type='text' class='form-control' readonly='readonly' disabled name='n_turma' value='".$row['n_turma']."'>
                                    </label>
                                </div>

                                <div class='form-group col-md-6'>
                                    <label for='n_turma'> <div class='badge-modal'> Ano </div>
                                        <input type='text' class='form-control' readonly='readonly' disabled name='ano_modulo' value='".$row['ano_modulo']."'>
                                    </label>
                                </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='form-group col-md-4'>
                                    <label for='funcao'> <div class='badge-modal'> Curso </div>
                                        <select class='form-control' readonly='readonly' disabled name='curso'>";

                                            while($info = mysqli_fetch_array($resultadocurso)){ 
                                                if($info['id_curso'] == $row['id_curso']){
                                                    echo "<option value='".$info['id_curso']."' selected>".$info['nome_curso']."</option>";
                                                    continue;
                                                }
                                                echo "<option value='".$info['id_curso']."'>".$info['nome_curso']."</option>";
                                            }


                                        echo "</select>
                                    </label>
                                </div>

                                <div class='form-group col-md-4'>
                                    <label for='funcao'> <div class='badge-modal'> Turno </div>
                                        <select class='form-control' readonly='readonly' disabled name='turno'>";

                                            while($info = mysqli_fetch_array($resultadoturno)){ 
                                                if($info['id_turno'] == $row['id_turno']){
                                                    echo "<option value='".$info['id_turno']."' selected>".$info['turno']."</option>";
                                                    continue;
                                                }
                                                echo "<option value='".$info['id_turno']."'>".$info['turno']."</option>";
                                            }


                                        echo "</select>
                                    </label>
                                </div>

                                <div class='form-group col-md-4'>
                                    <label for='funcao'> <div class='badge-modal'> Modalidade </div>
                                        <select class='form-control' readonly='readonly' disabled name='modalidade'>";

                                            while($info = mysqli_fetch_array($resultadomodalidade)){ 
                                                if($info['id_modal'] == $row['id_modal']){
                                                    echo "<option value='".$info['id_modal']."' selected>".$info['nome_modal']."</option>";
                                                    continue;
                                                }
                                                echo "<option value='".$info['id_modal']."'>".$info['nome_modal']."</option>";
                                            }


                                        echo "</select>
                                    </label>
                                </div>

                            </div>

                        </div>

                        <div class='modal-footer justify-content-center'>
                            <button type='submit' class='btn btn-primary col-md-3'>Confirmar <i class='fa-solid fa-check'></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>";
        }
        else{
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Excluir <strong>Turma</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>

                    <form action='?page=excluir_turm' method='post'>
                        <div class='modal-body'>
                        
                            <div class='row'>

                                <div class='form-group col-md-6'>
                                    <label for='n_turma'> <div class='badge-modal'> Turma </div>
                                        <input type='text' class='form-control' readonly='readonly' disabled name='n_turma' value='".$row['n_turma']."'>
                                    </label>
                                </div>

                                <div class='form-group col-md-6'>
                                    <label for='n_turma'> <div class='badge-modal'> Ano </div>
                                        <input type='text' class='form-control' readonly='readonly' disabled name='ano_modulo' value='".$row['ano_modulo']."'>
                                    </label>
                                </div>

                            </div>

                            <br>

                            <div class='row'>

                                <div class='form-group col-md-4'>
                                    <label for='funcao'> <div class='badge-modal'> Curso </div>
                                        <select class='form-control' readonly='readonly' disabled name='curso'>";

                                            while($info = mysqli_fetch_array($resultadocurso)){ 
                                                if($info['id_curso'] == $row['id_curso']){
                                                    echo "<option value='".$info['id_curso']."' selected>".$info['nome_curso']."</option>";
                                                    continue;
                                                }
                                                echo "<option value='".$info['id_curso']."'>".$info['nome_curso']."</option>";
                                            }


                                        echo "</select>
                                    </label>
                                </div>

                                <div class='form-group col-md-4'>
                                    <label for='funcao'> <div class='badge-modal'> Turno </div>
                                        <select class='form-control' readonly='readonly' disabled name='turno'>";

                                            while($info = mysqli_fetch_array($resultadoturno)){ 
                                                if($info['id_turno'] == $row['id_turno']){
                                                    echo "<option value='".$info['id_turno']."' selected>".$info['turno']."</option>";
                                                    continue;
                                                }
                                                echo "<option value='".$info['id_turno']."'>".$info['turno']."</option>";
                                            }


                                        echo "</select>
                                    </label>
                                </div>

                                <div class='form-group col-md-4'>
                                    <label for='funcao'> <div class='badge-modal'> Modalidade </div>
                                        <select class='form-control' readonly='readonly' disabled name='modalidade'>";

                                            while($info = mysqli_fetch_array($resultadomodalidade)){ 
                                                if($info['id_modal'] == $row['id_modal']){
                                                    echo "<option value='".$info['id_modal']."' selected>".$info['nome_modal']."</option>";
                                                    continue;
                                                }
                                                echo "<option value='".$info['id_modal']."'>".$info['nome_modal']."</option>";
                                            }


                                        echo "</select>
                                    </label>
                                </div>

                            </div>

                        </div>

                        <div class='alert alert-danger' role='alert'>
                            Ao clicar em confirmar, todos os alunos enturmados nessa turma serão desenturmados e qualquer frequência relacionada ao mesmo será perdida. Ele também será removido de todas as disciplinas a qual faz parte.
                        </div>

                        <div class='modal-footer justify-content-center'>
                            <button type='submit' class='btn btn-danger col-md-3'>Confirmar <i class='fa-solid fa-trash'></i>  </button>
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