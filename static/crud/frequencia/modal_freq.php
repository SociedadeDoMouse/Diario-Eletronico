<?php 

if(isset($_GET['id_freq'], $_GET['modal'])){
    $id     = $_GET['id_freq'];
    $modal  = $_GET['modal'];

    $sql = "SELECT * FROM frequencia AS f
    INNER JOIN matriculado AS m ON m.id_mat = f.id_mat
    INNER JOIN aluno AS a ON a.mat_aluno = m.mat_aluno
    INNER JOIN enturmado AS e ON e.mat_aluno = m.mat_aluno
    WHERE id_freq = $id";

    $resultado = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($resultado);

    if($row['status'] == 1){
        $status = 'Presente';
    }
    else{
        $status = 'Faltou';
    }

    if($modal == 'excluir'){
        echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
        <div class='modal-dialog modal-dialog-centered' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title h4' id='TituloModalCentralizado'>Excluir <strong>Frequência</strong></h1>
                    <button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'></span>
                    </button>
                </div>

                <form action='?page=excluir_freq&id_freq=".$info['id_freq']."&ano=$ano&turma=".$turma."&disc=".$disc."&id_freq=$id' method='post'>
                    <div class='modal-body'>
                    
                        <div class='row'>
                            
                            <div class='form-group col-md-6'>
                                <label for='num_enturmado'> <div class='badge-modal'> Nº Chamada </div>
                                    <input type='text' readonly name='num_enturmado' class='form-control' value='".$row['num_enturmado']."'>
                                </label>
                            </div>

                            <div class='form-group col-md-6'>
                                <label for='nome'> <div class='badge-modal'> Nome do Aluno </div>
                                    <input type='text' readonly name='nome' class='form-control' value='".$row['nome_aluno']."'>
                                </label>
                            </div>

                        </div>

                        <br>
                        
                        <div class='row'>

                            <div class='form-group col-md-6'>
                                <label for='status'> <div class='badge-modal'> Status </div>
                                    <input type='text' readonly name='status' class='form-control' value='$status'>
                                </label>
                            </div>

                            <div class='form-group col-md-6'>
                                <label for='data_freq'> <div class='badge-modal'> Data da Frequência </div>
                                    <input type='date' readonly name='data_freq' class='form-control' value='".$row['data_freq']."'>
                                </label>
                            </div>

                        </div>


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