<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";
	include "base/functions/formdata.php";

	if(!isset($_GET['turma'])||!isset($_GET['ano'])||!isset($_GET['professores'])){
		$_GET['turma'] = "todos";
		$_GET['ano'] = "todos";
		$_GET['professores'] = "todos";
	}
  ?>
<div id="main" class="col-md-12">
<form action="dashboard.php" method="GET" class="row">
	<div id="top" class="row">
		<div class="col-md-9">
		<h1 class="h3 mb-3">Painel de <strong>Ministra</strong></h1>
		</div>
	
		
		
		<div class="col-md-3">
			<!-- Chama o Formulário para adicionar usuários -->
			<a href="?page=fadd_min" class="btn btn-primary pull-right h2">Novo Ministra</a> 
		</div>
		
	</div>
	<div class="row">
		<div class="col-4">
			<?php
				echo '
				<input type="hidden" name="page" value="lista_min">
				<select name="turma" class="form-control">
					<option selected value="todos">Todas as Turmas</option>
						';
						$sql = mysqli_query($con, 'select DISTINCT n_turma from turma');
						
							while($info = mysqli_fetch_array($sql)){ 
								if(isset($_POST['turma']) || isset($_GET['turma'])){
									if ($_POST['turma'] == $info['n_turma'] || $_GET['turma'] == $info['n_turma']) {
										echo "<option value=".$info['n_turma']." selected>Turma ".$info['n_turma']."</option>";
										continue;
									}
								}
								echo "<option value=".$info['n_turma'].">Turma ".$info['n_turma']."</option>";
							}
						
						echo "</select>";
			?>
		</div>
		<div class="col-4">
		<?php
				echo '
				<select name="ano" class="form-control">
					<option selected value="todos">Todos os Anos Letivos</option>
						';
						$sql = mysqli_query($con, 'select DISTINCT nome_ano, data_inicio from ano_letivo');
						
							while($info = mysqli_fetch_array($sql)){ 
								if(isset($_POST['ano']) || isset($_GET['ano'])){
									if ($_POST['ano'] == $info['data_inicio'] || $_GET['ano'] == $info['data_inicio']) {
										echo "<option value=".$info['data_inicio']." selected>".$info['nome_ano']."</option>";
										continue;
									}
								}
								echo "<option value=".$info['data_inicio'].">".$info['nome_ano']."</option>";
							}
						
						echo "</select>";
			?>
		</div>
		<div class="col-3">
		<?php
				echo '
				<select name="professores" class="form-control">
					<option selected value="todos">Todos os Professores</option>
						';
						$sql = mysqli_query($con, 'select DISTINCT usuario, nome from professor inner join usuario ON professor.id_usur = usuario.id_usur');
						
							while($info = mysqli_fetch_array($sql)){ 
								if(isset($_POST['professores']) || isset($_GET['professores'])){
									if ($_POST['professores'] == $info['usuario'] || $_GET['professores'] == $info['usuario']) {
										echo "<option value=".$info['usuario']." selected>".$info['nome']."</option>";
										continue;
									}
								}
								echo "<option value=".$info['usuario'].">".$info['nome']."</option>";
							}
						
						echo "</select>";
			?>
		</div>
		<div class='col-md-1'>
			<button type='submit' class='btn btn-success'>
				<i class='fa-solid fa-magnifying-glass'></i>
			</button>
		</div>
	</div>
	</form>
	<div> <?php include "mensagens.php"; ?> </div>

	<hr class="d-none d-md-block">

	<div id="list" class="row">
		<div class="table-responsive">
			<?php
				$quantidade = 10;

				$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
				$inicio = ($quantidade * $pagina) - $quantidade;


				$sql = "SELECT nome_ano,id_ministra, nome ,cursa.id_cursa, nome_disc, n_turma, data_inicio, professor.id_usur FROM cursa INNER JOIN disciplina ON cursa.id_disc = disciplina.id_disc INNER JOIN ano_letivo ON cursa.id_ano = ano_letivo.id_ano INNER JOIN ministra ON cursa.id_cursa = ministra.id_cursa INNER JOIN professor ON professor.mat_prof = ministra.mat_prof INNER JOIN usuario ON usuario.id_usur = professor.id_usur limit $inicio, $quantidade;";

				if(isset($_GET['turma']) || isset($_GET['professor']) || isset($_GET['ano']) ){
					$turma = "";
					if($_GET['turma'] != 'todos'){
						$turma = "where cursa.n_turma = ".$_GET['turma'];
					}

					if($_GET['professores'] == 'todos'){
						$professor = "";
					}
					else if($turma != ''){
						$professor = "and usuario.usuario = '".$_GET['professores']."'";
					}else{
						$professor = "where usuario.usuario = '".$_GET['professores']."'";
					}

					if($_GET['ano'] == 'todos'){
						$ano = "";
					}
					else if($turma != '' || $professor != ''){
						$ano = "and ano_letivo.data_inicio = '".$_GET['ano']."'";
					}else{
						$ano = "where ano_letivo.data_inicio = '".$_GET['ano']."'";
					}
					$sql = "SELECT nome_ano,id_ministra, nome ,cursa.id_cursa, nome_disc, n_turma, data_inicio, professor.id_usur FROM cursa INNER JOIN disciplina ON cursa.id_disc = disciplina.id_disc INNER JOIN ano_letivo ON cursa.id_ano = ano_letivo.id_ano INNER JOIN ministra ON cursa.id_cursa = ministra.id_cursa INNER JOIN professor ON professor.mat_prof = ministra.mat_prof INNER JOIN usuario ON usuario.id_usur = professor.id_usur $turma $professor $ano limit $inicio, $quantidade;";
				}

				$data = mysqli_query($con, $sql) or die(mysqli_error("ERRO: ".$con));

				
				echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
				echo "<thead><tr>";
				echo "<td><strong>Disciplina</strong></td>"; 
				echo "<td><strong>Turma</strong></td>"; 
				echo "<td><strong>Professor</strong></td>"; 
				echo "<td><strong>Ano Letivo</strong></td>"; 
				echo "<td><strong class='actions d-flex justify-content-center'>Ações</strong></td>"; 
				echo "</tr></thead><tbody>";
				while($info = mysqli_fetch_array($data)){ 
					echo "<tr>";
					echo "<td>".$info['nome_disc']."</td>";
					echo "<td>".$info['n_turma']."</td>";
					echo "<td>".$info['nome']."</td>";
					echo "<td>".$info['nome_ano']."</td>";
					echo "<td class='actions btn-group-sm text-center'>";
					

					echo "<a class='btn btn-warning btn-xs' data-toggle='tooltip' title='Editar'  href='?turma=".$_GET['turma']."&ano=".$_GET['ano']."&professores=".$_GET['professores']."&page=lista_min&id_min=".$info['id_ministra']."&modal=editar'>  <i class='fa-solid fa-pen-to-square'></i> </a>"; 

					echo "<a class='btn btn-danger btn-xs' data-toggle='tooltip' title='Excluir' href='?turma=".$_GET['turma']."&ano=".$_GET['ano']."&professores=".$_GET['professores']."&page=lista_min&id_min=".$info['id_ministra']."&modal=excluir'>  <i class='fa-solid fa-trash'></i> </a></td>";
				}

				include 'crud/ministra/modals_min.php';

				echo "</tr></tbody></table>";
			?>
			
			<?php
					$sqlTotal 		= "select id_ministra from ministra;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;


						echo "<ul class='pagination justify-content-center'>";
						echo "<li class='page-item'><a class='page-link' href='?turma=".$_GET['turma']."&ano=".$_GET['ano']."&professores=".$_GET['professores']."&nv=$nv&page=lista_min&pagina=1'> Primeira</a></li> "; 
						echo "<li class='page-item'><a class='page-link' href=\"?turma=".$_GET['turma']."&ano=".$_GET['ano']."&professores=".$_GET['professores']."&nv=$nv&page=lista_min&pagina=$anterior\"> Anterior</a></li> ";

						echo "<li class='page-item'><a class='page-link' href='?turma=".$_GET['turma']."&ano=".$_GET['ano']."&professores=".$_GET['professores']."&nv=$nv&page=lista_min&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

						for($i = $pagina+1; $i < $pagina+$exibir; $i++){
							if($i <= $totalpagina)
							echo "<li class='page-item'><a class='page-link' href='?turma=".$_GET['turma']."&ano=".$_GET['ano']."&professores=".$_GET['professores']."&nv=$nv&page=lista_min&pagina=".$i."'> ".$i." </a></li> ";
						}
			

					

					echo "<li class='page-item'><a class='page-link' href=\"?turma=".$_GET['turma']."&ano=".$_GET['ano']."&professores=".$_GET['professores']."&nv=$nv&page=lista_min&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?turma=".$_GET['turma']."&ano=".$_GET['ano']."&professores=".$_GET['professores']."&nv=$nv&page=lista_min&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
		</div>
	</div>
</div>



