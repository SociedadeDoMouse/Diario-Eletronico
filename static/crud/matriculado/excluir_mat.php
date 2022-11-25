<?php
$mat = (int) $_GET['id_mat'];


$sql = "delete from frequencia where id_mat = $mat;"; 
$resultado = mysqli_query($con, $sql)or die(mysqli_error());

$sql2 = "delete from matriculado where id_mat = $mat;"; 
$resultado2 = mysqli_query($con, $sql2)or die(mysqli_error());

if($resultado2){
    header('location: \dashboard.php?page=lista_mat&msg=3');
    mysqli_close($con);
}else{
    header('Location: \dashboard.php?page=lista_mat&msg=4');
    mysqli_close($con);
}

?>
