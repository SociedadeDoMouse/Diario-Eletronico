<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";

	if(!isset($_GET['cursa'])||!isset($_GET['trim'])||!isset($_GET['prof'])){
		$_GET['cursa'] = "todos";
		$_GET['trim'] = "todos";
		$_GET['prof'] = "todos";
	}
  ?>
<div id="main" class="col-md-12">
	<div id="top" class="row">
		<div class="col-md-9">
		<h1 class="h3 mb-3">Painel de <strong>Aula</strong></h1>
		</div>

		<div class="col-md-3">
			<!-- Chama o Formulário para adicionar usuários -->
			<a href="?page=fadd_aula" class="btn btn-primary pull-right h2">Nova Aula</a> 
		</div>

	</div>

	<div class="row">
			<form action="dashboard.php" method="get">
				<input type="hidden" name="page" value='lista_aula'>
				<div class="row">
					<div class="form-group col-md-3 col-sm-3">
						<select name="cursa" class="form-control">
							<option value="todos"> Todas as turmas/disciplinas </option>
							<?php
								$cursa = "";
								$sql = mysqli_query($con, 'select * from cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo ON cursa.id_ano = ano_letivo.id_ano;');
								while($info = mysqli_fetch_array($sql)){ 

									if(isset($_POST['cursa']) && $_POST['cursa'] != "" || isset($_GET['cursa']) && $_GET['cursa'] != ""){

										if ($_POST['cursa'] == $info['id_cursa'] || $_GET['cursa'] == $info['id_cursa']) {

											echo "<option value=".$info['id_cursa']." selected>".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']."</option>";
											$cursa = "ministra.id_cursa = ".$info['id_cursa'];
											continue;

										}

									}

									echo "<option value=".$info['id_cursa'].">".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']."</option>";
									
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-3 col-sm-3">
						<select name="trim" class="form-control">
							<option value="todos"> Todos os trimestres </option>
							<?php
							$trim = "";
							if(isset($_GET['trim']) && $_GET['trim'] != "todos"){
								switch ($_GET['trim']) {
									case '1':
										echo'
											<option value="1" selected> 1º trimestre </option>
											<option value="2"> 2º trimestre </option>
											<option value="3"> 3º trimestre </option>
											';

										$trim = 'aula.trimestre = 1';
										break;

									case '2':
										echo'
											<option value="1"> 1º trimestre </option>
											<option value="2" selected> 2º trimestre </option>
											<option value="3"> 3º trimestre </option>
											';
										
										$trim = 'aula.trimestre = 2';
										break;

									case '3':
										echo'
											<option value="1"> 1º trimestre </option>
											<option value="2"> 2º trimestre </option>
											<option value="3" selected> 3º trimestre </option>
											';

										$trim = 'aula.trimestre = 3';
										break;
								}
							}else{
								echo'
									<option value="1"> 1º trimestre </option>
									<option value="2"> 2º trimestre </option>
									<option value="3"> 3º trimestre </option>
									';
							}

							?>
						</select>
					</div>
					<div class="form-group col-md-3 col-sm-3">
						<select name="prof" class="form-control">
							<option value="todos"> Todos os Professores </option>
							<?php
								$prof = "";
								$sql = mysqli_query($con, 'select * from professor INNER JOIN usuario ON professor.id_usur = usuario.id_usur;');
								while($info = mysqli_fetch_array($sql)){ 

									if(isset($_POST['prof']) && $_POST['prof'] != "" || isset($_GET['prof']) && $_GET['prof'] != ""){

										if ($_POST['prof'] == $info['id_usur'] || $_GET['prof'] == $info['id_usur']) {

											echo "<option value=".$info['id_usur']." selected>".$info['nome']."</option>";
											$prof = "professor.id_usur = ".$info['id_usur'];
											continue;

										}

									}
									
									echo "<option value=".$info['id_usur'].">".$info['nome']."</option>";
									
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


				$sql = "SELECT * FROM aula inner join ministra on aula.id_ministra = ministra.id_ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano limit $inicio, $quantidade;";

				
				$s = "";
				if ($cursa != '') {
					$s = $cursa;

					if($trim != ''){
						$s .= ' and '.$trim;
					}
					if($prof != ''){
						$s .= ' and '.$prof;
					}
				}else if($trim != ''){
					$s = $trim;
					if($prof != ''){
						$s .= ' and '.$prof;
					}
				}else if($prof != ''){
					$s = $prof;
				}
				

				if($s!=""){
					$sql = "SELECT * FROM aula inner join ministra on aula.id_ministra = ministra.id_ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano where $s limit $inicio, $quantidade;";
				}

				$data = mysqli_query($con, $sql) or die(mysqli_error("ERRO: ".$con));

				
				echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
				echo "<thead><tr>";
				echo "<td><strong>Professor</strong></td>"; 
				echo "<td><strong>Cursa</strong></td>"; 
				echo "<td><strong>Trimestre</strong></td>"; 
				echo "<td><strong>Aulas Previstas</strong></td>"; 
				echo "<td><strong>Aulas Ministradas</strong></td>"; 
				echo "<td><strong class='actions d-flex justify-content-center'>Ações</strong></td>"; 
				echo "</tr></thead><tbody>";
				while($info = mysqli_fetch_array($data)){ 
					echo "<tr>";
					echo "<td>".$info['nome']."</td>";
					echo "<td>".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']."</td>";
					echo "<td>".$info['trimestre']."</td>";
					echo "<td>".$info['aula_prev']."</td>";
					echo "<td>".$info['aula_min']."</td>";
					echo "<td class='actions btn-group-sm text-center'>";
					
					echo "<a class='btn btn-info btn-xs' data-toggle='tooltip' title='Detalhar' href='?cursa=".$_GET['cursa']."&trim=".$_GET['trim']."&prof=".$_GET['prof']."&page=lista_aula&id_aula=".$info['id_aula']."&modal=detalhar'> <i class='fa-solid fa-circle-plus'></i> </a>";

					echo "<a class='btn btn-warning btn-xs' data-toggle='tooltip' title='Editar'  href='?cursa=".$_GET['cursa']."&trim=".$_GET['trim']."&prof=".$_GET['prof']."&page=lista_aula&id_aula=".$info['id_aula']."&modal=editar'>  <i class='fa-solid fa-pen-to-square'></i> </a>"; 

					echo "<a class='btn btn-danger btn-xs' data-toggle='tooltip' title='Excluir' href='?cursa=".$_GET['cursa']."&trim=".$_GET['trim']."&prof=".$_GET['prof']."&page=lista_aula&id_aula=".$info['id_aula']."&modal=excluir'>  <i class='fa-solid fa-trash'></i> </a></td>";
				}

				include 'crud/aula/modals_aula.php';

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
						echo "<li class='page-item'><a class='page-link' href='?cursa=".$_GET['cursa']."&trim=".$_GET['trim']."&prof=".$_GET['prof']."&nv=$nv&page=lista_aula&pagina=1'> Primeira</a></li> "; 
						echo "<li class='page-item'><a class='page-link' href=\"?cursa=".$_GET['cursa']."&trim=".$_GET['trim']."&prof=".$_GET['prof']."&nv=$nv&page=lista_aula&pagina=$anterior\"> Anterior</a></li> ";

						echo "<li class='page-item'><a class='page-link' href='?cursa=".$_GET['cursa']."&trim=".$_GET['trim']."&prof=".$_GET['prof']."&nv=$nv&page=lista_aula&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

						for($i = $pagina+1; $i < $pagina+$exibir; $i++){
							if($i <= $totalpagina)
							echo "<li class='page-item'><a class='page-link' href='?cursa=".$_GET['cursa']."&trim=".$_GET['trim']."&prof=".$_GET['prof']."&nv=$nv&page=lista_aula&pagina=".$i."'> ".$i." </a></li> ";
						}
			

					

					echo "<li class='page-item'><a class='page-link' href=\"?cursa=".$_GET['cursa']."&trim=".$_GET['trim']."&prof=".$_GET['prof']."&nv=$nv&page=lista_aula&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?cursa=".$_GET['cursa']."&trim=".$_GET['trim']."&prof=".$_GET['prof']."&nv=$nv&page=lista_aula&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
		</div>
	</div>
</div>



