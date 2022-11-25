<div id="main" class="container-fluid volum_content">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Disciplina de Disciplina</h2>
		</div>

	</div>
	<form action="?page=insere_disc" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-4 col-sm-1">
				<label for="nome">Nome</label>
				<input type="text" name="nome" class="form-control">
			</div>
			<div class="form-group col-md-2 col-sm-2">
				<label for="curso">Ano</label>
					<select class='form-control' name='nome2'>
						<option value="I">1º ano</option>
						<option value="II">2º ano</option>
						<option value="III">3º ano</option>
					</select>
			</div>
			<div class="form-group col-md-6 col-sm-2">
				<label for="curso">Curso</label>
					<select class='form-control' name='curso'>
						<?php
							$sql = mysqli_query($con, 'select * from curso;');
							while($info = mysqli_fetch_array($sql)){ 
								echo "<option value=".$info['id_curso'].">".$info['nome_curso']."</option>";
							}
						?>
					</select>
			</div>
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_disc" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
