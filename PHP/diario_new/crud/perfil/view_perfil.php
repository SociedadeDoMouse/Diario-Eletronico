<?php
	$id = (int) $_SESSION['UsuarioID'];
	$sql = mysqli_query($con, "select * from usuario where id_usur = '".$id."';");
	$row = mysqli_fetch_array($sql);
?>
	<table class="table table-striped">


		<br> <br>
		<?php 
if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
	
	switch($msg){;
		case 1:
			echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">Perfil atualizado com sucesso! <br> (Caso ache que tenha algo de errado, entre em contato com o administrador)
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>';
			break;
	}
	$msg = 0;
}
?>
			<h3 class="page-header">Meu Perfil - <?php echo $id;?></h3>
		
		<!-- 1ª LINHA -->
		
		<div class="row">
			<div class="col-md-1">
				<p><strong>ID</strong> <br>
				<?php echo $row['id_usur'];?></p>
			</div>

			<div class="col-md-3">
				<p><strong>Nome do usuário</strong></p>
				<p><?php echo $row['nome'];?></p>
			</div>

			<div class="col-md-2">
				<p><strong>Usuário</strong></p>
				<p><?php echo $row['usuario']; ?></p>
			</div>

			<div class="col-md-3">
				<p><strong>Senha</strong></p>
				<p><?php echo $row['senha']; ?></p>
			</div>
		</div>
		
		<!-- 2ª LINHA -->
		
		<div class="row">
			<div class="col-md-4">
				<p><strong>E-mail</strong></p>
				<p><?php echo $row['email'];?></p>
			</div>

			<div class="col-md-3">
				<p><strong>Nível</strong></p>
				<p><?php switch($row['funcao'])
						{
							case 1: echo "ADMINISTRADOR";break;
							case 2: echo "DIRETOR";break;
							case 3: echo "COORDENADOR";break;
							case 4: echo "SECRETÁRIO";break;
							case 5: echo "PROFESSOR";break;
							case 6: echo "SUPERVISOR";break;
						}
					?>
				</p>
			</div>

			<div class="col-md-2">
				<p><strong>Ativo</strong></p>
				<p><?php
					if($row["ativo"]==1){
						echo "SIM";
					}else if($row["ativo"]==0){
						echo "NÃO";	
					}
					?>
				</p>
			</div>
		</div>
		
		<div id="actions" class="row">
			<div class="col-md-12">
				<a href="dashboard.php" class="btn btn-default">Voltar</a>
				<?php echo "<a href=?page=fedit_perfil class='btn btn-primary'>Editar</a>";?>
			</div>
		</div>
	</table>
