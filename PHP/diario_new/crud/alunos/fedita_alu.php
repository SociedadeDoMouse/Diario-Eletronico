<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
    include "base/testa_nivel.php";

	//include "base\conexao.php";
	$matricula = (int) $_GET['mat_aluno'];
	$sql = mysqli_query($con, "select * from aluno where mat_aluno = '".$matricula."';");
	$row = mysqli_fetch_array($sql);
?>
<div id="main" class="container-fluid">
	<br><h3 class="page-header">Editar Aluno - <?php echo $matricula ;?></h3>

	<!-- Área de campos do formulário de edição-->

	<form action="?page=atualiza_alu&mat_aluno=<?php echo $row['mat_aluno']; ?>" method="post">

	<!-- 1ª LINHA -->	
	<div class="row"> 
		<div class="form-group col-md-1 col-sm-1">
			<label for="mat_aluno">Matrícula</label>
			<input readonly type="text" class="form-control" name="mat_aluno" value="<?php echo $row["mat_aluno"]; ?>">
		</div>
		<div class="form-group col-md-5 col-sm-4 col-xs-2">
			<label for="nome">Nome Completo</label>
			<input type="text" class="form-control" name="nome_aluno" value="<?php echo $row["nome_aluno"]; ?>">
		</div>
	</div>
	<div id="actions" class="row">
		<div class="col-md-12 col-sm-12 col-xs-8">
			<a href="?page=lista_alu" class="btn btn-secondary">Voltar</a>
			<button type="submit" class="btn btn-primary">Salvar Alterações</button>
		</div>
	</div>
	
</form>

</div>