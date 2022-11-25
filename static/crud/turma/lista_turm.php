<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
	4 => 'Secretário',
);
	include "base/testa_nivel.php";

	if(!isset($_GET['turno'])||!isset($_GET['curso'])||!isset($_GET['ano'])){
		$_GET['turno'] = 'todos';
		$_GET['curso'] = 'todos';
		$_GET['ano'] = 'todos';
	}
  ?>
<div id="main" class="col-md-12">
	<div id="top" class="row">
		<div class="col-md-9">
		<h1 class="h3 mb-3">Painel de <strong>Turmas</strong></h1>
		</div>

		<div class="col-md-3">
			<!-- Chama o Formulário para adicionar usuários -->
			<a href="?page=fadd_turm" class="btn btn-primary pull-right h2">Nova Turma</a> 
		</div>

	</div>

	<div class="row">
			<form action="dashboard.php" method="get">
				<input type="hidden" name="page" value='lista_turm'>
				<div class="row">
					<div class="form-group col-md-3 col-sm-3">
						<select name="turno" class="form-control">
							<option value="todos"> Todas os turnos </option>
							<?php
								$turno = "";
								$sql = mysqli_query($con, 'select * from turno;');
								while($info = mysqli_fetch_array($sql)){ 

									if(isset($_POST['turno']) && $_POST['turno'] != "" || isset($_GET['turno']) && $_GET['turno'] != ""){

										if ($_POST['turno'] == $info['id_turno'] || $_GET['turno'] == $info['id_turno']) {

											echo "<option value=".$info['id_turno']." selected>".$info['turno']."</option>";
											$turno = "turno.id_turno = ".$info['id_turno'];
											continue;

										}

									}

									echo "<option value=".$info['id_turno'].">".$info['turno']."</option>";
									
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-3 col-sm-3">
						<select name="curso" class="form-control">
							<option value="todos"> Todos os Cursos </option>
							<?php
								$curso = "";
								$sql = mysqli_query($con, 'select * from curso;');
								while($info = mysqli_fetch_array($sql)){ 

									if(isset($_POST['curso']) && $_POST['curso'] != "" || isset($_GET['curso']) && $_GET['curso'] != ""){

										if ($_POST['curso'] == $info['id_curso'] || $_GET['curso'] == $info['id_curso']) {

											echo "<option value=".$info['id_curso']." selected>".$info['nome_curso']."</option>";
											$curso = "curso.id_curso = ".$info['id_curso'];
											continue;

										}

									}
									
									echo "<option value=".$info['id_curso'].">".$info['nome_curso']."</option>";
									
								}
							?>
							
							
						</select>
					</div>
					<div class="form-group col-md-3 col-sm-3">
						<select name="ano" class="form-control">
							<option value="todos"> Todos os Anos/módulos </option>
							<?php
								$ano = "";
								$sql = mysqli_query($con, 'select distinct ano_modulo from turma;');
								while($info = mysqli_fetch_array($sql)){ 

									if(isset($_POST['ano']) && $_POST['ano'] != "" || isset($_GET['ano']) && $_GET['ano'] != ""){

										if ($_POST['ano'] == $info['ano_modulo'] || $_GET['ano'] == $info['ano_modulo']) {

											echo "<option value=".$info['ano_modulo']." selected>".$info['ano_modulo']."</option>";
											$ano = "ano_modulo = ".$info['ano_modulo'];
											continue;

										}

									}
									
									echo "<option value=".$info['ano_modulo'].">".$info['ano_modulo']."</option>";
									
								}
							?>
							
							
						</select>
					</div>
					
					<div class="col-md-3 col-sm-3">
							<button type="submit" class="btn btn-success">
								<i class="fa-solid fa-magnifying-glass"></i>
							</button>
					</div>
				</div>
			</form>
		</div>

	<div> <?php include "mensagens.php"; ?> </div>

	<hr class="d-none d-md-block">

	<div id="list" class="row">
		<div class="table-responsive">
			<?php
				$quantidade = 10;

				$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
				$inicio = ($quantidade * $pagina) - $quantidade;


				$sql = "SELECT turma.n_turma, turma.id_curso, turma.ano_modulo,
				curso.nome_curso, modalidade.nome_modal, turno.turno ";
				$sql .= "FROM turma ";
				$sql .= "INNER JOIN curso ON turma.id_curso = curso.id_curso ";
				$sql .= "INNER JOIN modalidade ON turma.id_modal = modalidade.id_modal ";
				$sql .= "INNER JOIN turno ON turma.id_turno = turno.id_turno ";
				$sql .= "order by n_turma limit $inicio, $quantidade;";

				$s = "";
				if ($turno != '') {
					$s = $turno;

					if($curso != ''){
						$s .= ' and '.$curso;
					}
					if($ano != ''){
						$s .= ' and '.$ano;
					}
				}else if($curso != ''){
					$s = $curso;
					if($ano != ''){
						$s .= ' and '.$ano;
					}
				}else if($ano != ''){
					$s = $ano;
				}
				

				if($s!=""){
					$sql = "SELECT turma.n_turma, turma.id_curso, turma.ano_modulo,
				curso.nome_curso, modalidade.nome_modal, turno.turno ";
				$sql .= "FROM turma ";
				$sql .= "INNER JOIN curso ON turma.id_curso = curso.id_curso ";
				$sql .= "INNER JOIN modalidade ON turma.id_modal = modalidade.id_modal ";
				$sql .= "INNER JOIN turno ON turma.id_turno = turno.id_turno ";
				$sql .= "WHERE $s ";
				$sql .= "order by n_turma limit $inicio, $quantidade;";
				}

				$data = mysqli_query($con, $sql) or die(mysqli_error("ERRO: ".$con));

				
				echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
				echo "<thead><tr>";
				echo "<td><strong>Número da turma</strong></td>"; 
				echo "<td><strong>Turno</strong></td>"; 
				echo "<td><strong>Curso</strong></td>"; 
				echo "<td><strong>Modalidade</strong></td>"; 
				echo "<td><strong>Ano/Módulo</strong></td>"; 
				echo "<td><strong class='actions d-flex justify-content-center'>Ações</strong></td>"; 
				echo "</tr></thead><tbody>";
				while($info = mysqli_fetch_array($data)){ 
					echo "<tr>";
					echo "<td>".$info['n_turma']."</td>";
					echo "<td>".$info['turno']."</td>";
					echo "<td>".$info['nome_curso']."</td>";
					echo "<td>".$info['nome_modal']."</td>";
					echo "<td>".$info['ano_modulo']."</td>";
					echo "<td class='actions btn-group-sm text-center'>";
					
					echo "<a class='btn btn-info btn-xs' data-toggle='tooltip' title='Detalhar' href=?page=lista_alu&n_turma=".$info['n_turma']."> <i class='fa-solid fa-circle-plus'></i> </a>";

					echo "<a class='btn btn-warning btn-xs' data-toggle='tooltip' title='Editar'  href=?turno=".$_GET['turno']."&curso=".$_GET['curso']."&ano=".$_GET['ano']."&page=lista_turm&modal=editar&n_turma=".$info['n_turma']."'>  <i class='fa-solid fa-pen-to-square'></i> </a>"; 

					echo "<a class='btn btn-danger btn-xs' data-toggle='tooltip' title='Excluir' href=?page=lista_turm&n_turma=".$info['n_turma']."&modal=excluir>  <i class='fa-solid fa-trash'></i> </a></td>";
				}

				include 'crud/turma/modals_turm.php';

				echo "</tr></tbody></table>";
			?>
			
			<?php
					$sqlTotal 		= "select n_turma from turma;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;


						echo "<ul class='pagination justify-content-center'>";
						echo "<li class='page-item'><a class='page-link' href='?turno=".$_GET['turno']."&curso=".$_GET['curso']."&ano=".$_GET['ano']."&nv=$nv&page=lista_turm&pagina=1'> Primeira</a></li> "; 
						echo "<li class='page-item'><a class='page-link' href=\"?turno=".$_GET['turno']."&curso=".$_GET['curso']."&ano=".$_GET['ano']."&nv=$nv&page=lista_turm&pagina=$anterior\"> Anterior</a></li> ";

						echo "<li class='page-item'><a class='page-link' href='?turno=".$_GET['turno']."&curso=".$_GET['curso']."&ano=".$_GET['ano']."&nv=$nv&page=lista_turm&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

						for($i = $pagina+1; $i < $pagina+$exibir; $i++){
							if($i <= $totalpagina)
							echo "<li class='page-item'><a class='page-link' href='?turno=".$_GET['turno']."&curso=".$_GET['curso']."&ano=".$_GET['ano']."&nv=$nv&page=lista_turm&pagina=".$i."'> ".$i." </a></li> ";
						}
			

					

					echo "<li class='page-item'><a class='page-link' href=\"?turno=".$_GET['turno']."&curso=".$_GET['curso']."&ano=".$_GET['ano']."&nv=$nv&page=lista_turm&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?turno=".$_GET['turno']."&curso=".$_GET['curso']."&ano=".$_GET['ano']."&nv=$nv&page=lista_turm&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
		</div>
	</div>
</div>



