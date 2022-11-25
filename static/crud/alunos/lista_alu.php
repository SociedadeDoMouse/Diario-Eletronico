<?php
      $nivel_necessario = array(
		1 => 'Administrador',
		2 => 'Diretor',
		3 => 'Coodernador',
		4 => 'Secretario',
		6 => 'Supervisor'
	);
      include "base/testa_nivel.php";
	  if(!isset($_GET['n_turma'])){
		$_GET['n_turma'] = "";
	  }
  ?>

<h1 class="h3 mb-3">Painel de <strong>Alunos</strong></h1>

<div class="row">
	<div class="col-md-7 mt-3">
		<form action="dashboard.php" method="get">
			<input type="hidden" name="page" value='lista_alu'>
			<div class="row">
				<div class="form-group col-md-6 col-sm-6">
					<select name="n_turma" class="form-control">
						<option value=""> Alunos Enturmados </option>
						<?php
							$sql = mysqli_query($con, 'select * from turma;');
							while($info = mysqli_fetch_array($sql)){ 
								if(isset($_POST['turma']) && $_POST['turma'] != "" || isset($_GET['n_turma']) && $_GET['n_turma'] != ""){
									if ($_POST['turma'] == $info['n_turma'] || $_GET['n_turma'] == $info['n_turma']) {
										echo "<option value=".$info['n_turma']." selected>".$info['n_turma']."</option>";
										continue;
									}
								}
								echo "<option value=".$info['n_turma'].">".$info['n_turma']."</option>";
							}
						?>
					</select>
				</div>
				
				<div class="col-md-6 col-sm-6">
						<button type="submit" class="btn btn-success">
							<i class="fa-solid fa-magnifying-glass"></i>
						</button>
				</div>
			</div>
		</form>
	</div>
	
	<div class="col-md-5 col-sm-6 mt-3" style="text-align:right;">
		<div class="btn-group" role="group">
			<button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Adicionar Alunos
			</button>
			<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
				<!-- Chama o Formulário de excel para adicionar alunos -->
				<a href="?page=import_alu" class="dropdown-item">Importar Por Excel</a> 
				<!-- Chama o Formulário para adicionar alunos -->
				<a href="?page=fadd_alu" class="dropdown-item">Formulário</a> 
			</div>
		</div>
	</div>

</div>

<br>

<?php include "mensagens.php"; ?>

<hr class="d-none d-md-block">

<div id="list" class="row">
	<div class="table-responsive">
	<?php

			$quantidade = 10;

			$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
			$inicio = ($quantidade * $pagina) - $quantidade;
			 
			if(isset($_GET['n_turma']) && $_GET['n_turma'] != ""){
				$data = mysqli_query($con, "select * from aluno INNER JOIN enturmado ON enturmado.mat_aluno = aluno.mat_aluno where n_turma = ".$_GET['n_turma']." order by aluno.mat_aluno limit $inicio, $quantidade;") or die(mysqli_error("ERRO: ".$con));
			}else if(!isset($_POST["turma"]) || $_POST["turma"]=="todos"){
				$data = mysqli_query($con, "select * from aluno order by mat_aluno limit $inicio, $quantidade;") or die(mysqli_error("ERRO: ".$con));
			}else{
				$data = mysqli_query($con, "select * from aluno INNER JOIN enturmado ON enturmado.mat_aluno = aluno.mat_aluno where n_turma = ".$_POST["turma"]." order by aluno.mat_aluno limit $inicio, $quantidade;") or die(mysqli_error("ERRO: ".$con));
			}
			echo "<table class='table table-striped' id='table' cellspacing='0' cellpading='0'>";
			echo "<thead><tr>";
			echo "<td><strong>Matrícula</strong></td>"; 
			echo "<td><strong>Nome</strong></td>"; 
			echo "<td><strong class='actions d-flex justify-content-center'>Ações</strong></td>"; 
			echo "</tr></thead><tbody>";
			while($info = mysqli_fetch_array($data)){ 
				echo "<tr>";
				echo "<td>".$info['mat_aluno']."</td>";
				echo "<td>".$info['nome_aluno']."</td>";

				echo "<td class='actions btn-group-sm d-flex justify-content-center'>";
				
				echo "<a class='btn btn-info btn-xs' data-toggle='tooltip' title='Detalhar' href='?n_turma=".$_GET['n_turma']."&page=lista_alu&mat_aluno=".$info['mat_aluno']."&modal=detalhar'>  <i class='fa-solid fa-circle-plus'></i> </a>";

				echo "<a class='btn btn-warning btn-xs' data-toggle='tooltip' title='Editar' href='?n_turma=".$_GET['n_turma']."&page=lista_alu&mat_aluno=".$info['mat_aluno']."&modal=editar'> <i class='fa-solid fa-pen-to-square'></i> </a>"; 

				echo "<a href='?n_turma=".$_GET['n_turma']."&page=lista_alu&mat_aluno=".$info['mat_aluno']."&modal=excluir' class='btn btn-danger btn-xs' data-toggle='tooltip' title='Excluir'> <i class='fa-solid fa-trash'></i>   </a></td>";

			}

			include "crud/alunos/modals_alu.php";

			echo "</tr></tbody></table>";
		?>
		
	</div>
		<?php
				$sqlTotal 		= "select mat_aluno from aluno;";
				$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
				$numTotal 		= mysqli_num_rows($qrTotal);
				$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);
-
				$exibir = 3;

				$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
				$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;


					echo "<ul class='pagination justify-content-center'>";
					echo "<li class='page-item page-item-adjust'><a class='page-link' href='?n_turma=".$_GET['n_turma']."&nv=$nv&page=lista_alu&n_turma=".$_GET["n_turma"]."&pagina=1'> Primeira</a></li> "; 
					echo "<li class='page-item page-item-center'><a class='page-link' href=\"?n_turma=".$_GET['n_turma']."&nv=$nv&page=lista_alu&n_turma=".$_GET["n_turma"]."&pagina=$anterior\"> Anterior</a></li> ";

					echo "<li class='page-item page-item-adjust'><a class='page-link' href='?n_turma=".$_GET['n_turma']."&nv=$nv&page=lista_alu&n_turma=".$_GET["n_turma"]."&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

					for($i = $pagina+1; $i < $pagina+$exibir; $i++){
						if($i <= $totalpagina)
						echo "<li class='page-item page-item-adjust'><a class='page-link' href='?n_turma=".$_GET['n_turma']."&nv=$nv&page=lista_alu&n_turma=".$_GET["n_turma"]."&pagina=".$i."'> ".$i." </a></li> ";
					}
		
				echo "<li class='page-item page-item-adjust'><a class='page-link' href=\"?n_turma=".$_GET['n_turma']."&nv=$nv&page=lista_alu&n_turma=".$_GET["n_turma"]."&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
				echo "<li class='page-item page-item-adjust'><a class='page-link' href=\"?n_turma=".$_GET['n_turma']."&nv=$nv&page=lista_alu&n_turma=".$_GET["n_turma"]."&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

			?>	
</div>