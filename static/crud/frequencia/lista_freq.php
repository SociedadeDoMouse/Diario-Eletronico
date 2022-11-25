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
  ?>



<div id="main" class="col-md-12">
	<div id="top" class="row">

		<div class="col-md-4 col-sm-12">
			<h1 class="h3">Painel de <strong>Frequência</strong></h1>
		</div>

		<div class="col-md-6 pull-right">
			<form action="dashboard.php" method="GET" class="row">
		
				<div class="col-md-4 col-10">
					<input type="hidden" name="page" value="lista_freq">
					<select name="turma" class="form-control">
						<option disabled selected value>Turma</option>
						<?php
						
							if($_SESSION['UsuarioNivel'] == 5){
								$sql = mysqli_query($con, 'SELECT DISTINCT nome_ano, enturmado.n_turma, enturmado.id_ano, data_inicio FROM enturmado INNER JOIN ano_letivo ON enturmado.id_ano = ano_letivo.id_ano INNER JOIN cursa ON cursa.n_turma = enturmado.n_turma INNER JOIN ministra ON ministra.id_cursa = cursa.id_cursa INNER JOIN professor ON professor.mat_prof = ministra.mat_prof WHERE professor.id_usur ='.$_SESSION['UsuarioID']);
							}else{

							$sql = mysqli_query($con, 'select DISTINCT nome_ano, n_turma, enturmado.id_ano, data_inicio from enturmado INNER JOIN ano_letivo ON enturmado.id_ano = ano_letivo.id_ano;');}


							while($info = mysqli_fetch_array($sql)){ 
								if(isset($_POST['turma']) || isset($_GET['turma'])){
									if ($_GET['turma'] == $info['n_turma']."_".$info['id_ano'] || $_GET['turma'] == $info['n_turma']) {
										echo "<option value=".$info['n_turma']."_".$info['id_ano']." selected>".$info['n_turma']." | ".$info['nome_ano']."</option>";
										continue;
									}
								}
								echo "<option value=".$info['n_turma']."_".$info['id_ano'].">".$info['n_turma']." | ".$info['nome_ano']."</option>";
							}
						?>
					</select>
				</div>

				<div class="col-md-1 col-1">
					<button type="submit" class="btn btn-success">
						<i class="fa-solid fa-magnifying-glass"></i>
					</button>
				</div>
			
			</form>
		</div>
	</div>

	<div> <?php include "mensagens.php"; ?> </div>

	<hr class="d-none d-md-block">

	<div id="list" class="row">
		<div class="table-responsive">
			
				<?php
					if(isset($_GET['disc'])){
						include 'lista/freq.php';
					}else if(isset($_GET['turma'])){
						include 'lista/cursa.php';
					}
				?>
			</form>
		</div>
	</div>
</div>
