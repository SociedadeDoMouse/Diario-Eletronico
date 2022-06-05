<?php

	
	$id = (int) $_GET['id'];
	$sql = mysqli_query($con, "select * from documento where id_doc = '".$id."';");
	$row = mysqli_fetch_array($sql);
?>
<div id="main" class="container-fluid">
	<br><h3 class="page-header">Editar registro do Documento - <?php echo $id;?></h3>

	<!-- Área de campos do formulário de edição-->

	<form enctype="multipart/form-data" action="?page=atualiza_doc&id=<?php echo $row['id_doc'];?>" method="post">

		<!-- 1ª LINHA -->	
	<div class="row"> 
			<div class="form-group col-md-2">
				<label for="id">Id</label>
				<input type="text" class="form-control" value="<?php echo $id ?>" name="id" readonly>
			</div>
			<div class="form-group col-md-5">
				<label for="tit">Título</label>
				<input type="text" class="form-control" value="<?php echo $row['tit_doc'] ?>" name="tit">
			</div>
			<div class="form-group col-md-5">
				<label for="desc">Descrição</label>
				<input type="text" class="form-control" value="<?php echo $row['desc_doc'] ?>" name="desc">
			</div>
		</div>

		<!-- 2ª LINHA -->
		
		<div class="row">
			<div class="form-group col-md-4">
				<label for="arquivo">Arquivo</label>
				<input type="file" class="form-control" name="arquivo">
			</div> 
			
			<div class="form-group col-md-3">
				<label for="status">Status</label>
				
				<select class="form-control" name="status">
					<?php 
					if($row['status_doc'] == '1'){
						$value1 = "selected";
						$value2 = "";
					} else{
						$value1 = "";
						$value2 = "selected";
					}
						 ?>
					<option value="1"<?php echo $value1?>>Ativo</option>
					<option value="2"<?php echo $value2?>>Arquivado</option>
				</select>
			
			</div>

			<div class="form-group col-md-3">
				<label for="versao">Versão</label>
				<input type="text" class="form-control" value="<?php echo $row['versao_doc'] ?>" name="versao">
			</div>
		</div>
	<hr/>

	<div id="actions" class="row">
		<div class="col-md-12">
			<a href="?page=lista_doc" class="btn btn-secondary">Voltar</a>
			<button type="submit" class="btn btn-primary">Salvar Alterações</button>
		</div>
	</div>
</div>