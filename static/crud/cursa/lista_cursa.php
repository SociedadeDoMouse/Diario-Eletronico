<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";
	include "base/functions/formdata.php";

	if(!isset($_GET['n_turma'])||!isset($_GET['ano'])||!isset($_GET['dependencia'])){
		$_GET['n_turma'] = "todos";
		$_GET['ano'] = "todos";
		$_GET['dependencia'] = "todos";
	}
  ?>
<div id="main" class="col-md-12">
	<div id="top" class="row">
		<div class="col-md-9">
			<h1 class="h3 mb-3">Painel de <strong>Disciplinas de Turmas</strong></h1>
		</div>

		<div class="col-md-3">
			<!-- Chama o Formulário para adicionar usuários -->
			<a href="?page=fadd_cursa" class="btn btn-primary pull-right h2">Nova Disciplina</a> 
		</div>

	</div>
	<div class="row">
			<form action="dashboard.php" method="get">
				<input type="hidden" name="page" value='lista_cursa'>
				<div class="row">
					<div class="form-group col-md-3 col-sm-3">
						<select name="n_turma" class="form-control">
							<option value="todos"> Todas as turmas </option>
							<?php
								$turma = "";
								$sql = mysqli_query($con, 'select * from turma;');
								while($info = mysqli_fetch_array($sql)){ 
									if(isset($_POST['turma']) && $_POST['turma'] != "" || isset($_GET['n_turma']) && $_GET['n_turma'] != ""){
										if ($_POST['turma'] == $info['n_turma'] || $_GET['n_turma'] == $info['n_turma']) {
											echo "<option value=".$info['n_turma']." selected>".$info['n_turma']."</option>";
											$turma = "n_turma = ".$info['n_turma'];
											continue;
										}
									}
									echo "<option value=".$info['n_turma'].">".$info['n_turma']."</option>";
									
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-3 col-sm-3">
						<select name="ano" class="form-control">
							<option value="todos"> Todos os anos Letivos </option>
							<?php
								$ano = "";
								$sql = mysqli_query($con, 'select * from ano_letivo;');
								while($info = mysqli_fetch_array($sql)){ 
									if(isset($_POST['ano']) && $_POST['ano'] != "" || isset($_GET['ano']) && $_GET['ano'] != ""){
										if ($_POST['ano'] == $info['id_ano'] || $_GET['ano'] == $info['id_ano']) {
											echo "<option value=".$info['id_ano']." selected>".$info['nome_ano']."</option>";
											$ano = "ano_letivo.id_ano = ".$info['id_ano'];
											continue;
										}
									}
									echo "<option value=".$info['id_ano'].">".$info['nome_ano']."</option>";
								}
							?>
						</select>
					</div>
					<div class="form-group col-md-3 col-sm-3">
						<select name="dependencia" class="form-control">
							<option value="todos"> Dependência </option>
							<?php

									if ($_GET['dependencia'] == "sim"){
										echo '
											<option value="sim" selected> Em Dependência </option>
											<option value="nao"> Sem Dependência </option>
										';
										$dep = "dep = 1";
									}else if($_GET['dependencia'] == "nao"){
										echo '
											<option value="sim"> Em Dependência </option>
											<option value="nao" selected> Sem Dependência </option>
										';
										$dep = "dep = 0";
									}else{
										echo '
											<option value="sim"> Em Dependência </option>
											<option value="nao"> Sem Dependência </option>
										';
										$dep = "";
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


				$sql = "SELECT cursa.id_cursa, nome_disc, n_turma, nome_ano, cursa.dep FROM cursa INNER JOIN disciplina ON cursa.id_disc = disciplina.id_disc INNER JOIN ano_letivo ON cursa.id_ano = ano_letivo.id_ano limit $inicio, $quantidade;";

				$s = "";
				if ($dep != '') {
					$s = $dep;

					if($ano != ''){
						$s .= ' and '.$ano;
					}
					if($turma != ''){
						$s .= ' and '.$turma;
					}
				}else if($ano != ''){
					$s = $ano;
					if($turma != ''){
						$s .= ' and '.$turma;
					}
				}else if($turma != ''){
					$s = $turma;
				}
				

				if($s!=""){
					$sql = "SELECT cursa.id_cursa, nome_disc, n_turma, nome_ano, cursa.dep FROM cursa INNER JOIN disciplina ON cursa.id_disc = disciplina.id_disc INNER JOIN ano_letivo ON cursa.id_ano = ano_letivo.id_ano where $s limit $inicio, $quantidade;";
				}

				$data = mysqli_query($con, $sql) or die(mysqli_error("ERRO: ".$con));

				
				echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
				echo "<thead><tr>";
				echo "<td><strong>Disciplina</strong></td>"; 
				echo "<td><strong>Turma</strong></td>"; 
				echo "<td><strong>Ano Letivo</strong></td>"; 
				echo "<td><strong>Dependência</strong></td>"; 
				echo "<td><strong class='actions d-flex justify-content-center'>Ações</strong></td>"; 
				echo "</tr></thead><tbody>";
				while($info = mysqli_fetch_array($data)){ 
					echo "<tr>";
					echo "<td>".$info['nome_disc']."</td>";
					echo "<td>".$info['n_turma']."</td>";
					echo "<td>".$info['nome_ano']."</td>";
					if($info['dep'] != true){
						$dep = 'Não';
					}else{
						$dep = "Sim";
					}
					echo "<td>".$dep."</td>";
					echo "<td class='actions btn-group-sm text-center'>";
					
					// echo "<a class='btn btn-info btn-xs' data-toggle='tooltip' title='Detalhar' href='?page=lista_cursa&id_cursa=".$info['id_cursa']."&modal=detalhar'> <i class='fa-solid fa-circle-plus'></i> </a>";

					// echo "<a class='btn btn-warning btn-xs' data-toggle='tooltip' title='Editar'  href='?page=lista_cursa&id_cursa=".$info['id_cursa']."&modal=editar'>  <i class='fa-solid fa-pen-to-square'></i> </a>"; 

					echo "<a class='btn btn-danger btn-xs' data-toggle='tooltip' title='Excluir' href='?n_turma=".$_GET['n_turma']."&ano=".$_GET['ano']."&dependencia=".$_GET['dependencia']."&page=lista_cursa&id_cursa=".$info['id_cursa']."&modal=excluir'>  <i class='fa-solid fa-trash'></i> </a></td>";
				}

				include 'crud/cursa/modals_cursa.php';

				echo "</tr></tbody></table>";
			?>
			


			<?php
				$sqlTotal 		= "select n_turma from cursa;";
				$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
				$numTotal 		= mysqli_num_rows($qrTotal);
				$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

				$exibir = 3;

				$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
				$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;


					echo "<ul class='pagination justify-content-center'>";
					echo "<li class='page-item page-item-adjust'><a class='page-link' href='?n_turma=".$_GET['n_turma']."&ano=".$_GET['ano']."&dependencia=".$_GET['dependencia']."&nv=$nv&page=lista_cursa&pagina=1'> Primeira</a></li> "; 
					echo "<li class='page-item page-item-center'><a class='page-link' href=\"?n_turma=".$_GET['n_turma']."&ano=".$_GET['ano']."&dependencia=".$_GET['dependencia']."&nv=$nv&page=lista_cursa&pagina=$anterior\"> Anterior</a></li> ";

					echo "<li class='page-item page-item-adjust'><a class='page-link' href='?n_turma=".$_GET['n_turma']."&ano=".$_GET['ano']."&dependencia=".$_GET['dependencia']."&nv=$nv&page=lista_cursa&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

					for($i = $pagina+1; $i < $pagina+$exibir; $i++){
						if($i <= $totalpagina)
						echo "<li class='page-item page-item-adjust'><a class='page-link' href='?n_turma=".$_GET['n_turma']."&ano=".$_GET['ano']."&dependencia=".$_GET['dependencia']."&nv=$nv&page=lista_cursa&pagina=".$i."'> ".$i." </a></li> ";
					}
		
					echo "<li class='page-item page-item-adjust'><a class='page-link' href=\"?n_turma=".$_GET['n_turma']."&ano=".$_GET['ano']."&dependencia=".$_GET['dependencia']."&nv=$nv&page=lista_cursa&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item page-item-adjust'><a class='page-link' href=\"?n_turma=".$_GET['n_turma']."&ano=".$_GET['ano']."&dependencia=".$_GET['dependencia']."&nv=$nv&page=lista_cursa&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

			?>	

		</div>
	</div>
</div>



