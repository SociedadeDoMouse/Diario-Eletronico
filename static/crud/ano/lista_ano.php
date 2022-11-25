<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";
	include "base/functions/formdata.php";
  ?>
<div id="main" class="col-md-12">
	<div id="top" class="row">
		<div class="col-md-9">
		<h1 class="h3 mb-3">Painel de <strong>Ano Letivo</strong></h1>
		</div>

		<div class="col-md-3">
			<!-- Chama o Formulário para adicionar usuários -->
			<a href="?page=fadd_ano" class="btn btn-primary pull-right h2">Novo Ano Letivo</a> 
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


				$sql = "SELECT * FROM ano_letivo limit $inicio, $quantidade;";

				$data = mysqli_query($con, $sql) or die(mysqli_error("ERRO: ".$con));

				
				echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
				echo "<thead><tr>";
				echo "<td><strong>Ano Letivo</strong></td>"; 
				echo "<td><strong>Data de Inicio</strong></td>"; 
				echo "<td><strong>Data de Fim</strong></td>"; 
				echo "<td><strong>OBS</strong></td>"; 
				echo "<td><strong class='actions d-flex justify-content-center'>Ações</strong></td>"; 
				echo "</tr></thead><tbody>";
				while($info = mysqli_fetch_array($data)){ 
					echo "<tr>";
					echo "<td>".$info['nome_ano']."</td>";
					echo "<td>".formdata($info['data_inicio'])."</td>";
					echo "<td>".formdata($info['data_fim'])."</td>";
					echo "<td>".$info['observacao']."</td>";
					echo "<td class='actions btn-group-sm text-center'>";
					
					echo "<a class='btn btn-info btn-xs' data-toggle='tooltip' title='Detalhar' href='?page=lista_ano&id_ano=".$info['id_ano']."&modal=detalhar'> <i class='fa-solid fa-circle-plus'></i> </a>";

					echo "<a class='btn btn-warning btn-xs' data-toggle='tooltip' title='Editar'  href='?page=lista_ano&id_ano=".$info['id_ano']."&modal=editar'>  <i class='fa-solid fa-pen-to-square'></i> </a>"; 

					echo "<a class='btn btn-danger btn-xs' data-toggle='tooltip' title='Excluir' href='?page=lista_ano&id_ano=".$info['id_ano']."&modal=excluir'>  <i class='fa-solid fa-trash'></i> </a></td>";
				}

				include 'crud/ano/modals_ano.php';

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
						echo "<li class='page-item'><a class='page-link' href='?nv=$nv&page=lista_ano&pagina=1'> Primeira</a></li> "; 
						echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_ano&pagina=$anterior\"> Anterior</a></li> ";

						echo "<li class='page-item'><a class='page-link' href='?nv=$nv&page=lista_ano&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

						for($i = $pagina+1; $i < $pagina+$exibir; $i++){
							if($i <= $totalpagina)
							echo "<li class='page-item'><a class='page-link' href='?nv=$nv&page=lista_ano&pagina=".$i."'> ".$i." </a></li> ";
						}
			

					

					echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_ano&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_ano&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
		</div>
	</div>
</div>



