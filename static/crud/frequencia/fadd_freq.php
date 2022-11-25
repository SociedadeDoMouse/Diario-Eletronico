<?php 

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
	5 => 'Professor'
);
    include "base/testa_nivel.php";
?>
<head>
	<style>
		/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: red;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
	</style>
</head>

<?php
	$cursa = $_GET['cursa'];
	$data = mysqli_query($con, "select * from cursa c INNER JOIN disciplina d ON c.id_disc = d.id_disc INNER JOIN ano_letivo a ON a.id_ano = c.id_ano where id_cursa = $cursa;") or die(mysqli_error("ERRO: ".$con));
	$info = mysqli_fetch_array($data);

	$turma = $info['n_turma'];
	$id_ano = $info['id_ano'];
	$ano = $info['data_inicio'];
	$disc = $info['id_disc'];
	$nome_disc = $info['nome_disc'];
?>

<div id="main" class="container-fluid volum_content">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Frequência</h2>
		</div>

		<hr>

	</div>	
	<div id="list" class="row">
		<div class="table-responsive" style="max-height: 70vh;">
			<div class='col-md-12'>
				<form action="?page=insere_freq" method="post">
					<!-- 1ª LINHA -->	
						<div class="row">
							<div class='col-md-2'>
								<label for="disc">Turma</label>
								<input class='form-control' name='turma' value='<?php echo $turma ?>' readonly>
							</div> 
							<div class='col-md-3'>
								<label for="disc">Ano Letivo</label>
								<input class='form-control' value='<?php echo  $info['nome_ano'] ?>' readonly>
								<input type="hidden" name="ano" value='<?php echo $info['id_ano'] ?>'>
							</div> 
							<div class='col-md-2'>
								<label for="disc">Disciplina</label>
								<input class='form-control' name='disc' value='<?php echo $nome_disc ?>' readonly>
							</div>
							<div class='col-md-2'>
								<label for="disc">Trimestre</label>
								<input type="number" min="1" max="3" class='form-control' name='trim' value='1'>
							</div>
							<div class='col-md-2'>
								<label for="disc">Data</label>
								<input type="date" class='form-control' name='data' value='<?php echo date('Y-m-d')?>'>
							</div>
						</div>
					<table class='table table-striped mt-2' cellspacing='0' cellpading='0'>
						<thead>
							<tr>
								<td><strong>Número</strong></td>
								<td><strong>Nome</strong></td>
								<td><strong>Presença</strong></td>
							</tr>
						</thead>
						<tbody>
							<?php
						
								$data = mysqli_query($con, "select * from enturmado e INNER JOIN aluno a ON e.mat_aluno = a.mat_aluno where n_turma = $turma;") or die(mysqli_error("ERRO: ".$con));
								$i = 0;
								while($info = mysqli_fetch_array($data)){ 
									
									$mat = $info['mat_aluno'];
									$data2 = mysqli_query($con, "select * from matriculado where mat_aluno = $mat and id_disc = $disc;") or die(mysqli_error("ERRO: ".$con));
									if(mysqli_fetch_array($data2)){
										$i++;
									
										echo "<tr>
												<td>".$info['num_enturmado']."</td>
												<input name='nome_aluno$i' type='hidden' class='form-control' value='".$mat."' readonly>
												<td><input class='form-control' value='".$info['nome_aluno']."' readonly></td>
												<td>
													<label class='switch'>
														<input type='checkbox' name='pres$i' checked>
														<span class='slider round'></span>
													</label>
												</td>
											</tr>";
									}
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<h2>Conteúdo (opcional)</h2>
		</div>

		<?php
		$data = mysqli_query($con, "select * from ministra INNER JOIN professor ON professor.mat_prof = ministra.mat_prof INNER JOIN usuario ON professor.id_usur = usuario.id_usur where id_cursa = $cursa") or die(mysqli_error("ERRO: ".$con));
		$info = mysqli_fetch_array($data);
		if(isset($info["id_ministra"])){
			echo '
			<div class="row">
				<input type="hidden" class="form-control" name="min" value="'.$info["id_ministra"].'">

				<div class="form-group col-md-6 col-sm-1">
					<label for="nome">Título</label>
					<input type="text" name="titulo" class="form-control">
				</div>
				<div class="form-group col-md-6 col-sm-1">
					<label for="nome">Descrição</label>
					<textarea name="desc" class="form-control"></textarea>
				</div>
			</div>
				<div id="actions" class="row">
					<div class="col-md-12">
						<button type="submit" class="btn btn-primary">Salvar</button>
						<a href="?page=lista_freq" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			</form> 
		</div>';
		}else{
			echo'
			<div class="row">
				<h4 style="color:red">É necessário a turma possuir um professor desta disciplina</h4>
			</div>';
		}
?>