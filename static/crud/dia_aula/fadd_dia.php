<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";
?>
<head>
	<style>
		li{
			list-style-type: none;
		}
	</style>
</head>
<div id="main" class="container-fluid volum_content">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Dias da Aula</h2>
		</div>

	</div>
	<form action="?page=fadd_dia" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-6 col-sm-1">
				<label for="dia">Dias da Aula</label>
					<br>
					<input type='checkbox' class='form-check-input' value="1" name='seg' id='seg'><label for="seg">Segunda-feira</label><br>
					<input type='checkbox' class='form-check-input' value="2" name='ter' id='ter'><label for="ter">Terça-feira</label><br>
					<input type='checkbox' class='form-check-input' value="3" name='qua' id='qua'><label for="qua">Quarta-feira</label><br>
					<input type='checkbox' class='form-check-input' value="4" name='qui' id='qui'><label for="qui">Quinta-feira</label><br>
					<input type='checkbox' class='form-check-input' value="5" name='sex' id='sex'><label for="sex">Sexta-feira</label><br>
					<input type='checkbox' class='form-check-input' value="6" name='sab' id='sab'><label for="sab">Sábado</label><br>
					<input type='checkbox' class='form-check-input' value="7" name='dom' id='dom'><label for="dom">Domingo</label>
			</div>
			<div class="form-group col-md-6 col-sm-1">
				<select class='form-control' name="id_ano" id="">
					<?php
						$sql = mysqli_query($con, 'select * from ano_letivo');
						while($info = mysqli_fetch_array($sql)){ 
							echo "<option value=".$info['id_ano'].">".$info['nome_ano']."</option>";
						}
					?>
				</select>
			</div>
			<hr />
			<div id="actions" class="row">
				<div class="col-md-12">
					<button type="submit" name='submit' class="btn btn-primary">Enviar</button>
					<a href="?page=lista_dia" class="btn btn-danger">Cancelar</a>
				</div>
			</div>
	</form>
	<form action="?page=insere_dia" method="post">
		<br><br>
			<div class="form-group col-md-6 col-sm-1">
				<label for="nome">Ministra</label>
				<select class='form-control' name='min'>
						<?php
							$sql = mysqli_query($con, 'select * from ministra inner join cursa on ministra.id_cursa = cursa.id_cursa inner join disciplina on cursa.id_disc = disciplina.id_disc inner join ano_letivo on cursa.id_ano = ano_letivo.id_ano inner join professor on ministra.mat_prof = professor.mat_prof inner join usuario on professor.id_usur = usuario.id_usur;');
							while($info = mysqli_fetch_array($sql)){ 
								echo "<option value=".$info['id_ministra'].">".$info['n_turma']." | ".$info['nome_disc']." | ".$info['nome_ano']." | ".$info['nome']."</option>";
							}
						?>
				</select>
			</div>
		</div>
		
	
							<br>
		<?php 

			$name = 0;

			echo "<div class='row'>";
			if(isset($_POST['submit'])){
				$dias = array();
				if(isset($_POST['seg'])){
					$dias[] = 1;
				}
				if(isset($_POST['ter'])){
					$dias[] = 2;
				}
				if(isset($_POST['qua'])){
					$dias[] = 3;
				}
				if(isset($_POST['qui'])){
					$dias[] = 4;
				}
				if(isset($_POST['sex'])){
					$dias[] = 5;
				}
				if(isset($_POST['sab'])){
					$dias[] = 6;
				}
				if(isset($_POST['dom'])){
					$dias[] = 7;
				}

				for($i=0; $i < count($dias); $i++){
					if(isset($dias[$i])){
						switch ($dias[$i]) {
							case '1':
								$txt="next monday";
								$ndia='Segunda-feira';
								break;

							case '2':
								$txt="next tuesday";
								$ndia='Terça-feira';
								break;

							case '3':
								$txt="next wednesday";
								$ndia='Quarta-feira';
								break;	

							case '4':
								$txt="next Thursday";
								$ndia='Quinta-feira';
								break;	

							case '5':
								$txt="next Friday";
								$ndia='Sexta-feira';
								break;	
							
							case '6':
								$txt="next Saturday";
								$ndia='Sábado';
								break;	

							case '7':
								$txt="next Sunday";
								$ndia='Domingo';
								break;	
							}
					}
					if(isset($txt)){
					$ano = $_POST['id_ano'];

					$sql4 = "SELECT data_fim, data_inicio FROM ano_letivo where id_ano = ".$ano;

					$ex = mysqli_query($con, $sql4);
					

					$info4 = mysqli_fetch_array($ex);
					
					$datainicio = $info4['data_inicio'];
					$datafim = $info4['data_fim'];

					$datetime = new DateTime($datainicio);
					$datetime->modify($txt);
					echo "<div style='text-align:center;' class='col-md-3'>";
					echo "<h3>$ndia</h3>";
					echo "<ul>";

					

					

					$data = date('Y-m-d', strtotime($datafim));
					

					while ($datetime->format('Y-m-d') < $data) {
						
						echo "<li><input type='checkbox' class='form-check-input' name='".$name."' id='".$datetime->format('d-m-Y')."' value='".$datetime->format('Y-m-d')."' checked> <label for='".$datetime->format('d-m-Y')."'>".$datetime->format('d/m/Y')."</label></li>";
						$datetime->modify($txt);

						$name++;
					}
					
					echo "</ul>";
					echo '</div>';
				}
			}
			}
			echo '</div>'
		?>
	 
	</div>
	<hr/>
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" name='submit' class="btn btn-primary">Salvar</button>
				<a href="?page=lista_dia" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
</form>