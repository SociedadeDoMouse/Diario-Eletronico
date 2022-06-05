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
	<table class="table table-striped">
		<br>
			<h3 class="page-header">Informações de Usuários - ID <?php echo $id;?></h3>
		
		<!-- 1ª LINHA -->
		
		<div class="row">

			<div class="col-md-2 col-sm-2">
				<p><strong>Nome do usuário</strong></p>
				<p><?php echo $row['nome'];?></p>
			</div>
	
			<div class="col-md-1 col-sm-1">
				<p><strong>Usuário</strong></p>
				<p><?php echo $row['usuario']; ?></p>
			</div>

			<div class="col-md-3 col-sm-2">
				<p><strong>Senha</strong></p>
				<p><?php echo $row['senha']; ?></p>
			</div>
		</div>
		
		<!-- 2ª LINHA -->
		
		<div class="row">
			<div class="col-md-4 col-sm-3">
				<p><strong>E-mail</strong></p>
				<p><?php echo $row['email'];?></p>
			</div>

			<div class="col-md-3 col-sm-2">
				<p><strong>Nível</strong></p>
				<p><?php switch($row['funcao'])
						{
							case 1: echo "ADMINISTRADOR";break;
							case 2: echo "DIRETOR";break;
							case 3: echo "COORDENADOR";break;
							case 3: echo "SECRETÁRIO";break;
							case 3: echo "PROFESSOR";break;
							case 3: echo "SUPERVISOR";break;
						}
					?>
				</p>
			</div>

			<div class="col-md-2 col-sm-1">
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
				<a href="?page=lista_usu" class="btn btn-default">Voltar</a>
				<?php echo "<a href=?page=fedita_usu&id_usur=".$row['id_usur']." class='btn btn-primary'>Editar</a>";?>
				<?php
					if($row["ativo"]==1){
						echo "<a href=?page=block_usu&id_usur=".$row['id_usur']." class='btn btn-danger'>Bloquear</a>";
					}else if($row["ativo"]==0){
						echo "<a href=?page=ativa_usu&id_usur=".$row['id_usur']." class='btn btn-success'>&nbsp;&nbsp;&nbsp;Ativar&nbsp;&nbsp;</a>";
					}
					?>
			</div>
		</div>
	</table>
