<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";

	if(!isset($_GET['curso'])){
		$_GET['curso'] = "todos";
	}
  ?>
<div id="main" class="col-md-12">
	<form action="dashboard.php" method="GET" class="row">
		<div id="top" class="row">
			<div class="col-md-3">
				<h1 class="h3 mb-3">Painel de <strong>Disciplina</strong></h1>
			</div>

			

				<div class="col-md-5">
					<?php
						echo '
						<input type="hidden" name="page" value="lista_disc">
						<select name="curso" class="form-control">
							<option selected value="todos">Todos os Curso</option>
								';
								$sql = mysqli_query($con, 'select id_curso, nome_curso from curso');
								
								while($info = mysqli_fetch_array($sql)){ 
									if(isset($_POST['curso']) || isset($_GET['curso'])){
										if ($_POST['curso'] == $info['id_curso'] || $_GET['curso'] == $info['id_curso']) {
											echo "<option value=".$info['id_curso']." selected>".$info['nome_curso']."</option>";
											continue;
										}
									}
									echo "<option value=".$info['id_curso'].">".$info['nome_curso']."</option>";
								}
								
						echo "</select>";
					?>
				</div>
				<div class='col-md-1'>
					<button type='submit' class='btn btn-success'>
						<i class='fa-solid fa-magnifying-glass'></i>
					</button>
				</div>

			
			<div class="col-md-3">
				<!-- Chama o Formulário para adicionar usuários -->
				<a href="?page=fadd_disc" class="btn btn-primary pull-right h2">Nova Disciplina</a> 
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


				$sql = "SELECT id_disc, nome_disc, nome_curso  from disciplina INNER JOIN curso ON curso.id_curso = disciplina.id_curso limit $inicio, $quantidade;";

				if(isset($_GET['curso']) && $_GET['curso'] != 'todos'){
					$sql = "SELECT id_disc, nome_disc, nome_curso  from disciplina INNER JOIN curso ON curso.id_curso = disciplina.id_curso where disciplina.id_curso = ".$_GET['curso']." limit $inicio, $quantidade;";
				}

				$data = mysqli_query($con, $sql) or die(mysqli_error("ERRO: ".$con));

				
				echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
				echo "<thead><tr>";
				echo "<td><strong>Disciplina</strong></td>"; 
				echo "<td><strong>Curso</strong></td>"; 
				echo "<td><strong class='actions d-fl	ex justify-content-center'>Ações</strong></td>"; 
				echo "</tr></thead><tbody>";
				while($info = mysqli_fetch_array($data)){ 
					echo "<tr>";
					echo "<td>".$info['nome_disc']."</td>";
					echo "<td>".$info['nome_curso']."</td>";
					echo "<td class='actions btn-group-sm text-center'>";

					echo "<a class='btn btn-warning btn-xs' data-toggle='tooltip' title='Editar'  href='?curso=".$_GET['curso']."&page=lista_disc&id_disc=".$info['id_disc']."&modal=editar'>  <i class='fa-solid fa-pen-to-square'></i> </a>"; 

					echo "<a class='btn btn-danger btn-xs' data-toggle='tooltip' title='Excluir' href='?curso=".$_GET['curso']."&page=lista_disc&id_disc=".$info['id_disc']."&modal=excluir'>  <i class='fa-solid fa-trash'></i> </a></td>";
				}

				include 'crud/disciplina/modals_disc.php';

				echo "</tr></tbody></table>";
			?>
			
			<?php
					$sqlTotal 		= "select id_curso from disciplina;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;


						echo "<ul class='pagination justify-content-center'>";
						echo "<li class='page-item'><a class='page-link' href='?curso=".$_GET['curso']."&nv=$nv&page=lista_disc&pagina=1'> Primeira</a></li> "; 
						echo "<li class='page-item'><a class='page-link' href=\"?curso=".$_GET['curso']."&nv=$nv&page=lista_disc&pagina=$anterior\"> Anterior</a></li> ";

						echo "<li class='page-item'><a class='page-link' href='?curso=".$_GET['curso']."&nv=$nv&page=lista_disc&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

						for($i = $pagina+1; $i < $pagina+$exibir; $i++){
							if($i <= $totalpagina)
							echo "<li class='page-item'><a class='page-link' href='?curso=".$_GET['curso']."&nv=$nv&pzage=lista_disc&pagina=".$i."'> ".$i." </a></li> ";
						}
			

					

					echo "<li class='page-item'><a class='page-link' href=\"?curso=".$_GET['curso']."&nv=$nv&page=lista_disc&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?curso=".$_GET['curso']."&nv=$nv&page=lista_disc&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

					?>
		</div>
	</div>
</div>



