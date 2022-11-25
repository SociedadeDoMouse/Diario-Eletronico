<?php
$min = (int) $_GET['id_min'];


$sql = "delete from ministra where id_ministra = $min;"; 
$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if($resultado){
    header('location: \dashboard.php?page=lista_min&msg=3');
    mysqli_close($con);
}else{
    header('Location: \dashboard.php?page=lista_min&msg=4');
    mysqli_close($con);
}

?>
