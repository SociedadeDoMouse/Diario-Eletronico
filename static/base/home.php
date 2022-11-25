<div id="list" class="row">
<div class='table-responsive' style='overflow-x:unset;'>
	<h1 class="btnPag row" > <span id="btnLis"> Alertas e Avisos </span> </h1> 
	<hr>
	<br>
	<?php

if(!isset($_GET['tipo'])||!isset($_GET['usur'])||!isset($_GET['data'])){
	$_GET['tipo'] = "todos";
	$_GET['usur'] = "todos";
	$_GET['data'] = "todos";
}

$quantidade = 10;

$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;

$sql = "select * from mensagem m inner join usuario u on m.id_usur = u.id_usur order by id_msg desc limit $inicio, $quantidade";

$data = mysqli_query($con, $sql) or die(mysqli_error("ERRO: ".$con));

			echo "<table class='table table-striped' id='table' cellspacing='0' cellpading='0'>";
			echo "<thead><tr>";
			echo "<td class='text-center'><strong>Data</strong></td>"; 
			echo "<td><strong>Usuário</strong></td>"; 
			echo "<td><strong>Mensagem</strong></td>"; 
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