<div id="main" class="container-fluid volum_content">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Ano Letivo</h2>
		</div>

	</div>
	<form action="?page=insere_ano" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-6 col-sm-1">
				<label for="nome">Data de Inicio</label>
				<input type="date" name="dt_ini" class="form-control">
			</div>
			<div class="form-group col-md-6 col-sm-1">
				<label for="nome">Data de Fim</label>
				<input type="date" name="dt_fim" class="form-control">
			</div>
			<div class="form-group col-md-6 col-sm-1">
				<label for="nome">OBS</label>
				<input type="text" name="obs" class="form-control">
			</div>
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_ano" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
