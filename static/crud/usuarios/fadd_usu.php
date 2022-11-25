 <?php

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";
  	include "mensagens.php"; 
  ?> 
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Usuário</h2>
		</div>
	</div>
	<form action="?page=insere_usu" method="post">
		<div id="linha01" class="row"> 
			
			<div class="form-group col-md-5">
				<label for="nome">Nome do Usuário</label>
				<input type="text" class="form-control" name="nome">
			</div>
			
			<div class="form-group col-md-3">
				<label for="usuario">Usuário</label>
				<input type="text" class="form-control" name="usuario">
			</div>
			
			<div class="form-group col-md-3">
				<label for="senha">Senha</label>
				<input type="password" class="form-control" name="senha">
			</div>
			
		</div>
	
		<div id="linha02" class="row"> 
		
			<div class="form-group col-md-4">
				<label for="email">E-mail</label>
				<input type="email" class="form-control" name="email">
			</div>

			<div class="form-group col-md-2">
				<label for="nivel">Nível</label>
				<select class="form-control" name="nivel" id="nivel">
					<option value="1" >Administrador</option>
					<option value="2">Diretor</option>
					<option value="3">Coordenador</option>	
					<option value="4">Secretário</option>
					<option value="5" disabled>Professor</option>
					<option value="6">Supervisor</option>	
				</select>
			</div>
			

			<div class="form-group col-md-2">
				<label for="ativo">Ativo</label><br>
				<label class="radio-inline">
					<input type="radio" name="optativo" checked disabled >Sim
				</label>
				<label class="radio-inline">
					<input type="radio" name="optativo" disabled>Não
				</label>
			</div>

		</div>
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_usu" class="btn btn-default">Cancelar</a>
			</div>
		</div>

	</form> 

