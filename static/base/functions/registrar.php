<?php

    function reg($txt){

        if ($_SESSION['UsuarioNivel'] == 5) {
            $nome = "Prof ".$_SESSION['UsuarioNome'];
        }else{
            $nome = $_SESSION['UsuarioNome'];
        }

        $sql = "insert into mensagem values ";
        $sql .= "(0,'".$nome.$txt."', 3, current_timestamp ,'".$_SESSION['UsuarioID']."');";
    
        $resultado = mysqli_query($GLOBALS['con'], $sql)or die(mysqli_error());    
    }

?>