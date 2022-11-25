<!-- MODAL DETALHAR ALUNO -->
<div class='modal fade animate__animated animate__pulse animate__faster' id='view_alu' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
    <div class='modal-dialog modal-dialog-centered' role='document'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h1 class='modal-title h4' id='TituloModalCentralizado'>Detalhes de <strong>Aluno</strong></h1>
                <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'></span>
                </button>
            </div>

            <form action='?page=atualiza_alu' method='post'>
                <div class='modal-body'>
                
                    <div class='row'>
                        <div class='form-group col-md-6 col-sm-1'>
                            <label for='mat_aluno'> <div class='badge-modal'> Matrícula </div>
                                <input readonly type='text' class='form-control' name='mat_aluno' id='col-1' value=''>
                            </label>
                        </div>
                        <div class='form-group col-md-6 col-sm-4 col-xs-2'>
                            <label for='nome'> <div class='badge-modal'> Nome Completo </div>
                                <input readonly type='text' class='form-control' name='nome_aluno' id='col-2' value=''>
                            </label>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


<!-- MODAL EDIÇÃO ALUNO -->

<?php

    


    if(isset($_GET['mat_aluno'])){
        $mat = (int) $_GET['mat_aluno'];

            include "base/functions/formdata.php";

            $sql  = 'SELECT * FROM aluno as a ';
            $sql .= 'WHERE a.mat_aluno ='.$mat;
            $resultado = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($resultado);

            $data2 = mysqli_query($con, "select * from matriculado INNER JOIN ano_letivo ON matriculado.id_ano = ano_letivo.id_ano INNER JOIN disciplina ON disciplina.id_disc = matriculado.id_disc where mat_aluno = ".$mat.";") or die(mysqli_error("ERRO: ".$con));

            $tabela = "<table class='table table-bordered'>";
            $tabela .= "<thead><tr>";
            $tabela .= "<td><strong>Disciplina</strong></td>"; 
            $tabela .= "<td><strong>Ano letivo</strong></td>"; 
            $tabela .= "<td><strong class='actions d-flex justify-content-center'>Ações</strong></td>"; 
            $tabela .= "<td><a href=?page=fadd_mat&mat_aluno=".$row['mat_aluno']." class='btn btn-success btn-xs' data-toggle='tooltip' title='Adicionar'> + </a></td>"; 
            $tabela .= "</tr></thead><tbody>";
            while($info = mysqli_fetch_array($data2)){ 
                $tabela .= "<tr>";
                $tabela .= "<td>".$info['nome_disc']."</td>";
                $tabela .= "<td>".$info['nome_ano']."</td>";

                $tabela .= "<td class='actions btn-group-sm d-flex justify-content-center'>";

                $tabela .= "<a href=?page=excluir_mat&id_mat=".$info['id_mat']." class='btn btn-danger btn-xs' data-toggle='tooltip' title='Excluir'> <i class='fa-solid fa-trash'></i>  </a></td></tr>";

                $tabela .= "<td></td>";
                
            }
            $tabela .= "</tbody></table>";

        

echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='edit_alu' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
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
                            <label for='mat_aluno'> <div class='badge-modal'> Matricula </div>
                                <input readonly type='text' class='form-control' name='mat_aluno' value='".$row['mat_aluno']."'>
                            </label>
                        </div>
                        <div class='form-group col-md-6 col-sm-4 col-xs-2'>
                            <label for='nome'> <div class='badge-modal'> Nome Completo </div>
                                <input type='text' class='form-control' name='nome_aluno' value='".$row['nome_aluno']."'>
                            </label>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='form-group col-md-12 col-sm-1'>
                            $tabela
                        </div>
                    </div>

                </div>

                <div class='modal-footer justify-content-center'>
                    <button data-dismiss='modal' class='btn btn-primary col-md-3 buttonClass'>Confirmar <i class='fa-solid fa-check'></i> </button>
                </div>
            </form>
        </div>
    </div>
</div>";
    }
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script> $('#edit_alu').modal('show') </script>