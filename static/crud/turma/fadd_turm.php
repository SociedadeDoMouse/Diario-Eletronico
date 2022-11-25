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
	<form action="?page=insere_turm" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-2 col-sm-1">
				<label for="n_turma">Número da turma</label>
				<input type="text" class="form-control" name="n_turma">
			</div>
			<div class="form-group col-md-2 col-sm-2">
				<label for="turno">Turno</label>
					<select class='form-control' name='turno'>
						<?php
							$optturno = "";
							$sql = mysqli_query($con, 'select * from turno;');

							while($info = mysqli_fetch_array($sql)){ 
								$optturno .= "<option value=".$info['id_turno'].">".$info['turno']."</option>";		
							}
							echo $optturno;
						?>
					</select>
			</div>
			<div class="form-group col-md-3 col-sm-3">
				<label for="curso">Curso</label>
				<select name="curso" class="form-control">
					<?php
						$optano = "";
						$sql = mysqli_query($con, 'select * from curso;');
						while($info = mysqli_fetch_array($sql)){ 
							$optano .= "<option value=".$info['id_curso'].">".$info['nome_curso']."</option>";
						}
						echo $optano;
					?>
				</select>
			</div>
			<div class="form-group col-md-3 col-sm-3">
				<label for="modalidade">Modalidade</label>
				<select name="modalidade" class="form-control">
					<?php
						$optano = "";
						$sql = mysqli_query($con, 'select * from modalidade;');
						while($info = mysqli_fetch_array($sql)){ 
							$optano .= "<option value=".$info['id_modal'].">".$info['nome_modal']."</option>";
						}
						echo $optano;
					?>
				</select>
			</div>
			<div class="form-group col-md-2 col-sm-2">
				<label for="ano">Ano/Módulo</label>
				<input type="number" name="ano" class="form-control" min="1" max="10">
			</div>
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_turm" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
