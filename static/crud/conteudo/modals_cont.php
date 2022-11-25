<!-- MODAL EDIÇÃO TURMA-->
<?php
    if(isset($_GET['id_cont'], $_GET['modal'])){
        $id_cont = (int) $_GET['id_cont'];
        $modal = $_GET['modal'];

        $sql  = "SELECT * FROM conteudo inner join ministra on conteudo.id_ministra = ministra.id_ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano where $id_cont = conteudo.id_cont";
        $resultado = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($resultado);

        $prof = $row['nome'];
        $titulo = $row['titulo_cont'];
        $desc = $row['desc_cont'];
        $data = $row['data_cont'];

        $ministra = "";
        $sql = mysqli_query($con, 'select * from ministra inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on cursa.id_ano = ano_letivo.id_ano inner join professor on ministra.mat_prof = professor.mat_prof inner join usuario on professor.id_usur = usuario.id_usur;');

        while($info = mysqli_fetch_array($sql)){ 
            $ministra .= "<option value=".$info['id_ministra'].">".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']." | ".$info['nome']."</option>";
        }

        if($modal == 'detalhar'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='turma' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Detalhes de <strong>Conteúdo</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>

                        <div class='modal-body'>
                        
                            <div class='row'>

                                <input type='hidden' value='$id_cont' name='id_cont'>

                                <div class='form-group col-md-6'>
                                    <label for='min'> <div class='badge-modal'> Ministra </div>
                                        <select readonly='readonly' disabled class='form-control' name='min'>
                                            $ministra;
                                        </select>
                                    </label>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='titulo'> <div class='badge-modal'> Título </div>
                                        <input type='text' readonly name='titulo' class='form-control' value='$titulo'>
                                    </label>
                                </div>

                            </div>
                            <div class='row'>
                                <div class='form-group col-md-6'>
                                    <label for='desc'> <div class='badge-modal'> Descrição </div>
                                        <input type='text' readonly name='desc' class='form-control' value='$desc'>
                                    </label>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='data'> <div class='badge-modal'> Data </div>
                                        <input type='date' readonly name='data' class='form-control' value='$data'>
                                    </label>
                                </div>
                            </div>

                            <br>


                        </div>
                </div>
            </div>
        </div>";}
        else if($modal == 'editar'){
            $nivel_necessario = array(
                1 => 'Administrador',
                2 => 'Diretor',
                3 => 'Coodernador',
                5 => 'Professor'
            );
                include "base/testa_nivel.php";

        echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='turma' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Edição de <strong>Conteúdo</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>

                    <form action='?page=atualiza_cont&id_cont=$id_cont' method='post'>
                        <div class='modal-body'>
                        
                            <div class='row'>

                                <input type='hidden' value='$id_cont' name='id_cont'>

                                <div class='form-group col-md-6'>
                                    <label for='min'> <div class='badge-modal'> Ministra </div>
                                        <select class='form-control' name='min'>
                                            $ministra;
                                        </select>
                                    </label>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='titulo'> <div class='badge-modal'> Título </div>
                                        <input type='text' name='titulo' class='form-control' value='$titulo'>
                                    </label>
                                </div>

                            </div>
                            <div class='row'>
                                <div class='form-group col-md-6'>
                                    <label for='desc'> <div class='badge-modal'> Descrição </div>
                                        <input type='text' name='desc' class='form-control' value='$desc'>
                                    </label>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='data'> <div class='badge-modal'> Data </div>
                                        <input type='date' name='data' class='form-control' value='$data'>
                                    </label>
                                </div>
                            </div>

                            <br>


                        </div>

                        <div class='modal-footer justify-content-center'>
                            <button type='submit' class='btn btn-primary col-md-3'> Confirmar <i class='fa-solid fa-pen-to-square'></i> </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>";}
        else if($modal == 'excluir'){
            $nivel_necessario = array(
                1 => 'Administrador',
                2 => 'Diretor',
                3 => 'Coodernador',
                5 => 'Professor'
            );
                include "base/testa_nivel.php";

            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='turma' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Excluir <strong>Conteúdo</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>

                    <form action='?page=excluir_cont&id_cont=$id_cont' method='post'>
                        <div class='modal-body'>
                        
                            <div class='row'>

                                <div class='form-group col-md-6'>
                                    <label for='min'> <div class='badge-modal'> Ministra </div>
                                        <select readonly='readonly' disabled class='form-control' name='min'>
                                            $ministra;
                                        </select>
                                    </label>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='titulo'> <div class='badge-modal'> Título </div>
                                        <input type='text' readonly name='titulo' class='form-control' value='$titulo'>
                                    </label>
                                </div>

                            </div>
                            <div class='row'>
                                <div class='form-group col-md-6'>
                                    <label for='desc'> <div class='badge-modal'> Descrição </div>
                                        <input type='text' readonly name='desc' class='form-control' value='$desc'>
                                    </label>
                                </div>
                                <div class='form-group col-md-6'>
                                    <label for='data'> <div class='badge-modal'> Data </div>
                                        <input type='date' readonly name='data' class='form-control' value='$data'>
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
<script> $('#turma').modal('show') </script>