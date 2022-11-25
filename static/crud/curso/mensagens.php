<?php 
 $nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
	4 => 'Secretario',
	6 => 'Supervisor'
);

include "base/testa_nivel.php"; 

echo "<br>";

if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
	
	switch($msg){
		case 1:
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					 Curso Cadastrado com sucesso!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  		</div>';
			break;
		case 2:
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					 Curso Atualizado com sucesso!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  		</div>';
			break;
		case 3:
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					 Curso excluído com sucesso!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  		</div>';
			break;
		case 4:
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					Erro! entre em contato com o administrador!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  		</div>';
			break;
		case 10:
			echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
					 Sem nivel de acesso necessário!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  		</div>';
			break;
	}
	$msg = 0;
}
?>
