<!-- MODAL DETALHAR ALUNO -->

<!-- MODAL DE EXCLUSÃO e MODAL EDIÇÃO ALUNO-->
<?php
    if(isset($_GET['id'], $_GET['modal'])){

        $id = (int) $_GET['id'];
        $modal = $_GET['modal'];

        $sql  = 'SELECT * FROM mensagem m INNER JOIN usuario u ON u.id_usur = m.id_usur';
        $sql .= ' WHERE id_msg ='.$id;
        $resultado = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($resultado);
        

        if($modal == 'detalhar'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title h4' id='TituloModalCentralizado'>Detalhes de <strong>Alerta</strong></h1>
                    <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'></span>
                    </button>
                </div>

                    <div class='modal-body'>
                    
                        <div class='row'>
                            <div class='form-group col-md-6 col-sm-1'>
                                <label for='mat_aluno'> <div class='badge-modal'> Usuário </div>
                                    <input readonly type='text' class='form-control' name='mat_aluno' id='col-1' value='".$row['nome']."'>
                                </label>
                            </div>
                            <div class='form-group col-md-6 col-sm-1'>
                                <label for='mat_aluno'> <div class='badge-modal'> Data </div>
                                    <input readonly type='text' class='form-control' name='mat_aluno' id='col-1' value='".date('d/m/Y H:i:s',strtotime($row['data_msg']))."'>
                                </label>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='form-group col-md-12 col-sm-12'>
                                <label for='mat_aluno'> <div class='badge-modal'> Tipo </div>
                                    <input readonly type='text' class='text-center form-control' name='mat_aluno' id='col-1' value='"; 
                                    switch ($row['tipo_msg']) {
                                        case 1:
                                            echo 'Alerta';
                                            break;
                                        
                                        case 2:
                                            echo 'Aviso';
                                            break;
                                            
                                        case 3:
                                            echo 'Registro';
                                            break;

                                        case 4:
                                            echo 'Aviso Público';
                                            break;
                                        
                                    }
                                    echo"'>
                                </label>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='form-group col-md-12 col-sm-12 col-xs-12'>
                                <label for='nome'> <div class='badge-modal'> Mensagem </div>
                                    <textarea readonly class='form-control' name='nome_aluno' id='col-2' style='resize:none;' rows='9' cols='100'>".$row['txt_msg']."</textarea>
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
                3 => 'Coodernador',
                4 => 'Secretario',
                6 => 'Supervisor'
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
        
                    <form action='?page=atualiza_alerta' method='post'>
                        <input type='hidden' class='form-control' name='id' id='col-1' value='".$row['id_msg']."'>
                        <div class='modal-body'>

                            <div class='row'>
                                <div class='form-group col-md-6 col-sm-1'>
                                    <label for='mat_aluno'> <div class='badge-modal'> Usuário </div>
                                        <select class='form-control' name='usur' id='col-1' value='".$row['nome']."'>
                                        ";
                                        $sql = mysqli_query($con, 'select * from usuario;');
                                        while($info = mysqli_fetch_array($sql)){ 

                                            if ($row['id_usur'] == $info['id_usur'] || $row['id_usur'] == $info['id_usur']) {

                                                echo "<option value=".$info['id_usur']." selected>".$info['nome']."</option>";
                                                continue;

                                            }
                                            
                                            echo "<option value=".$info['id_usur'].">".$info['nome']."</option>";
                                            
                                        }
                                    echo"
                                        </select>
                                    </label>
                                </div>
                                <div class='form-group col-md-6 col-sm-1'>
                                    <label for='mat_aluno'> <div class='badge-modal'> Data </div>
                                        <input type='datetime-local' step='1' class='form-control' name='data' id='col-1' value='".$row['data_msg']."'>
                                    </label>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='form-group col-md-12 col-sm-12'>
                                    <label for='mat_aluno'> <div class='badge-modal'> Tipo </div>
                                        <select class='form-control' name='tipo' id='col-1'>'"; 

                                        $tipos = ['Alertas','Avisos','Registros','Avisos Públicos'];

                                        for ($i=1; $i <= 4; $i++) { 

                                                if ($row['tipo_msg'] == $i) {

                                                    echo '<option value="'.$i.'" selected> '.$tipos[$i-1].' </option>';
                                                    continue;

                                                }
                                                echo '<option value="'.$i.'"> '.$tipos[$i-1].' </option>';
                                            
                                        }
                                        
                                        echo"</select>
                                    </label>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='form-group col-md-12 col-sm-12 col-xs-12'>
                                    <label for='nome'> <div class='badge-modal'> Mensagem </div>
                                        <textarea class='form-control' name='txt' id='col-2' style='resize:none;' rows='4' cols='100'>".$row['txt_msg']."</textarea>
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
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Detalhes de <strong>Alerta</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'></span>
                        </button>
                    </div>

                    <div class='modal-body'>
                        <form action='?page=excluir_alerta' method='POST'>
                            <input type='hidden' class='form-control' name='id' id='col-1' value='".$row['id_msg']."'>
                            <div class='row'>
                                <div class='form-group col-md-6 col-sm-1'>
                                    <label for='mat_aluno'> <div class='badge-modal'> Usuário </div>
                                        <input readonly type='text' class='form-control' id='col-1' value='".$row['nome']."'>
                                    </label>
                                </div>
                                <div class='form-group col-md-6 col-sm-1'>
                                    <label for='mat_aluno'> <div class='badge-modal'> Data </div>
                                        <input readonly type='text' class='form-control' id='col-1' value='".date('d/m/Y H:i:s',strtotime($row['data_msg']))."'>
                                    </label>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='form-group col-md-12 col-sm-12'>
                                    <label for='mat_aluno'> <div class='badge-modal'> Tipo </div>
                                        <input readonly type='text' class='text-center form-control' id='col-1' value='"; 
                                        switch ($row['tipo_msg']) {
                                            case 1:
                                                echo 'Alerta';
                                                break;
                                            
                                            case 2:
                                                echo 'Aviso';
                                                break;
                                                
                                            case 3:
                                                echo 'Registro';
                                                break;

                                            case 4:
                                                echo 'Aviso Público';
                                                break;
                                            
                                        }
                                        echo"'>
                                    </label>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='form-group col-md-12 col-sm-12 col-xs-12'>
                                    <label for='nome'> <div class='badge-modal'> Mensagem </div>
                                        <textarea readonly class='form-control' id='col-2' style='resize:none;' rows='9' cols='100'>".$row['txt_msg']."</textarea>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class='modal-footer justify-content-center'>
                            <button type='submit' class='btn btn-danger col-md-3 buttonClass'>Confirmar <i class='fa-solid fa-trash'></i> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>";}


    }
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script> $('#modal').modal('show') </script>