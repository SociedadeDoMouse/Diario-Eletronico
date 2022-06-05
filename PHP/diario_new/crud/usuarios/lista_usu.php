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
			<h3>Usuários</h3>
		</div>

		<div class="col-md-1">
			<!-- Chama o Formulário para adicionar usuários -->
			<a href="?nv=<?php echo $nv;?>&page=fadd_usu" class="btn btn-primary pull-right h2">Novo Usuário</a> 
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

				$data_all = mysqli_query($con, "select * from usuario order by id_usur asc limit $inicio, $quantidade;") or die(mysqli_error());

				echo "<table class='table table-striped' cellspacing='0' cellpading='0'>";
				echo "<thead><tr>";
				echo "<td><strong>ID</strong></td>"; 
				echo "<td><strong>Nome</strong></td>"; 
				echo "<td><strong>Usuário</strong></td>"; 
				echo "<td><strong>Email</strong></td>";
				echo "<td><strong>Nivel</strong></td>";
				echo "<td><strong>Ativo</strong></td>";
				echo "<td class='actions d-flex justify-content-center'><strong>Ações</strong></td>"; 
				echo "</tr></thead><tbody>";

                while($info = mysqli_fetch_array($data_all)){ 
                    echo "<tr>";
                    echo "<td>".$info['id_usur']."</td>";
                    echo "<td>".$info['nome']."</td>";
                    echo "<td>".$info['usuario']."</td>";
                    echo "<td>".$info['email']." </td>";
                    echo "<td>".$info['funcao']."</td>";
                    if($info['ativo'] == 1){
                        echo "<td>SIM</td>";
                    }else if($info['ativo'] == 0){
                        echo "<td>NÃO</td>";
                    }
                    echo "<td><div class='btn-group btn-group-xs'>";
                    echo "<a class='btn btn-info btn-xs ' href=?page=view_usu&id_usur=".$info['id_usur']."> Detalhar </a>";
                    echo "<a class='btn btn-warning  btn-xs' href=?page=fedita_usu&id_usur=".$info['id_usur']."> Editar </a>";
                    if($info['ativo'] == 1){
                        echo "<a class='btn btn-danger btn-xs '  href=?page=block_usu&id_usur=".$info['id_usur']."> Bloquear </a>";
                    }else if($info['ativo'] == 0){
                        echo "<a class='btn btn-success  '  href=?page=ativa_usu&id_usur=".$info['id_usur'].">&nbsp;&nbsp;&nbsp;Ativar&nbsp;&nbsp;</a></div></td>";
                    }
                }

				echo "</tr></tbody></table>";
			?>
			
			<?php
					$sqlTotal 		= "select id_usur from usuario;";
					$qrTotal  		= mysqli_query($con, $sqlTotal) or die (mysqli_error());
					$numTotal 		= mysqli_num_rows($qrTotal);
					$totalpagina = (ceil($numTotal/$quantidade)<=0) ? 1 : ceil($numTotal/$quantidade);

					$exibir = 3;

					$anterior = (($pagina-1) <= 0) ? 1 : $pagina - 1;
					$posterior = (($pagina+1) >= $totalpagina) ? $totalpagina : $pagina+1;


						echo "<ul class='pagination'>";
						echo "<li class='page-item'><a class='page-link' href='?nv=$nv&page=lista_usu&pagina=1'> Primeira</a></li> "; 
						echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_usu&pagina=$anterior\"> Anterior</a></li> ";

						echo "<li class='page-item'><a class='page-link' href='?nv=$nv&page=lista_usu&pagina=".$pagina."'><strong>".$pagina."</strong></a></li> ";

						for($i = $pagina+1; $i < $pagina+$exibir; $i++){
							if($i <= $totalpagina)
							echo "<li class='page-item'><a class='page-link' href='?nv=$nv&pzage=lista_usu&pagina=".$i."'> ".$i." </a></li> ";
						}
			

					

					echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_usu&pagina=$posterior\"> Pr&oacute;xima</a></li> ";
					echo "<li class='page-item'><a class='page-link' href=\"?nv=$nv&page=lista_usu&pagina=$totalpagina\"> &Uacute;ltima</a></li></ul>";

				?>	
		</div>
	</div>
</div>
