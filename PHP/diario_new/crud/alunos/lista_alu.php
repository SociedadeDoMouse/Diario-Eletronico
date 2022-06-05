<?php     
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
    include "base/testa_nivel.php"; 
?>
<div id="main" class="col-md-11 volum_content">
	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Alunos</h2>
		</div>

		<div class="col-md-1">
			<!-- Chama o Formulário para adicionar alunos -->
			<a href="?nv=<?php echo $nv;?>&page=fadd_alu" class="btn btn-primary pull-right h2">Novo Aluno</a> 
		</div>
	</div>
	<hr/>

	<div> <?php include "mensagens.php"; ?> </div>

	<div id="list" class="row">
		<div class="table-responsive">
			<?php
				$quantidade = 5;

				$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
				$inicio = ($quantidade * $pagina) - $quantidade;

				$data = mysqli_query($con, "select * from aluno order by mat_aluno asc limit $inicio, $quantidade;") or die(mysqli_error("ERRO: ".$con));
				echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
				echo "<thead><tr>";
				echo "<td><strong>Matrícula</strong></td>"; 
				echo "<td><strong>Nome</strong></td>"; 
				echo "<td class='actions d-flex justify-content-center'><strong>Ações</strong></td>"; 
				echo "</tr></thead><tbody>";
				while($info = mysqli_fetch_array($data)){ 
					echo "<tr>";
					echo "<td>".$info['mat_aluno']."</td>";
					echo "<td>".$info['nome_aluno']."</td>";
					echo "<td class='actions btn-group-sm d-flex justify-content-center'>";
					echo "<a class='btn btn-success btn-xs' href=?nv=$nv&page=view_alu&mat_aluno=".$info['mat_aluno']."> Visualizar </a>";
					echo "<a class='btn btn-warning btn-xs' href=?nv=$nv&page=fedita_alu&mat_aluno=".$info['mat_aluno']."> Editar </a>"; 
					echo "<a href=?nv=$nv&page=excluir_alu&mat_aluno=".$info['mat_aluno']." class='btn btn-danger btn-xs'> Excluir </a></td>";
				}
				echo "</tr></tbody></table>";
			?>
			
			<?php
					$sqlTotal 		= "select mat_aluno from aluno;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;


						echo "<ul class='pagination'>";
						echo "<li class='page-item'><a class='page-link' href='?nv=$nv&page=lista_alu&pagina=1'> Primeira</a></li> "; 
						echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_alu&pagina=$anterior\"> Anterior</a></li> ";

						echo "<li class='page-item'><a class='page-link' href='?nv=$nv&page=lista_alu&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

						for($i = $pagina+1; $i < $pagina+$exibir; $i++){
							if($i <= $totalpagina)
							echo "<li class='page-item'><a class='page-link' href='?nv=$nv&pzage=lista_alu&pagina=".$i."'> ".$i." </a></li> ";
						}
			

					

					echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_alu&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_alu&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
		</div>
	</div>
</div>
