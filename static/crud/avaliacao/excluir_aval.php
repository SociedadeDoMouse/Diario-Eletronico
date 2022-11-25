<?php
$aval = (int) $_GET['id_aval'];


$sql = "delete from avaliacao where id_aval = $aval;"; 
$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if($resultado){
    header('location: \dashboard.php?page=lista_aval&msg=3');
    mysqli_close($con);
}else{
    header('Location: \dashboard.php?page=lista_aval&msg=4');
    mysqli_close($con);
}

?>
