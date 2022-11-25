<?php
$id = (int) $_POST['id'];


$sql = "delete from mensagem where id_msg = $id;"; 
$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if($resultado){
    header('location: \dashboard.php?page=lista_alerta&msg=3');
    mysqli_close($con);
}else{
    header('Location: \dashboard.php?page=lista_alerta&msg=4');
    mysqli_close($con);
}

?>
