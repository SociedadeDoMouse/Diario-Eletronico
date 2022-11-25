<?php 

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
);
    include "base/testa_nivel.php";
?>
<?php include "mensagens.php"; ?>
<div id="main" class="container-fluid volum_content">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Alunos  <button class='btn btn-success' onclick='addcampo()'>+</button></h2> 
		</div>

	</div>
	<form action="?page=insere_alu" method="post">
		<div class="row"> 
			<div class="form-group col-md-2 col-sm-1">
				<label for="matricula">Turma</label>
				<?php 
					echo '
					<select name="turma" class="form-control" required>
						';
						$sql = mysqli_query($con, 'select DISTINCT n_turma from turma');
						
							while($info = mysqli_fetch_array($sql)){ 
								echo "<option value=".$info['n_turma'].">Turma ".$info['n_turma']."</option>";
							}
						
					echo "</select>";
				?>
			</div>
			<div class="form-group col-md-2 col-sm-1">
				<label for="nome_aluno">Ano Letivo</label>
				<?php 
					echo '
					<select name="ano" class="form-control" required>
						';
						$sql = mysqli_query($con, 'select DISTINCT nome_ano, id_ano from ano_letivo');
						
							while($info = mysqli_fetch_array($sql)){ 
								echo "<option value=".$info['id_ano'].">".$info['nome_ano']."</option>";
							}
						
					echo "</select>";
				?>
			</div>
		</div>
		<hr>
		<!-- 1ª LINHA -->	
		<div id='campos'>
			<div class="row"> 
				<div class="form-group col-md-2 col-sm-1">
					<label for="matricula">Número</label>
					<input type="number" class="form-control" required name="numero0" id="numero0" onkeyup="valor(`numero0`)">
				</div>
				<div class="form-group col-md-2 col-sm-1">
					<label for="matricula">Matrícula</label>
					<input type="text" class="form-control" required name="matricula0" id="matricula0" onkeyup="valor(`matricula0`)">
				</div>
				<div class="form-group col-md-5 col-sm-4">
					<label for="nome_aluno">Nome Completo</label>
					<input type="text" class="form-control" required name="nome_aluno0" id="nome_aluno0" onkeyup="valor(`nome_aluno0`)">
				</div>
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

<script>
	let a = 0
	function valor(id){
		numero = document.getElementById(id).value;
		document.getElementById(id).setAttribute('value',numero);
	}
	function addcampo(){

		a++
		
		document.getElementById('campos').innerHTML += '<hr><div class="row"><div class="form-group col-md-2 col-sm-1"><label for="matricula">Número</label><input type="number" onkeyup="valor(`numero'+a+'`)" class="form-control" required name="numero'+a+'" id="numero'+a+'"></div><div class="form-group col-md-2 col-sm-1"><label for="matricula">Matrícula</label><input type="text" class="form-control" required name="matricula'+a+'" id="matricula'+a+'" onkeyup="valor(`matricula'+a+'`)"></div><div class="form-group col-md-5 col-sm-4"><label for="nome_aluno">Nome Completo</label><input type="text" class="form-control" required name="nome_aluno'+a+'" id="nome_aluno'+a+'" onkeyup="valor(`nome_aluno'+a+'`)"></div></div>'
	}
</script>
