 <?php

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";
  	include "mensagens.php"; 
  ?> 
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Matéria</h2>
		</div>
	</div>
	<div class='row'>
		<?php
			$optcursa = "";
			$sql = mysqli_query($con, 'select * from ano_letivo;');
			while($info = mysqli_fetch_array($sql)){ 
				$optcursa .= '<h3>'.$info['nome_ano'].'</h3>';
				$sql2 = mysqli_query($con, 'select * from turma;');
				while($info2 = mysqli_fetch_array($sql2)){ 
					$optcursa .= "<div class='col-md-2 mb-5'><div class='btn-group'><button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>".$info2['n_turma']."</button>
					<div class='dropdown-menu'>";
					$sql3 = mysqli_query($con, 'select * from cursa AS c INNER JOIN disciplina AS d ON c.id_disc = d.id_disc where n_turma = '.$info2['n_turma'].' and id_ano='.$info['id_ano'].';');
					while ($info3 = mysqli_fetch_array($sql3)) {
						$optcursa .= '<a class="dropdown-item" href="?page=fadd_prof&cursa='.$info3['id_cursa'].'">'.$info3['nome_disc'].'</a>';
					}
					$optcursa .= '</div></div></div>';
				}
			}
			echo $optcursa;
		?>
	</div>
	<div id="actions" class="row">
		<div class="col-md-12 mt-5">
			<a href="?page=lista_usu" class="btn btn-danger">Cancelar</a>
		</div>
	</div>
