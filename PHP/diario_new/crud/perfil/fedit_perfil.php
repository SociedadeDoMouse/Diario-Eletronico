
<?php
	$id = (int) $_SESSION['UsuarioID'];
	$sql = mysqli_query($con, "select * from usuario where id_usur = '".$id."';");
	$row = mysqli_fetch_array($sql);
?>

	<br><h3 class="page-header">Editar Perfil - <?php echo $id;?></h3>

	<!-- Área de campos do formulário de edição-->

	<form action="?page=atualiza_perfil" method="post">

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
		
		<div class="form-group col-md-3">
			<label for="senha">Senha</label>
			<input readonly type="text" class="form-control" name="senha" value="<?php echo $row["senha"]; ?>">
		</div>
	
	</div>	

	
	<!-- 2ª LINHA -->	
	<div class="row"> 
		
		<div class="form-group col-md-4">
			<label for="email">E-mail</label>
			<input readonly type="email" class="form-control" name="email" value="<?php echo $row["email"]; ?>">
		</div>
		
		<div class="form-group col-md-2">
			<label for="funcao">Nível</label>
            <input readonly type="text" class="form-control" name="email" value="<?php echo $_SESSION["UsuarioFuncao"]; ?>">
		</div>
		
		<div class="form-group col-md-2">
			<label for="ativo">Ativo</label><br>
			<?php
			if($row["ativo"]==1){
				echo "<label>SIM</label>";
			}else if($row["ativo"]==0){
				echo "<label>NÃO</label>";
			}
			?>
		</div>
	</div>

	<div id="actions" class="row">
	 <div class="col-md-12">
		<a href="?page=view_perfil" class="btn btn-default">Voltar</a>
		<button type="submit" class="btn btn-primary">Salvar Alterações</button>
	 </div>
	</div>

