<!-- MODAL DETALHAR USUÁRIO -->
			<div class='modal fade animate__animated animate__pulse animate__faster' id='view_usu' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
				<div class='modal-dialog modal-dialog-centered' role='document'>
					<div class='modal-content'>
						<div class='modal-header'>
							<h1 class='modal-title h4' id='TituloModalCentralizado'>Detalhes de <strong>Usuário</strong></h1>
							<button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
								<span aria-hidden='true'></span>
							</button>
						</div>

						<div class='modal-body'>

							<div class='row'>
									
								<div class='form-group col-md-2 col-sm-12'>
									<label for='id'> <div class='badge-modal'> ID </div>
										<input readonly type='text' class='form-control col-1' id='col-1' name='id_usur' value=''>
									</label>
								</div>

								<div class='form-group col-md-6 col-sm-12'>
									<label for='nome'> <div class='badge-modal'> Nome de Usuário </div>
										<input readonly type='text' class='form-control' id='col-2' name='nome' value=''>
									</label>
								</div>

								<div class='form-group col-md-4 col-sm-12'>
									<label for='usuario'> <div class='badge-modal'> Usuário </div>
										<input readonly type='text' class='form-control' id='col-3' name='usuario' value=''>
									</label>
								</div>

							</div>

							<br>

							<div class='row'>
											

							<div class='form-group col-md-2 col-sm-6'>
								<label for='ativo'> <div class='badge-modal'> Ativo </div>
								<input readonly type='text' class='form-control' id='col-6' name='status' value=''>
								</label>
							</div>
							<div class='form-group col-md-4 col-sm-12'>
								<label for='funcao'> <div class='badge-modal'> Nível </div>
								<input readonly type='text' class='form-control' id='col-5' name='funcao' value=''>
								</label>
							</div>


							<div class='form-group col-md-6 col-sm-12'>
							<div> <div class='badge-modal'> Email </div>
								<input readonly type='text' class='form-control' id='col-4' name='email' value=''>
							</div>
						</div>

						</div>
							

						</div>

					</div>
				</div>
			</div>


			<!-- MODAL DE EDIÇÃO DE USUÁRIO -->
			<!-- ESTÁ EM *ECHO* DEVIDO A NECESSIDADE DA VERIFICAÇÃO DE EXISTÊNCIA OU NÃO DO PARAMÊTRO "id_usur" -->

		<?php 
			if(isset($_GET['id_usur'])){
			$id = (int) $_GET['id_usur'];

			$sql  = 'SELECT u.id_usur, u.nome, u.usuario, u.nome, u.email, u.funcao, u.ativo, f.nome_func FROM usuario as u ';
			$sql .= 'INNER JOIN funcao AS f on u.funcao = f.id_func ';
			$sql .= 'WHERE u.id_usur ='.$id;
			$resultado = mysqli_query($con, $sql);
			$row = mysqli_fetch_array($resultado);

			$sql2 = 'select * from funcao;';
			$resultado2 = mysqli_query($con, $sql2);

		echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='edit_usu' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
			<div class='modal-dialog modal-dialog-centered' role='document'>
				<div class='modal-content'>
		
					<div class='modal-header'>
						<h1 class='modal-title h4' id='TituloModalCentralizado'>Edição de <strong>Usuário</strong></h1>
						<button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
							<span aria-hidden='true'></span>
						</button>
					 </div>
		
					<form action='?page=atualiza_usu' method='post'>
						<div class='modal-body'>
							<div class='row'>							
								<div class='form-group col-md-2'>
									<label for='id'> <div class='badge-modal'> ID </div>
									<input readonly type='text' class='form-control' name='id_usur' value='".$row['id_usur']."'>
									</label>
								</div>
		
								<div class='form-group col-md-6'>
									<label for='nome'> <div class='badge-modal'> Nome de Usuário </div>
									<input type='text' class='form-control' name='nome' value='".$row['nome']."'>
									</label>
								</div>
		
								<div class='form-group col-md-4'>
									<label for='usuario'> <div class='badge-modal'> Usuário </div>
									<input type='text' class='form-control' name='usuario' value='".$row['usuario']."'>
									</label>
								</div>
		
							</div>
		
							<br>
		
								<div class='row'>
													
									<div class='form-group col-md-8'>
										<div> <div class='badge-modal'> Email </div>
											<input type='text' class='form-control' name='email' value='".$row['email']."'>
										</div>
									</div>
		
									<div class='form-group col-md-4'>
										<label for='funcao'> <div class='badge-modal'> Nível </div>
											<select class='form-control' name='funcao'>";

											while($info = mysqli_fetch_array($resultado2)){ 
												if($info['id_func'] == $row['funcao']){
													echo "<option value='".$info['id_func']."' selected>".$info['nome_func']."</option>";
													continue;
												}
												echo "<option value='".$info['id_func']."'>".$info['nome_func']."</option>";
											}


											echo "</select>
										</label>
									</div>
								</div>
						</div>
		
						<div class='modal-footer justify-content-center'>
							<button type='submit' class='btn btn-primary col-md-3'>Confirmar <i class='botoes' data-feather='check-circle'></i> </button>
						</div>
					</form>
				</div>
			</div>
		</div>";

		}

	?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script> $('#edit_usu').modal('show') </script>