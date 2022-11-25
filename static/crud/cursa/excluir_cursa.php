<?php
$cursa = (int) $_POST['id_cursa'];


$sql = "delete from cursa where id_cursa = $cursa;"; 
$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if($resultado){
    header('location: \dashboard.php?page=lista_cursa&msg=3');
    mysqli_close($con);
}else{
    header('Location: \dashboard.php?page=lista_cursa&msg=4');
    mysqli_close($con);
}

?>
