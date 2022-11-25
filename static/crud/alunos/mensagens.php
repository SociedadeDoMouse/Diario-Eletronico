<?php 
 $nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
	4 => 'Secretario',
	6 => 'Supervisor'
);
include "base/testa_nivel.php"; 

if(isset($_GET['msg'])){
	$msg = $_GET['msg'];
	
	switch($msg){
		case 1:
			echo'<div class="alert alert-success alert-dismissible fade show" role="alert">Aluno cadastrado com sucesso
					<button type="button" class="btn-close"data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"></span>
					</button>
				</div>';
			break;
		case 2:
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Aluno atualizado com sucesso
					<button type="button" class="btn-close"data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"></span>
					</button>
				</div>';
			break;
		case 3:
			echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Aluno excluido com sucesso
					<button type="button" class="btn-close"data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"></span>
					</button>
				</div>';
			break;
		case 4:
			echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">Erro entre em contato com o Administrador!
					<button type="button" class="btn-close"data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"></span>
					</button>
				</div>';
			break;
		case 10:
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					 Sem nível de acesso necessário
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		  		</div>';
			break;
		case 'err':
			echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
						Já existe um aluno com esta matrícula
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>';
			break;
	}
	$msg = 0;
}
?>
