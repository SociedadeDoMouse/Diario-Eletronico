<!-- MODAL DETALHAR ALUNO -->

<!-- MODAL DE EXCLUSÃO e MODAL EDIÇÃO ALUNO-->
<?php
    if(isset($_GET['mat_aluno'], $_GET['modal'])){

        $mat = (int) $_GET['mat_aluno'];
        $modal = $_GET['modal'];

        $sql  = 'SELECT * FROM aluno as a ';
        $sql .= 'WHERE a.mat_aluno ='.$mat;
        $resultado = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($resultado);
        

        if($modal == 'detalhar'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title h4' id='TituloModalCentralizado'>Detalhes de <strong>Aluno</strong></h1>
                    <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'></span>
                    </button>
                </div>

                    <div class='modal-body'>
                    
                        <div class='row'>
                            <div class='form-group col-md-6 col-sm-1'>
                                <label for='mat_aluno'> <div class='badge-modal'> Matrícula </div>
                                    <input readonly type='text' class='form-control' name='mat_aluno' id='col-1' value='".$row['mat_aluno']."'>
                                </label>
                            </div>
                            <div class='form-group col-md-6 col-sm-4 col-xs-2'>
                                <label for='nome'> <div class='badge-modal'> Nome Completo </div>
                                    <input readonly type='text' class='form-control' name='nome_aluno' id='col-2' value='".$row['nome_aluno']."'>
                                </label>
                            </div>
                        </div>

                    </div>
            </div>
        </div>
    </div>";}
        
        else if($modal == 'editar'){
            $nivel_necessario = array(
                1 => 'Administrador',
                2 => 'Diretor',
                3 => 'Coodernador'
            );
              include "base/testa_nivel.php";

        echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Edição de <strong>Aluno</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>
        
                    <form action='?page=atualiza_alu' method='post'>
                        <div class='modal-body'>
                        
                            <div class='row'>
                                <div class='form-group col-md-6 col-sm-1'>
                                    <label for='mat_aluno'> <div class='badge-modal'> Matrícula </div>
                                        <input readonly type='text' class='form-control' name='mat_aluno' value='".$row['mat_aluno']."'>
                                    </label>
                                </div>
                                <div class='form-group col-md-6 col-sm-4 col-xs-2'>
                                    <label for='nome'> <div class='badge-modal'> Nome Completo </div>
                                        <input type='text' class='form-control' name='nome_aluno' value='".$row['nome_aluno']."'>
                                    </label>
                                </div>
                            </div>
        
                        </div>
        
                        <div class='modal-footer justify-content-center'>
                            <button type='submit' class='btn btn-primary col-md-3 buttonClass'>Confirmar <i class='fa-solid fa-check'></i> 
                        </div>
                    </form>
                </div>
            </div>
        </div>";}

        else if($modal == 'excluir'){
            $nivel_necessario = array(
                1 => 'Administrador',
                2 => 'Diretor',
                3 => 'Coodernador'
            );
              include "base/testa_nivel.php";

        echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title h4' id='TituloModalCentralizado'><strong> Excluir </strong> o Aluno ".$row['nome_aluno']."</h1>
                    <button type='button' class='btn-close btn-cxlose-white' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'></span>
                    </button>
                </div>

                <form action='?page=excluir_alu&mat_aluno=".$row['mat_aluno']."' method='post'>
                    <div class='modal-body'>
                    
                        <div class='row'>
                            <div class='form-group col-md-6 col-sm-1'>
                                <label for='mat_aluno'> <div class='badge-modal'> Matrícula </div>
                                    <input readonly type='text' class='form-control' name='mat_aluno' value='".$row['mat_aluno']."'>
                                </label>
                            </div>
                            <div class='form-group col-md-6 col-sm-4 col-xs-2'>
                                <label for='nome'> <div class='badge-modal'> Nome Completo </div>
                                    <input readonly type='text' class='form-control' name='nome_aluno' value='".$row['nome_aluno']."'>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class='modal-footer justify-content-center'>
                        <button type='submit' class='btn btn-danger col-md-3 buttonClass'>Confirmar <i class='fa-solid fa-trash'></i> </button>
                    </div>
                </form>
            </div>
        </div>
        </div>";}


    }
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script> $('#modal').modal('show') </script>