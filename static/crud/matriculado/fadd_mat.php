<?php
	$mat = $_GET['mat_aluno'];
?>
<div id="main" class="container-fluid volum_content">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Matricular</h2>
		</div>

	</div>
	<form action="?page=insere_mat" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-2 col-sm-1">
				<label for="mat">Matricula</label>
				<input class='form-control' name="mat" type="text" value="<?php echo $mat ?>" readonly>
			</div>
			<div class="form-group col-md-2 col-sm-2">
				<label for="disc">Disciplina</label>
				<select name="disc" class="form-control">
					<?php
						$optano = "";
						$sql = mysqli_query($con, 'select * from disciplina;');
						while($info = mysqli_fetch_array($sql)){ 
							$optano .= "<option value=".$info['id_disc'].">".$info['nome_disc']."</option>";
						}
						echo $optano;
					?>
				</select>
			</div>
			<div class="form-group col-md-3 col-sm-3">
				<label for="ano">Ano Letivo</label>
				<select name="ano" class="form-control">
					<?php
						$optano = "";
						$sql = mysqli_query($con, 'select * from ano_letivo;');
						while($info = mysqli_fetch_array($sql)){ 
							$optano .= "<option value=".$info['id_ano'].">".$info['nome_ano']."</option>";
						}
						echo $optano;
					?>
				</select>
			</div>
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_mat" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
