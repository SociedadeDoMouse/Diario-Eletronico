<div id="main" class="container-fluid volum_content">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Disciplina de Turma</h2>
		</div>

	</div>
	<form action="?page=insere_min" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-6 col-sm-1">
				<label for="turma">Professor</label>
				<select class='form-control' name='prof'>               
					<?php

						$sql = mysqli_query($con, 'select * from professor INNER JOIN usuario ON professor.id_usur = usuario.id_usur;');
						while($info = mysqli_fetch_array($sql)){ 
							echo "<option value=".$info['mat_prof'].">".$info['nome']."</option>";
						}
	
					?>
				</select>
			</div>
			<div class="form-group col-md-6 col-sm-2">
				<label for="disc">Cursa</label>
					<select class='form-control' name='cursa'>
						<?php
							$sql = mysqli_query($con, 'select * from cursa inner join disciplina ON cursa.id_disc = disciplina.id_disc INNER JOIN ano_letivo ON cursa.id_ano = ano_letivo.id_ano;');
							while($info = mysqli_fetch_array($sql)){ 
								echo "<option value=".$info['id_cursa'].">".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']."</option>";
							}
						?>
					</select>
			</div>
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_cursa" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
