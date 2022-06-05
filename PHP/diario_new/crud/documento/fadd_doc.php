<div id="main" class="container-fluid">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Documento</h2>
		</div>

		<div class="col-md-1">
			<!-- Chama o Formulário para adicionar Clientes -->
			<a href="?page=fadd_doc" class="btn btn-primary pull-right h2">Novo Documento</a> 
		</div>
	</div>
	<form enctype="multipart/form-data" action="?page=insere_doc" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-2">
				<label for="id">Id</label>
				<input type="text" class="form-control" name="id" readonly>
			</div>
			<div class="form-group col-md-5">
				<label for="tit">Título</label>
				<input type="text" class="form-control" name="tit">
			</div>
			<div class="form-group col-md-5">
				<label for="desc">Descrição</label>
				<input type="text" class="form-control" name="desc">
			</div>
		</div>

		<!-- 2ª LINHA -->
		
		<div class="row"> 
			<div class="form-group col-md-4">
				<label for="arquivo">Arquivo</label>
				<input type="file" class="form-control" name="arquivo" required>
			</div>

			<div class="form-group col-md-3">
				<label for="status">Status</label>
				<select name="status" class="form-control" id="status">
					<option value="1">Ativo</option>
					<option value="0">Arquivado</option>
				</select>
			</div>
		 
			<div class="form-group col-md-3">
				<label for="versao">Versão</label>
				<input type="text" class="form-control" name="versao">
			</div>

	<hr/>

		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_doc" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
