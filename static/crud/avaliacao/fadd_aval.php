<div id="main" class="container-fluid volum_content">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Programar avaliação</h2>
		</div>

	</div>
	<form action="?page=insere_aval" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-6 col-sm-1">
				<label for="nome">Ministra</label>
				<select class='form-control' name='min'>
						<?php
							if(!isset($_GET['id_min'])){
								if($_SESSION['UsuarioNivel'] == '5'){
								$sql = mysqli_query($con, 'select * from ministra inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on cursa.id_ano = ano_letivo.id_ano inner join professor on ministra.mat_prof = professor.mat_prof inner join usuario on professor.id_usur = usuario.id_usur where usuario.id_usur = '.$_SESSION['UsuarioID']);}
								else{
									$sql = mysqli_query($con, 'select * from ministra inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on cursa.id_ano = ano_letivo.id_ano inner join professor on ministra.mat_prof = professor.mat_prof inner join usuario on professor.id_usur = usuario.id_usur');
								}

								while($info = mysqli_fetch_array($sql)){ 
									echo "<option value=".$info['id_ministra'].">".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']." | ".$info['nome']."</option>";
								}
							}else{
								$sql = mysqli_query($con, 'select * from ministra inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on cursa.id_ano = ano_letivo.id_ano inner join professor on ministra.mat_prof = professor.mat_prof inner join usuario on professor.id_usur = usuario.id_usur where id_ministra ='.$_GET['id_min']);
								$info = mysqli_fetch_array($sql);
								echo "<option value=".$info['id_ministra'].">".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']." | ".$info['nome']."</option>";
							}
						?>
				</select>
			</div>
			<div class="form-group col-md-6 col-sm-1">
				<label for="nome">Trimestres</label>
				<Select name="trim" class="form-control" required>
					<option value="1">1º Trimestre</option>
					<option value="2">2º Trimestre</option>
					<option value="3">3º Trimestre</option>
					<option value="RF">Recuperação Final</option>
				</Select>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-3 col-sm-1">
				<label for="nome">Nota Máxima</label>
				<input type="number" min="1" name="nt_max" class="form-control" required>
			</div>
			<div class="form-group col-md-3 col-sm-1">
				<label for="nome">Tipo de Avaliação</label>
				<input type="text" name="tipo_aval" class="form-control" required>
			</div>
			<div class="form-group col-md-6 col-sm-1">
				<label for="nome">Descrição</label>
				<input type="text" name="desc_aval" class="form-control" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-2 col-sm-1">
				<label for="nome">Recuperação</label>
				<input type="checkbox" name="rec" class="form-check-input">
			</div>
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_aval" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
