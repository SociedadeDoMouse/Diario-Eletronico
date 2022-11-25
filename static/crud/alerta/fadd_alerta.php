<?php 
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
	4 => 'Secretario',
	5 => 'Professor',
	6 => 'Supervisor'
);
	include "base/testa_nivel.php";
?>
<div id="main" class="container-fluid volum_content">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Alerta</h2>
		</div>

	</div>
	<form action="?page=insere_alerta" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-12 col-sm-12">
				<label for="nome">Texto</label>
				<textarea name="txt" class="form-control" required></textarea>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-12 col-sm-1">
				<label for="nome">Tipo</label>

						<select class='form-control' name='tipo' id='col-1' required>; 
								<?php
									$tipos = ['Alertas','Avisos','Avisos Públicos'];

								for ($i=0; $i <= 2; $i++) { 
									
									echo '<option value="'.$i.'"> '.$tipos[$i].' </option>';
								
								}
							?>
						</select>
				</label>
			</div>
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_alerta" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
