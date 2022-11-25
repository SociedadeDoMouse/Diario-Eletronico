<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";
  ?>

	
	<div id="top" class="row">
		<div class="col-md-10">
			<h1 class="h3 mb-3">Painel de <strong>Usuários</strong></h1>
		</div>

		<div class="col-md-2">
			<!-- Chama o Formulário para adicionar usuários -->
			<a href="?nv=<?php echo $nv;?>&page=fadd_usu" class="btn btn-primary pull-right h2">Novo Usuário</a>
			<a href="?nv=<?php echo $nv;?>&page=fadd_usu" class="btn btn-primary pull-right h2">Novo Professor</a> 
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
	
				$sql = "SELECT usuario.id_usur, usuario.usuario, usuario.senha, usuario.email, usuario.ativo, usuario.funcao, usuario.nome, funcao.nome_func, funcao.id_func limit $inicio, $quantidade;";
				$sql .= "FROM usuario ";
				$sql .= "INNER JOIN funcao on usuario.funcao = funcao.id_func ";
				$sql .= "order by usuario.id_usur asc limit $inicio, $quantidade;"; 
				$data_all = mysqli_query($con, $sql) or die(mysqli_error());

				echo "<table class='table table-striped' cellspacing='0' id='table' cellpading='0'>";
				echo "<thead><tr>"; 
				echo "<td><strong>Nome</strong></td>"; 
				echo "<td><strong>Usuário</strong></td>"; 
				echo "<td><strong>Email</strong></td>";
				echo "<td><strong>Nivel</strong></td>";
				echo "<td><strong>Ativo</strong></td>";
				echo "<td><strong class='actions d-flex justify-content-center'>Ações</strong></td>"; 
				echo "</tr></thead><tbody>";

                while($info = mysqli_fetch_array($data_all)){ 
                    echo "<tr>";
                    echo "<td>".$info['nome']."</td>";
                    echo "<td>".$info['usuario']."</td>";
                    echo "<td>".$info['email']." </td>";
                    echo "<td id='".$info['id_func']."'>".$info['nome_func']."</td>";
                    if($info['ativo'] == 1){
                        echo "<td>SIM</td>";
                    }else if($info['ativo'] == 0){
                        echo "<td>NÃO</td>";
                    }
                    echo "<td><div class='actions btn-group-sm d-flex justify-content-center'>";

                    echo "<a class='btn btn-info btn-xs' data-toggle='tooltip' title='Detalhar' onclick='detalhar(this)'> <i data-feather='plus-circle' data-toggle='modal' data-target='#view_usu'></i> </a>";

                    echo "<a class='btn btn-warning btn-xs' data-toggle='tooltip' title='Editar' href='?page=lista_usu&id_usur=".$info['id_usur']."'> <i class='fa-solid fa-pen-to-square'></i> </a>";
                    if($info['ativo'] == 1){
                        echo "<a class='btn btn-danger btn-xs' data-toggle='tooltip' title='Bloquear'  href=?page=block_usu&id_usur=".$info['id_usur']."> <i class='fa-solid fa-shield-halved'></i> </a>";
                    }else if($info['ativo'] == 0){
                        echo "<a class='btn btn-success btn-xs data-toggle='tooltip' title='Ativar'   href=?page=ativa_usu&id_usur=".$info['id_usur']."> 
						<i class='fa-solid fa-shield'></i> </a></div></td>";
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
						echo "<li class='page-item'><a class='page-link' href='?nv=$nv&page=lista_usu&pagina=1'> Primeira</a></li> "; 
						echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_usu&pagina=$anterior\"> Anterior</a></li> ";

						echo "<li class='page-item'><a class='page-link' href='?nv=$nv&page=lista_usu&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

						for($i = $pagina+1; $i < $pagina+$exibir; $i++){
							if($i <= $totalpagina)
							echo "<li class='page-item'><a class='page-link' href='?nv=$nv&page=lista_usu&pagina=".$i."'> ".$i." </a></li> ";
						}
			

					

					echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_usu&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_usu&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
	</div>