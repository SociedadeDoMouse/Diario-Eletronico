<?php 

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
    include "base/testa_nivel.php";
?>
<div id="main" class="container-fluid volum_content">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Alunos</h2>
		</div>

	</div>
	<form action="?page=insere_alu" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-2 col-sm-1">
				<label for="matricula">Matrícula</label>
				<input type="text" class="form-control" name="matricula" readonly>
			</div>
			<div class="form-group col-md-5 col-sm-4">
				<label for="nome_aluno">Nome Completo</label>
				<input type="text" class="form-control" name="nome_aluno">
			</div>
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_alu" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
