 <?php

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";
  	//include "mensagens.php"; 
  ?> 
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Curso</h2>
		</div>
	</div>
	<form action="?page=insere_curso" method="post">
		<div id="linha01" class="row"> 
			<div class="form-group col-md-1">
				<label for="id">ID</label>
				<input type="text" value="0" class="form-control" name="id_curso" required>
			</div>
			
			<div class="form-group col-md-5">
				<label for="nome">Nome do Curso</label>
				<input type="text" class="form-control" name="nome_curso">
			</div>

			<div class="form-group col-md-6">
				<label for="nome">Coordenador do Curso</label>
				<select name="coordenador" class="form-control">
					<?php
						$sql = mysqli_query($con, 'select * from usuario where funcao = 3;');
						while($info = mysqli_fetch_array($sql)){               
							echo "<option value=".$info['id_usur'].">".$info['usuario']."</option>";
						}
					?>
				</select>
            </div>
			
		</div>
	
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_curso" class="btn btn-default">Cancelar</a>
			</div>
		</div>

	</form> 

