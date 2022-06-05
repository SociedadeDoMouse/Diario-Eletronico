<?php

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";

	$id = (int) $_GET['id_usur'];
	$sql = mysqli_query($con, "select * from usuario where id_usur = '".$id."';");
	$row = mysqli_fetch_array($sql);
?>
	<br><h3 class="page-header" >Editar Usuário - <?php echo $id;?></h3>

	<!-- Área de campos do formulário de edição-->

	<form action="?page=atualiza_usu&id_usur=<?php echo $row['id_usur']; ?>" method="post">

	<!-- 1ª LINHA -->	
	<div class="row"> 
		
		<div class="form-group col-md-1">
			<label for="id">ID</label>
			<input readonly type="text" class="form-control" name="id_usur" value="<?php echo $row["id_usur"]; ?>">
		</div>
		
		<div class="form-group col-md-5">
			<label for="nome">Nome de Usuário</label>
			<input type="text" class="form-control" name="nome" value="<?php echo $row["nome"]; ?>">
		</div>
		
		<div class="form-group col-md-3">
			<label for="usuario">Usuário</label>
			<input type="text" class="form-control" name="usuario" value="<?php echo $row["usuario"]; ?>">
		</div>
	
	</div>	

	
	<!-- 2ª LINHA -->	
	<div class="row"> 

		<div class="form-group col-md-3">
			<label for="senha">Senha</label>
			<input readonly type="text" class="form-control" name="senha" value="<?php echo $row["senha"]; ?>">
		</div>
		
		<div class="form-group col-md-4">
			<label for="email">E-mail</label>
			<input type="email" class="form-control" name="email" value="<?php echo $row["email"]; ?>">
		</div>
		
		<div class="form-group col-md-2">
			<label for="funcao">Nível</label>
			<select class="form-control" id="funcao" name="funcao">
				<option value="1"<?php if (!(strcmp(1, htmlentities($row['funcao'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Administrador</option>
				<option value="2"<?php if (!(strcmp(2, htmlentities($row['funcao'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Diretor</option>
				<option value="3"<?php if (!(strcmp(3, htmlentities($row['funcao'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Coordenador</option>	
				<option value="4"<?php if (!(strcmp(4, htmlentities($row['funcao'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Secretário</option>
				<option value="5"<?php if (!(strcmp(5, htmlentities($row['funcao'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Professor</option>
				<option value="6"<?php if (!(strcmp(6, htmlentities($row['funcao'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Supervisor</option>			
			</select>
		</div>
	</div>

	<div id="actions" class="row">
	 <div class="col-md-12">
		<a href="?page=lista_usu" class="btn btn-default">Voltar</a>
		<button type="submit" class="btn btn-primary">Salvar Alterações</button>
	 </div>
	</div>
	</form>