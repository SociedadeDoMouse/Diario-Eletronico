<?php
$disc = (int) $_GET['id_disc'];


$sql = "delete from disciplina where id_disc = $disc;"; 
$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if($resultado){
    header('location: \dashboard.php?page=lista_disc&msg=3');
    mysqli_close($con);
}else{
    header('Location: \dashboard.php?page=lista_disc&msg=4');
    mysqli_close($con);
}

?>
