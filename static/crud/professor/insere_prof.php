<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";

    $id 		= $_GET["id_usur"];
    $mat		= $_GET["mat"];

	 $sql = 'insert into professor (mat_prof, id_usur) values ';
	 $sql .= "('".$mat."','".$id."');";
	 $resultado = mysqli_query($con, $sql) or die(mysqli_error($con));
	 mysqli_close($con);

?>