<?php
$cont = (int) $_GET['id_cont'];


$sql = "delete from conteudo where id_cont = $cont;"; 
$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if($resultado){
    header('location: \dashboard.php?page=lista_cont&msg=3');
    mysqli_close($con);
}else{
    header('Location: \dashboard.php?page=lista_cont&msg=4');
    mysqli_close($con);
}

?>
