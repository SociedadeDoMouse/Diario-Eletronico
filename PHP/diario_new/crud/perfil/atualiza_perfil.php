<?php
$id		  		= $_SESSION['UsuarioID'];
$nome 			= $_POST["nome"];
$usuario		= $_POST["usuario"];

$sql = "update usuario set ";
$sql .= " usuario= '$usuario', nome= '$nome'";
$sql .= " where id_usur = '".$id."';";

$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if($resultado){
	header('Location: \diario_new/dashboard.php?page=myperfil&msg=1');
    mysqli_close($con);
}

?>
