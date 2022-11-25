<?php
      $nivel_necessario = array(
		1 => 'Administrador',
		2 => 'Diretor',
		3 => 'Coodernador',
		4 => 'Secretario',
		5 => 'Professor',
		6 => 'Supervisor'
	);
      include "base/testa_nivel.php";
	  include "base/functions/formdata.php";

	  if(!isset($_GET['tipo'])||!isset($_GET['usur'])||!isset($_GET['data'])){
			$_GET['tipo'] = "todos";
			$_GET['usur'] = "todos";
			$_GET['data'] = "todos";
		}

  ?>
<div class="row">
	<div class="col">
		<h1 class="h3 mb-3">Painel de <strong>Alertas</strong></h1>
	</div>

	<div class="col-md-5 col-sm-6 mt-3" style="text-align:right;">
		<a href='?page=fadd_alerta' id="btnGroupDrop1" type="button" class="btn btn-primary">
			Adicionar Alerta
		</a>
	</div>

</div>

<div class="row">
	<form action="dashboard.php" method="get">
		<input type="hidden" name="page" value='lista_alerta'>
		<div class="row">
			<div class="form-group col-md-3 col-sm-3">
				<select name="data" class="form-control">
					<option value="todos"> Todas as datas </option>
					<?php
						$sql = mysqli_query($con, 'SELECT distinct cast(data_msg AS date) FROM mensagem;');
						while($info = mysqli_fetch_array($sql)){ 

							if(isset($_GET['data']) && $_GET['data'] != ""){

								if ($_GET['data'] == $info[0]) {

									echo "<option value=".$info[0]." selected>".formdata($info[0])."</option>";
									continue;

								}

							}

							echo "<option value='".$info[0]."'>".formdata($info[0])."</option>";
							
						}
					?>
				</select>
			</div>
			<div class="form-group col-md-3 col-sm-3">
				<select name="usur" class="form-control">
					<option value="todos"> Todos os Usuários </option>
					<?php
						$sql = mysqli_query($con, 'select * from usuario;');
						while($info = mysqli_fetch_array($sql)){ 

							if(isset($_GET['usur']) && $_GET['usur'] != ""){

								if ($_POST['usur'] == $info['id_usur'] || $_GET['usur'] == $info['id_usur']) {

									echo "<option value=".$info['id_usur']." selected>".$info['nome']."</option>";
									continue;

								}

							}
							
							echo "<option value=".$info['id_usur'].">".$info['nome']."</option>";
							
						}
					?>
					
					
				</select>
			</div>
			<div class="form-group col-md-3 col-sm-3">
				<select name="tipo" class="form-control">
					<option value="todos"> Todos os Tipos </option>
					<?php

						$tipos = ['Alertas','Avisos','Registros','Avisos Públicos'];

						for ($i=1; $i <= 4; $i++) { 
						

							if(isset($_GET['tipo']) && $_GET['tipo'] != ""){

								if ($_GET['tipo'] == $i) {

									echo '<option value="'.$i.'" selected> '.$tipos[$i-1].' </option>';
									continue;

								}
								echo '<option value="'.$i.'"> '.$tipos[$i-1].' </option>';
							}
							
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

<br>

<?php include "mensagens.php"; ?>

<hr class="d-none d-md-block">

<div id="list" class="row">
	<div class="table-responsive">
	<?php

			$quantidade = 10;

			$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
			$inicio = ($quantidade * $pagina) - $quantidade;
			
			$sql = "select * from mensagem m inner join usuario u on m.id_usur = u.id_usur";

			if($_SESSION['UsuarioNivel'] == 5){
				$sql = "select * from mensagem m inner join usuario u on m.id_usur = u.id_usur where m.id_usur = ".$_SESSION['UsuarioID']." || tipo_msg = 4";
			}
				


			if($_GET['tipo'] != 'todos'){
				$sql .= " where tipo_msg = ".$_GET['tipo'];
				if ($_GET['usur'] != 'todos') {
					$sql .= " AND m.id_usur = ".$_GET['usur'];
				}
				if($_GET['data'] != 'todos'){
					$sql .= " AND cast(data_msg AS date) = '".$_GET['data']."'";
				}
			}else if($_GET['usur'] != 'todos'){
				$sql .= " WHERE m.id_usur = ".$_GET['usur'];
				if($_GET['data'] != 'todos'){
					$sql .= " AND cast(data_msg AS date) = '".$_GET['data']."'";
				}
			}else if($_GET['data'] != 'todos'){
			 	$sql .= " WHERE cast(data_msg AS date) = '".$_GET['data']."'";
			 }

			 $sql .= " order by id_msg desc limit $inicio, $quantidade";
			 
			$data = mysqli_query($con, $sql) or die(mysqli_error("ERRO: ".$con));
			
			echo "<table class='table table-striped' id='table' cellspacing='0' cellpading='0'>";
			echo "<thead><tr>";
			echo "<td class='text-center'><strong>Data</strong></td>"; 
			echo "<td><strong>Usuário</strong></td>"; 
			echo "<td><strong>Mensagem</strong></td>"; 
			echo "<td><strong>Tipo</strong></td>"; 
			echo "<td><strong class='actions d-flex justify-content-center'>Ações</strong></td>"; 
			echo "</tr></thead><tbody>";
			while($info = mysqli_fetch_array($data)){ 

				echo "<tr>";
				echo "<td class='text-center'>".date('d/m/Y  H:i:s',strtotime($info['data_msg']))."</td>";

				if ($info['funcao'] == 5) {
					$nome = "Prof. ".$info['nome'];
				}else{
					$nome = $info['nome'];
				}

				echo "<td>".$nome."</td>";

				echo "<td>".mb_strimwidth($info['txt_msg'],0,80,'...')."</td>";

				switch ($info['tipo_msg']) {
					case 0:
						$tipo = 'Alerta';
						break;
					
					case 1:
						$tipo = 'Aviso';
						break;
						
					case 3:
						$tipo = 'Registro';
						break;
					
					case 2:
						$tipo = 'Aviso Público';
						break;
				}

				echo "<td>".$tipo."</td>";

				echo "<td class='actions btn-group-sm d-flex justify-content-center'>";
				
				echo "<a class='btn btn-info btn-xs' data-toggle='tooltip' title='Detalhar' href='?data=".$_GET['data']."&usur=".$_GET["usur"]."&tipo=".$_GET['tipo']."&page=lista_alerta&id=".$info['id_msg']."&modal=detalhar'>  <i class='fa-solid fa-circle-plus'></i> </a>";

				if($_SESSION['UsuarioNivel'] != 5){
					echo "<a class='btn btn-warning btn-xs' data-toggle='tooltip' title='Editar' href='?data=".$_GET['data']."&usur=".$_GET["usur"]."&tipo=".$_GET['tipo']."&page=lista_alerta&id=".$info['id_msg']."&modal=editar'> <i class='fa-solid fa-pen-to-square'></i> </a>"; 

					echo "<a href='?data=".$_GET['data']."&usur=".$_GET["usur"]."&tipo=".$_GET['tipo']."&page=lista_alerta&id=".$info['id_msg']."&modal=excluir' class='btn btn-danger btn-xs' data-toggle='tooltip' title='Excluir'> <i class='fa-solid fa-trash'></i>   </a></td>";
				}
			}

			include "crud/alerta/modals_alerta.php";

			echo "</tr></tbody></table>";
		?>
		
	</div>
		<?php
				$sqlTotal 		= "select id_msg from mensagem ;";
				if($_SESSION['UsuarioNivel'] == 5){
					$sqlTotal = "select id_msg from mensagem m where m.id_usur = ".$_SESSION['UsuarioID']." || tipo_msg = 4;";
				}

				$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
				$numTotal 		= mysqli_num_rows($qrTotal);
				$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);
-
				$exibir = 3;

				$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
				$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;


					echo "<ul class='pagination justify-content-center'>";
					echo "<li class='page-item page-item-adjust'><a class='page-link' href='?data=".$_GET['data']."&usur=".$_GET["usur"]."&tipo=".$_GET['tipo']."&page=lista_alerta&pagina=1'> Primeira</a></li> "; 
					echo "<li class='page-item page-item-center'><a class='page-link' href=\"?data=".$_GET['data']."&usur=".$_GET["usur"]."&tipo=".$_GET['tipo']."&page=lista_alerta&pagina=$anterior\"> Anterior</a></li> ";

					echo "<li class='page-item page-item-adjust'><a class='page-link' href='?data=".$_GET['data']."&usur=".$_GET["usur"]."&tipo=".$_GET['tipo']."&page=lista_alerta&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

					for($i = $pagina+1; $i < $pagina+$exibir; $i++){
						if($i <= $totalpagina)
						echo "<li class='page-item page-item-adjust'><a class='page-link' href='?data=".$_GET['data']."&usur=".$_GET["usur"]."&tipo=".$_GET['tipo']."&page=lista_alerta&pagina=".$i."'> ".$i." </a></li> ";
					}
		
				echo "<li class='page-item page-item-adjust'><a class='page-link' href=\"?data=".$_GET['data']."&usur=".$_GET["usur"]."&tipo=".$_GET['tipo']."&page=lista_alerta&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
				echo "<li class='page-item page-item-adjust'><a class='page-link' href=\"?data=".$_GET['data']."&usur=".$_GET["usur"]."&tipo=".$_GET['tipo']."&page=lista_alerta&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

			?>	
</div>