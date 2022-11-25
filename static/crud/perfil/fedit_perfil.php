<!-- MODAL EDIÇÃO Usuário -->

<style>

input[type='file'] {
  display: none;
}

.input-wrapper label {
  background-color: #3498db;
  color: #fff;
  padding: 6px 20px;
  cursor:pointer;
}

.input-wrapper label:hover {
  background-color: #2980b9
}

</style>

<?php


if(isset($_GET['modal']) == 'edit'){		

	$id = (int) $_SESSION['UsuarioID'];
	$modal = $_GET['modal'];

	$sql = mysqli_query($con, "select * from usuario where id_usur = '".$id."';");
	$row = mysqli_fetch_array($sql);

	$sql2 = 'select * from funcao;';
	$resultado2 = mysqli_query($con, $sql2);

	include "base/functions/formdata.php";

	$sql  = 'SELECT * FROM usuario as a ';
	$sql .= 'WHERE a.id_usur ='.$id;
	$resultado = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($resultado);
		
	echo "<div class='modal fade animate__animated animate__pulse animate__faster' id='modal' tabindex='-1' role='dialog' aria-labelledby='TituloModalCentralizado' aria-hidden='true'>
	<div class='modal-dialog modal-dialog-centered' role='document'>
		<div class='modal-content'>

			<div class='modal-header'>
				<h1 class='modal-title h4' id='TituloModalCentralizado'>Meu <strong>Perfil</strong></h1>
				<button type='button' class='btn-close btn-close-white' data-dismiss='modal' aria-label='Close'>
					<span aria-hidden='true'></span>
				</button>
			</div>

			<form action='?page=atualiza_perfil' method='post'  enctype='multipart/form-data'>
				<div class='modal-body'>
					<div class='row'>							

						<div class='form-group col-md-6'>
							<label for='nome'> <div class='badge-modal'> Nome de Usuário </div>
							<input type='text' class='form-control' name='nome' value='".$row['nome']."'>
							</label>
						</div>

						<div class='form-group col-md-6'>
							<label for='usuario'> <div class='badge-modal'> Usuário </div>
							<input type='text' class='form-control' name='usuario' value='".$row['usuario']."'>
							</label>
						</div>

					</div>

					<div class='row'>							

					<div class='form-group col-md-6'>
						<label for='email'> <div class='badge-modal'> Email </div>
						<input type='text' class='form-control' name='email' value='".$row['email']."'>
						</label>
					</div>

					<div class='form-group col-md-6'>
					<label for='funcao'> <div class='badge-modal'> Nível </div>
						<select readonly class='form-control' name='funcao' disabled>";

						while($info = mysqli_fetch_array($resultado2)){ 
							if($info['id_func'] == $row['funcao']){
								echo "<option value='".$info['id_func']."' selected>".$info['nome_func']."</option>";
								continue;
							}
							echo "<option value='".$info['id_func']."'>".$info['nome_func']."</option>";
						}


						echo "</select>
					</label>
				</div>";

				echo "</div>


				<div class='row'>							

					<div class='form-group col-md-12'>
						<label for='nome'> <div class='badge-modal'> Imagem </div>
						<div class='input-wrapper'>
							<label for='input-file'>
								Selecionar um arquivo
							</label>
							<input id='input-file' name='img' type='file' value='' />
							<span id='file-name'></span>
						</div>
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


<script>

var $input    = document.getElementById('input-file'),
    $fileName = document.getElementById('file-name');

$input.addEventListener('change', function(){
  $fileName.textContent = this.value;
});

</script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script> $('#modal').modal('show') </script>