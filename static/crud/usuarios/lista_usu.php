<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";
	if(!isset($_GET['funcao'])){
		$_GET['funcao'] = 'todos';
	}
  ?>

	
	<div id="top" class="row">
		<div class="col-md-6">
			<h1 class="h3 mb-3">Painel de <strong>Usuários</strong></h1>
		</div>

		<div class="col-md-6" style="text-align: right;">
			<!-- Chama o Formulário para adicionar usuários -->
			<a href="?nv=<?php echo $nv;?>&page=fadd_usu" class="btn btn-primary h2 col-md-4">Novo Usuário</a>
			<a href="?nv=<?php echo $nv;?>&page=fadd_prof" class="btn btn-primary h2 col-md-4">Novo Professor</a> 
		</div>
	</div>

	<div class="row">
			<form action="dashboard.php" method="get">
				<input type="hidden" name="page" value='lista_usu'>
				<div class="row">
					<div class="form-group col-md-3 col-sm-3">
						<select name="funcao" class="form-control">
							<option value="todos"> Todas os níveis </option>
							<?php
								$funcao = "";
								$sql = mysqli_query($con, 'select * from funcao;');
								while($info = mysqli_fetch_array($sql)){ 

									if(isset($_POST['funcao']) && $_POST['funcao'] != "" || isset($_GET['funcao']) && $_GET['funcao'] != ""){

										if ($_POST['funcao'] == $info['id_func'] || $_GET['funcao'] == $info['id_func']) {

											echo "<option value=".$info['id_func']." selected>".$info['nome_func']."</option>";
											$funcao = "funcao.id_func = ".$info['id_func'];
											continue;

										}

									}

									echo "<option value=".$info['id_func'].">".$info['nome_func']."</option>";
									
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

	 <?php include "mensagens.php"; ?> 

	 <hr class="d-none d-md-block">

	<div id="list" class="row">
		<div class="table-responsive">
			<?php


				$quantidade = 10;

				$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
				$inicio = ($quantidade * $pagina) - $quantidade;

				$sql = "SELECT usuario.id_usur, usuario.usuario, usuario.senha, usuario.email, usuario.ativo, usuario.funcao, usuario.nome, funcao.nome_func, funcao.	id_func ";
				$sql .= "FROM usuario ";
				$sql .= "INNER JOIN funcao on usuario.funcao = funcao.id_func ";
				$sql .= "order by usuario.id_usur limit $inicio, $quantidade;"; 

				$s = "";
				if ($funcao != '') {
					$s = $funcao;
				}
				

				if($s!=""){
					$sql = "SELECT usuario.id_usur, usuario.usuario, usuario.senha, usuario.email, usuario.ativo, usuario.funcao, usuario.nome, funcao.nome_func, funcao.	id_func ";
					$sql .= "FROM usuario ";
					$sql .= "INNER JOIN funcao on usuario.funcao = funcao.id_func ";
					$sql .= "WHERE $s ";
					$sql .= "order by usuario.id_usur limit $inicio, $quantidade;"; 
				}
				
				$data_all = mysqli_query($con, $sql) or die(mysqli_error());

				echo "<table class='table table-striped' cellspacing='0' id='table' cellpading='0'>";
				echo "<thead><tr>";
				echo "<td class='col-md-3'><strong>Nome</strong></td>"; 
				echo "<td><strong>Usuário</strong></td>"; 
				echo "<td><strong>Email</strong></td>";
				echo "<td><strong>Nivel</strong></td>";
				echo "<td><strong class='actions d-flex justify-content-center'>Ações</strong></td>"; 
				echo "</tr></thead><tbody>";

                while($info = mysqli_fetch_array($data_all)){ 
                    echo "<tr>";
                    echo "<td>".$info['nome']."</td>";
                    echo "<td>".$info['usuario']."</td>";
                    echo "<td>".$info['email']." </td>";
                    echo "<td id='".$info['id_func']."'>".$info['nome_func']."</td>";
                    echo "<td><div class='actions btn-group-sm d-flex justify-content-center'>";

					echo "<a class='btn btn-info btn-xs' data-toggle='tooltip' title='Detalhar' href='?funcao=".$_GET['funcao']."&page=lista_usu&id_usur=".$info['id_usur']."&modal=detalhar'> <i class='fa-solid fa-circle-plus'></i> </a>";
						
                    echo "<a class='btn btn-warning btn-xs' data-toggle='tooltip' title='Editar' href='?funcao=".$_GET['funcao']."&page=lista_usu&id_usur=".$info['id_usur']."&modal=editar'> <i class='fa-solid fa-pen-to-square'></i> </a>";

                    if($info['ativo'] == 1){
                        echo "<a class='btn btn-danger btn-xs' data-toggle='tooltip' title='Bloquear'  href=?page=block_usu&id_usur=".$info['id_usur']."> <i class='fa-solid fa-shield'></i> </a>";
                    }else if($info['ativo'] == 0){
                        echo "<a class='btn btn-success btn-xs data-toggle='tooltip' title='Ativar'   href=?page=ativa_usu&id_usur=".$info['id_usur']."> <i class='fa-solid fa-shield-halved'></i> </a></div></td>";
                    }
                }
				
				include "crud/usuarios/modals_usu.php";
				
				echo "</tr></tbody></table>";


			?>

			
			</div>
			<?php
					$sqlTotal 		= "select id_usur from usuario;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;


						echo "<ul class='pagination justify-content-center'>";
						echo "<li class='page-item'><a class='page-link' href='?funcao=".$_GET['funcao']."&nv=$nv&page=lista_usu&pagina=1'> Primeira</a></li> "; 
						echo "<li class='page-item'><a class='page-link' href=\"?funcao=".$_GET['funcao']."&nv=$nv&page=lista_usu&pagina=$anterior\"> Anterior</a></li> ";

						echo "<li class='page-item'><a class='page-link' href='?funcao=".$_GET['funcao']."&nv=$nv&page=lista_usu&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

						for($i = $pagina+1; $i < $pagina+$exibir; $i++){
							if($i <= $totalpagina)
							echo "<li class='page-item'><a class='page-link' href='?funcao=".$_GET['funcao']."&nv=$nv&page=lista_usu&pagina=".$i."'> ".$i." </a></li> ";
						}
			

					

					echo "<li class='page-item'><a class='page-link' href=\"?funcao=".$_GET['funcao']."&nv=$nv&page=lista_usu&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?funcao=".$_GET['funcao']."&nv=$nv&page=lista_usu&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
	</div>