<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
	5 => 'Professor'
);
	include "base/testa_nivel.php";
	include "base/functions/formdata.php";
	$id_aval = $_GET['id_aval'];
  ?>
<div id="main" class="col-md-12">
	<div id="top" class="row">
		<div class="col-md-3">
			<h1 class="h3 mb-3">Painel de <strong>Notas</strong></h1> 
			<h1 class="h3 mb-3">Avaliação 
				<?php
					$sql = "SELECT * FROM avaliado a INNER JOIN matriculado m ON m.id_mat = a.id_mat INNER JOIN aluno al ON al.mat_aluno = m.mat_aluno WHERE id_aval = $id_aval";
					$data = mysqli_query($con, $sql) or die(mysqli_error("ERRO: ".$con));
					$info = mysqli_fetch_array($data);
					
					echo $id_aval."<br>"; 
					if(isset($info['data_avaliado'])) {echo formdata($info['data_avaliado']) ;};
			 	?>
			</h1>
		
		</div>
		<div class="col-md-6">
				<select id="avaliacoes" name="avaliacoes" class="form-control" onchange="mudar(	)">
						<option value="todos" disabled> AVALIAÇÕES </option>
						<?php
							if($_SESSION['NivelUsuario'] == 5){
								$sql = mysqli_query($con, 'select * from avaliacao AS a
								INNER JOIN ministra AS m ON m.id_ministra = a.id_ministra
								INNER JOIN professor AS p ON p.mat_prof = m.mat_prof
								WHERE p.id_usur ='.$_SESSION['UsuarioID']);
							}else{
								$sql = mysqli_query($con, 'select * from avaliacao AS a
								INNER JOIN ministra AS m ON m.id_ministra = a.id_ministra
								INNER JOIN professor AS p ON p.mat_prof = m.mat_prof');
							}
							while($info = mysqli_fetch_array($sql)){ 
								if(isset($_GET['id_aval'])){
									if ($_GET['id_aval'] == $info['id_aval']) {
										echo "<option value=".$info['id_aval']." selected>".$info['desc_aval']."</option>";
										continue;
									}
								}
								echo "<option value=".$info['id_aval'].">".$info['desc_aval']."</option>";
							}
						?>
				</select>
		</div>

		<div class="col-md-3">
			<!-- Chama o Formulário para adicionar usuários -->

			<a href="?page=fadd_avaliado&id_aval=<?php echo $id_aval?>" class="btn btn-primary pull-right h2">Lançar nota</a> 
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

				

				$sql = "SELECT * FROM avaliado a INNER JOIN matriculado m ON m.id_mat = a.id_mat INNER JOIN aluno al ON al.mat_aluno = m.mat_aluno WHERE id_aval = $id_aval limit $inicio, $quantidade;";

				$data = mysqli_query($con, $sql) or die(mysqli_error("ERRO: ".$con));

				
				echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
				echo "<thead><tr>";
				echo "<td><strong>Matricula</strong></td>"; 
				echo "<td><strong>Nome</strong></td>"; 
				echo "<td><strong>Nota</strong></td>"; 
				echo "<td><strong class='actions d-flex justify-content-center'>Ações</strong></td>"; 
				echo "</tr></thead><tbody>";
				while($info = mysqli_fetch_array($data)){ 
					echo "<tr>";
					echo "<td>".$info['id_mat']."</td>";
					echo "<td>".$info['nome_aluno']."</td>";
					echo "<td>".$info['nota_avaliado']."</td>";
					echo "<td class='actions btn-group-sm text-center'>";

					echo "<a class='btn btn-warning btn-xs' data-toggle='tooltip' title='Editar'  href='?page=lista_avaliado&id_aval=".$info['id_aval']."&id_avaliado=".$info['id_avaliado']."&modal=editar'>  <i class='fa-solid fa-pen-to-square'></i> </a>"; 
				}

				include 'crud/avaliado/modals_avaliado.php';

				echo "</tr></tbody></table>";
			?>
			
			<?php
					$sqlTotal 		= "select id_avaliado from avaliado where id_aval = $id_aval;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;


						echo "<ul class='pagination justify-content-center'>";
						echo "<li class='page-item'><a class='page-link' href='?page=lista_avaliado&id_aval=$id_aval&pagina=1'> Primeira</a></li> "; 
						echo "<li class='page-item'><a class='page-link' href=\"?page=lista_avaliado&id_aval=$id_aval&pagina=$anterior\"> Anterior</a></li> ";

						echo "<li class='page-item'><a class='page-link' href='?page=lista_avaliado&id_aval=$id_aval&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

						for($i = $pagina+1; $i < $pagina+$exibir; $i++){
							if($i <= $totalpagina)
							echo "<li class='page-item'><a class='page-link' href='?page=lista_avaliado&id_aval=$id_aval&pagina=".$i."'> ".$i." </a></li> ";
						}
			

					

					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_avaliado&id_aval=$id_aval&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?page=lista_avaliado&id_aval=$id_aval&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
		</div>
	</div>
</div>
<script>
	function mudar(){
		i = document.getElementById('avaliacoes').value;
		window.location.href = "?page=lista_avaliado&id_aval="+i;
	}
</script>


