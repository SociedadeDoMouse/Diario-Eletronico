<?php
	if(!isset($_SESSION)) session_start();
	
	// SE FOR ARRAY, IRA VERIFICAR SE O USUARIO NIVEL EXISTE NA ARRAY
	if(is_array($nivel_necessario)){

		if (array_key_exists($_SESSION['UsuarioNivel'], $nivel_necessario) == false) {
			session_destroy();
			echo "Acesso NEGADO!!!<br><br>";
			header("Location: index.php"); 
			exit;
		}
	}
	
	//SE NÃO FOR ARRAY VAI VER SE O NIVEL NECESSÁRIO É DIFE--	RENTE
	else if(!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] > $nivel_necessario)) {
		session_destroy();
		echo "Acesso NEGADO!!!<br><br>";
		header("Location: index.php"); 
		exit;
	}
?>