<?php
    if(isset($_GET['id_curso'], $_GET['modal'])){
        $id_curso = (int) $_GET['id_curso'];
        $modal = $_GET['modal'];

        $sql  = 'SELECT curso.id_curso, nome_curso, usuario.nome FROM usuario 
        INNER JOIN coordenador ON usuario.id_usur = coordenador.id_usur , curso 
        INNER JOIN coordena ON coordena.id_curso  = curso.id_curso 
        WHERE coordena.id_cord = coordenador.id_cord
        AND coordena.id_curso ='.$_GET['id_curso'].';';

        $resultado = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($resultado);

        $opt="";
        $sql = mysqli_query($con, 'select * from usuario where funcao = 3 ;');

        while($info = mysqli_fetch_array($sql)){    
 
                $opt .= "<option value=".$info['id_usur']." selected>".$row['nome']."</option>";
            
        }
                                    

        $sql2  = 'SELECT * FROM  curso ';
        $sql2 .= '';

        if($modal == 'detalhar'){
            echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Detalhes de <strong>Curso</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>
                        <div class='modal-body'>
                        
                            <div class='row'>

                                <div class='form-group col-md-4 col-sm-1'>
                                    <label for='id_curso'> <div class='badge-modal'> Id </div>
                                        <input readonly type='text' class='form-control' name='id_curso' value='".$row['id_curso']."'>
                                    </label>
                                </div>

                                <div class='form-group col-md-4 col-sm-4 col-xs-2'>
                                    <label for='nome'> <div class='badge-modal'> Curso </div>
                                        <input type='text' readonly class='form-control' name='nome_curso' value='".$row['nome_curso']."'>
                                    </label>
                                </div>

                                <div class='form-group col-md-4 col-sm-4 col-xs-2'>
                                    <label for='id_usur'> <div class='badge-modal'> Coordenador </div>
                                        <select readonly='readonly' disabled name='coordenador' class='form-control'>    
                                            <option value='todos'>Todos</option>
                                            $opt
                                        </select>
                                    </label>
                                </div>
                                
                            </div>

                        </div>
                </div>
            </div>
        </div>";
        }else if($modal == 'editar'){
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
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Edição de <strong>Curso</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>

                    <form action='?page=atualiza_curso&id_curso=".$row['id_curso']."' method='post'>
                        <div class='modal-body'>
                        
                            <div class='row'>

                                <div class='form-group col-md-4 col-sm-1'>
                                    <label for='id_curso'> <div class='badge-modal'> Id </div>
                                        <input type='text' class='form-control' name='id_curso' value='".$row['id_curso']."'>
                                    </label>
                                </div>

                                <div class='form-group col-md-4 col-sm-4 col-xs-2'>
                                    <label for='nome'> <div class='badge-modal'> Curso </div>
                                        <input type='text' class='form-control' name='nome_curso' value='".$row['nome_curso']."'>
                                    </label>
                                </div>

                                <div class='form-group col-md-4 col-sm-4 col-xs-2'>
                                    <label for='id_usur'> <div class='badge-modal'> Coordenador </div>
                                        <select name='coordenador' class='form-control'>    
                                            <option value='todos'>Todos</option>";

                                            $opt="";
                                            $sql = mysqli_query($con, 'select * from usuario where funcao = 3 ;');


                                        while($info = mysqli_fetch_array($sql)){ 
                                            if($info['nome'] == $row['nome']){
                                                echo "<option value=".$info['id_usur']." selected>".$row['nome']."</option>";
                                                continue;
                                            }
                                            echo "<option value=".$info['id_usur'].">".$info['nome']."</option>";
                                        }
                                            
                                 echo "</select>
                                    </label>
                                </div>
                                
                            </div>

                        </div>

                        <div class='modal-footer justify-content-center'>
                            <button type='submit' class='btn btn-primary col-md-3 buttonClass'>Confirmar <i class='fa-solid fa-pen-to-square'></i> </button>
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
                        <h1 class='modal-title h4' id='TituloModalCentralizado'>Excluir <strong>Curso</strong></h1>
                        <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'></span>
                        </button>
                    </div>

                    <form action='?page=excluir_curso&id_curso=".$row['id_curso']."' method='post'>
                        <div class='modal-body'>
                        
                            <div class='row'>

                                <div class='form-group col-md-4 col-sm-1'>
                                    <label for='id_curso'> <div class='badge-modal'> Id </div>
                                        <input readonly type='text' class='form-control' name='id_curso' value='".$row['id_curso']."'>
                                    </label>
                                </div>

                                <div class='form-group col-md-4 col-sm-4 col-xs-2'>
                                    <label for='nome'> <div class='badge-modal'> Curso </div>
                                        <input type='text' readonly class='form-control' name='nome_curso' value='".$row['nome_curso']."'>
                                    </label>
                                </div>

                                <div class='form-group col-md-4 col-sm-4 col-xs-2'>
                                    <label for='id_usur'> <div class='badge-modal'> Coordenador </div>
                                        <select readonly='readonly' name='coordenador' class='form-control' disabled>    
                                            <option value='todos'>Todos</option>
                                            $opt
                                        </select>
                                    </label>
                                </div>
                                
                            </div>

                        </div>

                        <div class='modal-footer justify-content-center'>
                            <button type='submit' class='btn btn-primary col-md-3 buttonClass'>Confirmar <i class='fa-solid fa-trash'></i> </button>
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
<script> $('#modal ').modal('show') </script>