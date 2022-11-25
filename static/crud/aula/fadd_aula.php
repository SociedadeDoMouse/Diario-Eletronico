<div id="main" class="container-fluid volum_content">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Aula</h2>
		</div>

	</div>
	<form action="?page=insere_aula" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-6 col-sm-1">
				<label for="nome">Ministra</label>
				<select class='form-control' name='min'>
						<?php
							$sql = mysqli_query($con, 'select * from ministra inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on cursa.id_ano = ano_letivo.id_ano inner join professor on ministra.mat_prof = professor.mat_prof inner join usuario on professor.id_usur = usuario.id_usur;');
							while($info = mysqli_fetch_array($sql)){ 
								echo "<option value=".$info['id_ministra'].">".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']." - ".$info['nome']."</option>";
							}
						?>
				</select>
			</div>
			<div class="form-group col-md-6 col-sm-1">
				<label for="nome">Trimestre</label>
				<input type="number" name="trim" class="form-control">
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-6 col-sm-1">
				<label for="nome">Aulas Previstas</label>
				<input type="number" name="aula_prev" class="form-control">
			</div>
			<div class="form-group col-md-6 col-sm-1">
				<label for="nome">Aulas Ministradas</label>
				<input type="number" name="aula_min" class="form-control">
			</div>
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_aula" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
