<?php
	if(!isset($_SESSION)) session_start();
	
	// SE FOR ARRAY, IRA VERIFICAR SE O USUARIO NIVEL EXISTE NA ARRAY
	if(is_array($nivel_necessario)){

		if (array_key_exists($_SESSION['UsuarioNivel'], $nivel_necessario) != true) {
			header("Location: "."$_SERVER[HTTP_REFERER]"."&msg=10");
		}
	}
	
	//SE NÃO FOR ARRAY VAI VER SE O NIVEL NECESSÁRIO É DIFERENTE
	else if(!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] != $nivel_necessario)) {
		header("Location: "."$_SERVER[HTTP_REFERER]"."&msg=10");
	}
?>
