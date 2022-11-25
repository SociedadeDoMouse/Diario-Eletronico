<div id="main" class="container-fluid volum_content">
 	<div id="top" class="row">
		<div class="col-md-11">
			<h2>Avaliação</h2>
		</div>
		<?php
			$id_aval = $_GET['id_aval'];
			$data5 = mysqli_query($con, "select nota_max from avaliacao where id_aval = ".$id_aval) or die(mysqli_error("ERRO: ".$con));	
			$info5 = mysqli_fetch_array($data5)
		?>

	</div>
	<form action="?page=insere_avaliado&id_aval=<?php echo $id_aval; ?>" method="post">
		<!-- 1ª LINHA -->	
		<div class="row"> 
			<div class="form-group col-md-6 col-sm-1">
				<label for="nome">Data</label>
				<input type="date" name="data" class="form-control" REQUIRED>
			</div>
		</div>

		<div class="row">
		<table class='table table-striped mt-2' cellspacing='0' cellpading='0'>
						<thead>
							<tr>
								<td><strong>Número</strong></td>
								<td><strong>Nome</strong></td>
								<td><strong>Nota</strong></td>
							</tr>
						</thead>
						<tbody>
							<?php
								
								$data = mysqli_query($con, "select * from avaliacao av INNER JOIN ministra m ON av.id_ministra = m.id_ministra INNER JOIN cursa c ON m.id_cursa = c.id_cursa INNER JOIN turma t ON t.n_turma = c.n_turma INNER JOIN disciplina d ON c.id_disc = d.id_disc INNER JOIN enturmado e ON e.n_turma = t.n_turma INNER JOIN aluno al ON e.mat_aluno = al.mat_aluno where id_aval = $id_aval;") or die(mysqli_error("ERRO: ".$con));	
								
								$i = 0;
								while($info = mysqli_fetch_array($data)){ 

									$disc = $info['id_disc'] ;
									$mat = $info['mat_aluno'];

									$data2 = mysqli_query($con, "select * from matriculado where mat_aluno = $mat and id_disc = $disc;") or die(mysqli_error("ERRO: ".$con));
									mysqli_fetch_array($data2);
										$i++;
									

										echo "<tr>
												<td>".$info['num_enturmado']."</td>
												<td><input name='nome_aluno$i' class='form-control' value='".$info['nome_aluno']."' readonly></td>
												<td>
													<input type='number' name='pres$i' min='0' step='any' value='0' max='".$info5['nota_max']."' class='form-control'>
												</td>
											</tr>";
									
								}
							?>
						</tbody>
					</table>
		</div>
		<hr />
		<div id="actions" class="row">
			<div class="col-md-12">
				<button type="submit" class="btn btn-primary">Salvar</button>
				<a href="?page=lista_avaliado&id_aval=<?php echo $id_aval ?>" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</form> 
</div>
