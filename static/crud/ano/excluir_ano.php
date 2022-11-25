<?php
$ano = (int) $_GET['id_ano'];


$sql = "delete from ano_letivo where id_ano = $ano;"; 
$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if($resultado){
    header('location: \dashboard.php?page=lista_ano&msg=3');
    mysqli_close($con);
}else{
    header('Location: \dashboard.php?page=lista_ano&msg=4');
    mysqli_close($con);
}

?>
