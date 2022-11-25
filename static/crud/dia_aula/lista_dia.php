<?php
include 'base/functions/formdata.php';
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
	4 => 'Secretário',
	5 => 'Professor'
);
	include "base/testa_nivel.php";
  ?>
<div id="main" class="col-md-12">
	<div id="top" class="row">
		<div class="col-md-9">
		<h1 class="h3 mb-3">Painel de <strong>Dias de Aula</strong></h1>
		</div>

		<div class="col-md-3">
			<!-- Chama o Formulário para adicionar Dias -->
			<a href="?page=fadd_dia" class="btn btn-primary pull-right h2">Novo Dia de Aula</a> 
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


				if($_SESSION['UsuarioNivel'] != 5){
				$sql = "SELECT distinct ministra.id_ministra, n_turma, nome_disc, nome_ano FROM data_aula inner join ministra on data_aula.id_ministra = ministra.id_ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano limit $inicio, $quantidade;";}
				else{
					$sql = "SELECT distinct ministra.id_ministra, n_turma, nome_disc, nome_ano FROM data_aula inner join ministra on data_aula.id_ministra = ministra.id_ministra inner join professor on professor.mat_prof = ministra.mat_prof inner join usuario on professor.id_usur = usuario.id_usur inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on ano_letivo.id_ano = cursa.id_ano where professor.id_usur = ".$_SESSION['UsuarioID']." limit $inicio, $quantidade;";
				}

				$data = mysqli_query($con, $sql) or die(mysqli_error("ERRO: ".$con));

				
				echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
				echo "<thead><tr>";
				echo "<td><strong>Ministra</strong></td>"; 

				echo "<td><strong class='actions d-flex justify-content-center'>Ações</strong></td>"; 
				echo "</tr></thead><tbody>";
				while($info = mysqli_fetch_array($data)){ 
					echo "<tr>";
					echo "<td>".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']."</td>";

					echo "<td class='actions btn-group-sm text-center'>";

					echo "<a class='btn btn-info btn-xs' data-toggle='tooltip' title='Detalhar' href='?page=lista_dia&id=".$info['id_ministra']."&modal=detalhar'>  <i class='fa-solid fa-circle-plus'></i> </a></td>";
				}

				

				echo "</tr></tbody></table>";
				include 'crud/dia_aula/modals_dia.php';
			?>
			
			<?php
					$sqlTotal 		= "select distinct id_ministra from data_aula;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;


						echo "<ul class='pagination justify-content-center'>";
						echo "<li class='page-item'><a class='page-link' href='?page=lista_dia&pagina=1'> Primeira</a></li> "; 
						echo "<li class='page-item'><a class='page-link' href=\"?page=lista_dia&pagina=$anterior\"> Anterior</a></li> ";

						echo "<li class='page-item'><a class='page-link' href='?page=lista_dia&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

						for($i = $pagina+1; $i < $pagina+$exibir; $i++){
							if($i <= $totalpagina)
							echo "<li class='page-item'><a class='page-link' href='?page=lista_dia&pagina=".$i."'> ".$i." </a></li> ";
						}
			

					

					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_dia&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_dia&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
		</div>
	</div>
</div>



