<?php
	$id = (int) $_GET['id'];
	$sql = mysqli_query($con, "select * from documento where id_doc = '".$id."';");
	$row = mysqli_fetch_array($sql);
?>

<div id="main" class="container-fluid">
	<br>
		<h3 class="page-header">Visualizar registro de Documento - <?php echo $id;?></h3>

	<!-- 1ª LINHA -->	
	<div class="row"> 
			<div class="form-group col-md-2">
				<label for="id">Id</label>
				<input type="text" class="form-control" value="<?php echo $id ?>" name="id" readonly>
			</div>
			<div class="form-group col-md-5">
				<label for="tit">Título</label>
				<input type="text" class="form-control" value="<?php echo $row['tit_doc'] ?>" name="tit" readonly>
			</div>
			<div class="form-group col-md-5">
				<label for="desc">Descrição</label>
				<input type="text" class="form-control" value="<?php echo $row['desc_doc'] ?>" name="desc" readonly>
			</div>
		</div>

		<!-- 2ª LINHA -->
		
		<div class="row"> 
			
			<div class="form-group col-md-3">
				<label for="status">Status</label>
				<input type="text" class="form-control" value="<?php if($row['status_doc'] == 1){echo "ativo";}else{echo "arquivado";} ?>" name="arquivo" readonly>
			</div>

			<div class="form-group col-md-3">
				<label for="versao">Versão</label>
				<input type="text" class="form-control" value="<?php echo $row['versao_doc'] ?>" name="versao" readonly>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="form-group col-md-12">
				<h3>Documento</h3>
				<object data="<?php echo $row['local_doc'];?>" style="margin-top:3%;" height="500%" width="100%" type="application/pdf">
					<p>Seu navegador não tem um plugin pra PDF</p>
				</object>
			</div>
		</div>
	<hr style="margin-top:100%;"/>
	
	<hr/>
	
	<div  id="actions" class="row">
		<div class="col-md-12">
			<a href="?page=lista_doc" class="btn btn-default">Voltar</a>
			<?php echo "<a href=?page=fedita_doc&id=".$row['id_doc']." class='btn btn-primary'>Editar</a>";?>
		</div>
	</div>
</div>
