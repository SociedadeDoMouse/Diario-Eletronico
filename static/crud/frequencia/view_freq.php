<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
    4 => 'Secretario',
    5 => 'Professor',
    6 => 'Supervisor'
);
    include "base/testa_nivel.php"; 

	$matricula = (int) $_GET['mat_aluno'];
	$sql = mysqli_query($con, "select * from aluno where aluno.mat_aluno = '".$matricula."';");
	$row = mysqli_fetch_array($sql);
?>
<br><br>

<div class="card table table-striped">

  <div class="card-header">
    <h1 class="page-header"> <i class="fa-solid fa-graduation-cap"></i> Registro do Aluno</h1>
  </div>

  <div class="card-body">

        <div class="card-text">

            <div class="col-md-2">
                <p><strong>Matrícula</strong></p>
                <p><?php echo $row['mat_aluno'];?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Nome Completo</strong></p>
                <p><?php echo $row['nome_aluno'];?></p>
            </div>
            <div class="col-md-3">
                <p><strong>Turma</strong></p>
                <p>
                <?php 
                $sql2 = mysqli_query($con, "select * from enturmado INNER JOIN ano_letivo ON enturmado.id_ano = ano_letivo.id_ano where mat_aluno = '".$row['mat_aluno']."' ORDER BY data_inicio desc;");
                while($info = mysqli_fetch_array($sql2)){
                    echo "".$info['n_turma']." - <strong>".$info['nome_ano']."</strong><br>";
                } ?>
                </p>
            </div>

        </div>

    </div>

        <div class="card-footer">
        <div id="actions" class="row">
			<div class="col-md-12">
				<a href="?page=lista_alu" class="btn btn-secondary">Voltar</a>
                <?php echo "<a href=?page=fedita_alu&mat_aluno=".$row['mat_aluno']." class='btn btn-warning'>Editar</a>";?>
				<?php echo "<a href=?page=excluir_alu&mat_aluno=".$row['mat_aluno']." class='btn btn-danger'>Excluir</a>";?>
			</div>
		</div>
        </div>
</div>

