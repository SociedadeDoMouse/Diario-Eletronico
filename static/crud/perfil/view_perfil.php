<?php
	$id = (int) $_SESSION['UsuarioID'];
	$sql = mysqli_query($con, "select * from usuario where id_usur = '".$id."';");
	$row = mysqli_fetch_array($sql);
?>

<?php require "base/functions/textlimit.php"; ?>
<div id="main" class="col-md-12">
	<div class="row">
		<div class="col-md-4 col-xl-3">
			<div class="card mb-3">
				<div class="card-header">
					<h5 class="card-title mb-0">Perfil</h5>
				</div>
				<div class="card-body text-center">
					<div class="bg-userimg rounded-circle mb-3" style="max-width:128px;max-height:128px;">
						<!-- <span class="comment-userimg"> <i data-feather="image"></i> <br> Alterar Imagem</span>  == TESTE ==-->
						<img src="<?php if($row['foto'] !== '0' ){echo "crud/perfil/perfils_img/".$row['foto'];} else{echo "build/img/user.png";} ?>" class="userimg img-fluid rounded-circle mb-2" style="max-width:128px;max-height:128px;" width="128" height="128" /> 
					</div>

					<h5 class="card-title mb-0"><?php echo $row['nome'];?></h5>
					<div class="text-muted mb-2"><?php switch($row['funcao'])
						{
							case 1: echo "Administrador";break;
							case 2: echo "Diretor";break;
							case 3: echo "Coordenador";break;
							case 4: echo "Secretário";break;
							case 5: echo "Professor";break;
							case 6: echo "Supervisor";break;
						}
					?></div>

				<a href='?page=view_perfil&modal=edit' class='badge bg-primary me-1 my-1' style="padding:5px;">Editar</a>
				</div>
				<hr class="my-0" />
				<div class="card-body">
					<h5 class="h6 card-title">Contato</h5>
					<ul class="list-unstyled mb-0">
						<li class="mb-1"><span data-feather="mail" class="feather-sm me-1"></span> Email <a href="#" class="email-mask" data-toggle="tooltip" data-placement="top" title="<?php echo $row['email']; ?>"> <?php echo $row['email']; ?> </a></li>

					</ul>
				</div>
				<hr class="my-0" />
			</div>
		</div>

		<div class="col-md-8 col-xl-9">
			<div class="card">
				<div class="card-header">

					<h5 class="card-title mb-0">Atividades</h5>
				</div>
				<div class="card-body h-100">

					<div class="d-flex align-items-start">
						<div class="flex-grow-1">
						<?php 
							$nome = $_SESSION['UsuarioNome'];

							if($_SESSION['UsuarioNivel'] == 5){
								$nome = "Prof ".$_SESSION['UsuarioNome'];
							}

							$sql = mysqli_query($con, 'SELECT data_msg,txt_msg FROM mensagem where tipo_msg = 3 AND id_usur = '.$_SESSION["UsuarioID"].' order by id_msg desc;');
							while($info = mysqli_fetch_array($sql)){ 

								echo date('d/m/Y  H:i:s',strtotime($info['data_msg']))." - ".str_replace($nome,"", $info['txt_msg'])."<br>";
								
							}
						?>
						</div>
					</div>
					<hr />

				</div>
			</div>
		</div>
	</div>
	<?php	include "crud/perfil/fedit_perfil.php"; ?>
</div>

