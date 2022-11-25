<div id="main" class="container-fluid volum_content">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Disciplina de Turma</h2>
		</div>

	</div>
	<form action="?page=insere_cursa" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-2 col-sm-1">
				<label for="turma">Número da turma</label>
				<select class='form-control' name='turma'>
					<?php
						$optturno = "";
						$sql = mysqli_query($con, 'select * from turma;');

						while($info = mysqli_fetch_array($sql)){ 
							$optturno .= "<option value=".$info['n_turma'].">".$info['n_turma']."</option>";		
						}
						echo $optturno;
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
			<div class="form-group col-md-3 col-sm-3 pt-4">
				<input class="form-check-input" name="dep" type="checkbox">
				<label class="form-check-label" for="flexCheckDefault'.$i.'">
					Dependência
				</label>
			</div>
		</div>
		
			
		<div class="row" max-height='50px'>
		
		<label for="disc" class='py-3'>Disciplina</label>


				<?php 
	
				//  $optturno = "";
				//  $sql = mysqli_query($con, 'select * from disciplina;');

				//  while($info = mysqli_fetch_array($sql)){ 
				//  	$optturno .= '<div class="form-group col-md-6 col-sm-6" >
				//  	<input class="form-check-input" name="disc'.$info['id_disc'].'" type="checkbox" value="'.$info['id_disc'].'" id="flexCheckDefault'.$info['id_disc'].'">
				//  	<label class="form-check-label" for="flexCheckDefault'.$info['id_disc'].'">
				//  		'.$info['nome_disc'].'
				//  	</label></div>';
				//  }
				//  echo $optturno;


				   $cursos = mysqli_query($con, "select * from curso");
	

				  while($info = mysqli_fetch_array($cursos)){
				 	echo '<div class="col-md-12"><h4>'.$info['nome_curso'].'</h4></div>';


				  	$disc = mysqli_query($con, "select * from disciplina where disciplina.id_curso = ".$info['id_curso'].";");

				  	$optturno = "";

				  	while($info2 = mysqli_fetch_array($disc)){
				  		$optturno .= '<div class="form-group col-md-6 col-sm-6" >
				  		<input class="form-check-input" name="disc'.$info2['id_disc'].'" type="checkbox" value="'.$info2['id_disc'].'" id="flexCheckDefault'.$info2['id_disc'].'">
				  		<label class="form-check-label" for="flexCheckDefault'.$info2['id_disc'].'">
				  			'.$info2['nome_disc'].'
				  		</label></div>';
				  	}
				  	echo $optturno;
				  	echo"<br><hr>";		
				  }
				
				?>	
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
