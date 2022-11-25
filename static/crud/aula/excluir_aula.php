<?php
$aula = (int) $_GET['id_aula'];


$sql = "delete from aula where id_aula = $aula;"; 
$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if($resultado){
    header('location: \dashboard.php?page=lista_ano&msg=3');
    mysqli_close($con);
}else{
    header('Location: \dashboard.php?page=lista_ano&msg=4');
    mysqli_close($con);
}

?>
