<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
    include "base/testa_nivel.php"; 

	$matricula = (int) $_GET['mat_aluno'];
	$sql = mysqli_query($con, "select * from aluno where mat_aluno = '".$matricula."';");
	$row = mysqli_fetch_array($sql);
?>
<div id="main" class="container-fluid">
	<h3 class="page-header">Visualizar registro do Aluno - <?php echo $matricula; ?> </h3>
	<div class="row">
		<div class="col-md-2">
			<p><strong>Matrícula</strong></p>
			<p><?php echo $row['mat_aluno'];?></p>
		</div>
		<div class="col-md-5">
			<p><strong>Nome Completo</strong></p>
			<p><?php echo $row['nome_aluno'];?></p>
		</div>

	</div>
	<hr/>
	<div id="actions" class="row">
		<div class="col-md-12">
			<a href="?page=lista_alu" class="btn btn-default">Voltar</a>
				<?php echo "<a href=?page=fedita_alu&mat_aluno=".$row['mat_aluno']." class='btn btn-primary'>Editar</a>";?>
				<?php echo "<a href=?page=excluir_alu&mat_aluno=".$row['mat_aluno']." class='btn btn-danger'>Excluir</a>";?>
		</div>
	</div>
</div>
