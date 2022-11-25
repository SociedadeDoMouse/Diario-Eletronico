<!DOCTYPE html>
<?php ob_start(); ?> <html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap">
	<link rel="stylesheet" href="build/css/app.css">
	
	<link rel="shortcut icon" href="build/img/caramelo.svg" type="image/x-icon">
	<link rel="stylesheet" href="build/css/geral.css">
	
	
	<title>Diário</title>

	<?php  session_start(); if(!isset($_SESSION['UsuarioNome'])){	header("Location: index.php"); exit;} include "base/connect_crud.php"; $nv = $_SESSION['UsuarioNivel'];?>

</head>

<body>
	<div class="wrapper">

		<?php include "base/sidebar.php"; ?>

		<div class="main">

		<?php include "base/topnavigation.php";?>
		

			<main class="content">
				<div class="container-fluid p-0">

						<?php
							include "base/ch_pages.php"; 
						?>
						
				</div>
			</main>

		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="build/js/app.js"></script>

</body>

</html>
<?php ob_end_flush(); ?>