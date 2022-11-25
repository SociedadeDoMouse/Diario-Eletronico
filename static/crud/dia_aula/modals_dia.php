<!-- MODAL EDIÇÃO TURMA-->
<?php

    if(isset($_GET['modal'], $_GET['id'])){
        $id     = $_GET['id'];
        $modal  = $_GET['modal'];

        $sql    = "SELECT * FROM data_aula inner join ministra on data_aula.id_ministra = ministra.id_ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano where id_diaaula = ".$id;

        $resultado = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($resultado);


    }
        if(isset($modal) && $modal == 'excluir'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title h4' id='TituloModalCentralizado'>Excluir o <strong>Dia Letivo</strong></h1>
                            <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'></span>
                            </button>
                        </div>

                        <form action='?page=excluir_dia&id=$id' method='post'>
                            <div class='modal-body'>
                            
                                <div class='row'>
                                    <div class='form-group col-md-6'>
                                        <label for='disc_aula'> <div class='badge-modal'> Matéria </div>
                                            <input type='text' name='disc_aula' class='form-control' value='".$row['nome_disc']."'>
                                        </label>
                                    </div>


                                    <div class='form-group col-md-6'>
                                        <label for='dt_aula'> <div class='badge-modal'> Data da Aula </div>
                                            <input type='date' name='dt_aula' class='form-control' value='".$row['data_diaaula']."'>
                                        </label>
                                    </div>


                                </div>
                                <div class='row'>
                                    <div class='form-group col-md-12'>
                                        <label for='ano_letivo'> <div class='badge-modal'> Data da Aula </div>
                                            <input type='text' name='ano_letivo' class='form-control' value='".$row['nome_ano']."'>
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

        if(isset($modal) == 'detalhar'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
                <div class='modal-dialog modal-dialog-centered' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h1 class='modal-title h4' id='TituloModalCentralizado'>Detalhar o <strong>Dia Letivo</strong></h1>
                            <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'></span>
                            </button>
                        </div>
                        <div class='row'>
										<div class='form-group col-md-12' >
											<label for='funcao' style='max-height:70vh;overflow:auto;'><table class='table'><thead><th>Data</th><th>Ação</th></thead><tbody>";

                                                $sql    = "SELECT * FROM data_aula inner join ministra on data_aula.id_ministra = ministra.id_ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano where ministra.id_ministra = ".$id;
                                                $resultado = mysqli_query($con, $sql);

												while($row = mysqli_fetch_array($resultado)){ 
													echo "<tr><td>".formdata($row['data_diaaula'])."</td>";
                                                    if($_SESSION["UsuarioNivel"] < 4){
                                                        echo"<td><a class='btn btn-danger btn-xs' data-toggle='tooltip' title='Excluir' href='?page=excluir_dia&id=".$row['id_diaaula']."&id_min=$id'>  <i class='botoes' data-feather='trash'></i> </a></td></td>";
                                                    }
												}


												echo "</tbody></table>
											</label>
										</div>
									</div>

                        
                    </div>
                </div>
            </div>";
        }
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script> $('#modal').modal('show') </script>