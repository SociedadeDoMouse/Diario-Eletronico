<?php 
if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
	
	switch($msg){
		case 1:
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					 Ano Letivo Cadastrado com sucesso!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  		</div>';
			break;
		case 2:
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					 Ano Letivo Atualizado com sucesso!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  		</div>';
			break;
		case 3:
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					 Ano Letivo excluído com sucesso!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  		</div>';
			break;
		case 4:
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					 Erro! entre em contato com o administrador
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  		</div>';
			break;
		case 10:
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					 Sem nível de acesso necessário
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  		</div>';
			break;
	}
	$msg = 0;
}
?>
