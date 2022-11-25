<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
	4 => 'Secretario',
	6 => 'Supervisor'
);
	include "base/testa_nivel.php";
  ?>

	
	<div id="top" class="row">
		<div class="col-md-10">
			<h1 class="h3 mb-3">Painel de <strong> Cursos </strong></h1>
		</div>

		<div class="col-md-2">
			<!-- Chama o Formulário para adicionar curso -->
			<a href="?nv=<?php echo $nv;?>&page=fadd_curso" class="btn btn-primary pull-right h2">Novo Curso</a> 
		</div>
	</div>


	 <?php include "mensagens.php"; ?> 

	 <hr class="d-none d-md-block">

	<div id="list" class="row">
		<div class="table-responsive">
			<?php

				$quantidade = 10;

				$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
				$inicio = ($quantidade * $pagina) - $quantidade;

				$data_all = mysqli_query($con, "SELECT curso.id_curso, nome_curso, usuario.nome FROM usuario INNER JOIN coordenador ON usuario.id_usur = coordenador.id_usur , curso INNER JOIN coordena ON coordena.id_curso  = curso.id_curso WHERE coordena.id_cord = coordenador.id_cord limit $inicio, $quantidade ;") or die(mysqli_error());

				echo "<table class='table table-striped' id='table' cellspacing='0' cellpading='0'>";
				echo "<thead><tr>";
				echo "<td><strong>Nome</strong></td>"; 
				echo "<td><strong>Coordenador(a)</strong></td>"; 
				echo "<td><strong class='actions d-flex justify-content-center'>Ações</strong></td>"; 
				echo "</tr></thead><tbody>";

                while($info = mysqli_fetch_array($data_all)){ 
                    echo "<tr>";
                    echo "<td>".$info['nome_curso']."</td>";
					echo "<td>".$info['nome']."</td>";
                    echo "<td><div class='actions btn-group-sm text-center'>";

                    echo "<a class='btn btn-info btn-xs' data-toggle='tooltip' title='Detalhar' href='?page=lista_curso&id_curso=".$info['id_curso']."&modal=detalhar'>  <i class='fa-solid fa-circle-plus'></i>  </a>";

                    echo "<a class='btn btn-warning  btn-xs'  data-toggle='tooltip' title='Editar'  href='?page=lista_curso&id_curso=".$info['id_curso']."&modal=editar'> <i class='fa-solid fa-pen-to-square'></i> </a>";

					echo "<a class='btn btn-danger btn-xs' data-toggle='tooltip' title='Excluir'  href='?page=lista_curso&id_curso=".$info['id_curso']."&modal=excluir'>  <i class='fa-solid fa-trash'></i> </a></td>";
                }

				include "crud/curso/modals_curso.php";

				echo "</tr></tbody></table>";
			?>
			
			</div>
			<?php
					$sqlTotal 		= "select id_curso from curso;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;


						echo "<ul class='pagination justify-content-center'>";
						echo "<li class='page-item'><a class='page-link' href='?nv=$nv&page=lista_curso&pagina=1'> Primeira </a></li> "; 
						echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_curso&pagina=$anterior\"> Anterior</a></li> ";

						echo "<li class='page-item'><a class='page-link' href='?nv=$nv&page=lista_curso&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

						for($i = $pagina+1; $i < $pagina+$exibir; $i++){
							if($i <= $totalpagina)
							echo "<li class='page-item'><a class='page-link' href='?nv=$nv&page=lista_curso&pagina=".$i."'> ".$i." </a></li> ";
						}
			

					

					echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_curso&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_curso&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
	</div>