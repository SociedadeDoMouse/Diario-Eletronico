<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
	5 => 'Professor',
);
	include "base/testa_nivel.php";

	if(!isset($_GET['turma'])){
		$_GET['turma'] = "todas";
	}
  ?>
<div id="main" class="col-md-12">
	<div id="top" class="row">
		<div class="col-md-3">
		<h1 class="h3 mb-3">Painel de <strong>Avaliação</strong></h1>
		</div>

		<div class="col-md-6 pull-right">
			<form action="dashboard.php" method="GET" class="row">
		
				<div class="col-md-5 col-sm-4 col-10">
					<?php if($_SESSION['UsuarioNivel'] != '5'){
						echo '
						<input type="hidden" name="page" value="lista_aval">
						<select name="turma" class="form-control">
							<option selected value="todas">Todas as Turmas</option>
								';
								$sql = mysqli_query($con, 'select DISTINCT n_turma from enturmado');
								
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
					}else{
						echo '
						<input type="hidden" name="page" value="lista_aval">
						<select name="trimestre" class="form-control">
							<option selected value="todas">Todos os Trimestre</option>
								';
								$sql = mysqli_query($con, 'select DISTINCT trimestre from avaliacao');
								
									while($info = mysqli_fetch_array($sql)){ 
										if(isset($_POST['trimestre']) || isset($_GET['trimestre'])){
											if ($_POST['trimestre'] == $info['trimestre'] || $_GET['trimestre'] == $info['trimestre']) {
												echo "<option value=".$info['trimestre']." selected>".$info['trimestre']."º Trimestre</option>";
												continue;
											}
										}
										echo "<option value=".$info['trimestre'].">".$info['trimestre']."º Trimestre</option>";
									}
								
								echo "</select>";
					}

					echo "
						</div>
						<div class='col-md-1 col-1'>
							<button type='submit' class='btn btn-success'>
								<i class='fa-solid fa-magnifying-glass'></i>
							</button>
						</div>
					";
					?>


				
			
			</form>
		</div>

		<div class="col-md-3">
			<!-- Chama o Formulário para adicionar usuários -->
			<a href="?page=fadd_aval" class="btn btn-primary pull-right h2">Programar avaliação</a> 
		</div>

	</div>


	<div> <?php include "mensagens.php"; ?> </div>

	<hr class="d-none d-md-block">

	<div id="list" class="row">
		<div class="table-responsive">
			<?php
				$quantidade = 10;

				$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
				$inicio = ($quantidade * $pagina) - $quantidade;


				if($_SESSION['UsuarioNivel'] != '5' && isset($_GET['turma']) && $_GET['turma']!='todas'){
					$sql = "SELECT * FROM avaliacao inner join ministra on avaliacao.id_ministra = ministra.id_ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano where cursa.n_turma = ".$_GET['turma']." limit $inicio, $quantidade;";		
				}
				else if($_SESSION['UsuarioNivel'] == '5' && isset($_GET['trimestre']) && $_GET['trimestre']!='todas'){
					$sql = "SELECT * FROM avaliacao inner join ministra on avaliacao.id_ministra = ministra.id_ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano where avaliacao.trimestre = ".$_GET['trimestre']." and usuario.id_usur = ".$_SESSION['UsuarioID']." limit $inicio, $quantidade;";		
				}
				else if($_SESSION['UsuarioNivel'] != '5'){
					$sql = "SELECT * FROM avaliacao inner join ministra on avaliacao.id_ministra = ministra.id_ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano limit $inicio, $quantidade;";
				}
				else{
						$sql = "SELECT * FROM avaliacao inner join ministra on avaliacao.id_ministra = ministra.id_ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano where usuario.id_usur = ".$_SESSION['UsuarioID']." limit $inicio, $quantidade";
				}


				$data = mysqli_query($con, $sql) or die(mysqli_error("ERRO: ".$con));

				
				echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
				echo "<thead><tr>";
				echo "<td><strong>Professor</strong></td>"; 
				echo "<td><strong>Cursa</strong></td>"; 
				echo "<td><strong>Nota Máxima</strong></td>"; 
				echo "<td><strong>Descrição</strong></td>"; 
				echo "<td><strong>Tipo</strong></td>"; 
				echo "<td><strong>Recuperação</strong></td>"; 
				echo "<td><strong>Trimestre</strong></td>"; 
				echo "<td><strong class='actions d-flex justify-content-center'>Ações</strong></td>"; 
				echo "</tr></thead><tbody>";
				while($info = mysqli_fetch_array($data)){ 
					echo "<tr>";
					echo "<td>".$info['nome']."</td>";
					echo "<td>".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']."</td>";
					echo "<td>".floatval($info['nota_max'])."</td>"; 
					echo "<td>".$info['desc_aval']."</td>";
					echo "<td>".$info['tipo_aval']."</td>";
					if($info['recuperacao']==1){
						$rec = 'Sim';
					}else{
						$rec = 'Não';
					}
					echo "<td>".$rec."</td>";
					echo "<td>".$info['trimestre']."</td>";
					echo "<td class='actions btn-group-sm text-center'>";
					
					echo "<a class='btn btn-info btn-xs' data-toggle='tooltip' title='Detalhar' href='?turma=".$_GET['turma']."&page=lista_aval&id_aval=".$info['id_aval']."&modal=detalhar'> <i class='fa-solid fa-circle-plus'></i></i> </a>";

					echo "<a class='btn btn-warning btn-xs' data-toggle='tooltip' title='Editar'  href='?turma=".$_GET['turma']."&page=lista_aval&id_aval=".$info['id_aval']."&modal=editar'>  <i class='fa-solid fa-pen-to-square'></i> </a>"; 

					echo "<a class='btn btn-danger btn-xs' data-toggle='tooltip' title='Excluir' href='?page=lista_aval&id_aval=".$info['id_aval']."&modal=excluir'>  <i class='fa-solid fa-trash'></i> </a>";

					echo "<a class='btn btn-success btn-xs' data-toggle='tooltip' title='Lançar Nota'  href=?page=lista_avaliado&id_aval=".$info['id_aval'].">  <i class='fa-solid fa-notes-medical'></i> </a></td>"; 
				}

				include 'crud/avaliacao/modals_aval.php';

				echo "</tr></tbody></table>";
			?>
			
			<?php
					$sqlTotal 		= "select id_aval from avaliacao;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;


						echo "<ul class='pagination justify-content-center'>";
						echo "<li class='page-item'><a class='page-link' href='?turma=".$_GET['turma']."&nv=$nv&page=lista_aval&pagina=1'> Primeira</a></li> "; 
						echo "<li class='page-item'><a class='page-link' href=\"?turma=".$_GET['turma']."&nv=$nv&page=lista_aval&pagina=$anterior\"> Anterior</a></li> ";

						echo "<li class='page-item'><a class='page-link' href='?turma=".$_GET['turma']."&nv=$nv&page=lista_aval&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

						for($i = $pagina+1; $i < $pagina+$exibir; $i++){
							if($i <= $totalpagina)
							echo "<li class='page-item'><a class='page-link' href='?turma=".$_GET['turma']."&nv=$nv&page=lista_aval&pagina=".$i."'> ".$i." </a></li> ";
						}
			

					

					echo "<li class='page-item'><a class='page-link' href=\"?turma=".$_GET['turma']."&nv=$nv&page=lista_aval&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?turma=".$_GET['turma']."&nv=$nv&page=lista_aval&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
		</div>
	</div>
</div>



