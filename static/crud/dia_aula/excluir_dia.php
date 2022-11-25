<?php
$id = (int) $_GET['id'];
$id_min = (int) $_GET['id_min'];


$sql = "delete from data_aula where id_diaaula = $id;"; 
$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if($resultado){
    header('location: \dashboard.php?page=lista_dia&id='.$id_min.'&modal=detalhar&msg=3');
    mysqli_close($con);
}else{
    header('Location: \dashboard.php?page=lista_dia&msg=4');
    mysqli_close($con);
}

?>
