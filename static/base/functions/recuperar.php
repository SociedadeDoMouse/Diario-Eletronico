<?php
session_start();
$cod = $_SESSION['cod'];
$password = $_POST['senha'];
$cpassword = $_POST['csenha'];

if($password != $cpassword){
    header("Location: index.php?page=ftrocasenha&msg=8&cod=$cod");
}else{

    //Conecta no banco de dados

    $mysql = mysqli_connect('localhost','root','');
    mysqli_select_db($mysql,'diario_new');

    //Atualiza

    $sql = "SELECT `id_usur` FROM `rec_conta` WHERE `cod_rec` = '".$cod."'";
    $query = mysqli_query($mysql,$sql);
    $data = mysqli_fetch_assoc($query);

    $sql2 = "UPDATE `usuario` SET `senha` = '".sha1($password)."' WHERE `id_usur` ='".$data['id_usur']."'";
    $query2 = mysqli_query($mysql,$sql2);

    $sql3 = "DELETE FROM `rec_conta` WHERE `cod_rec` = '$cod'";
    $query3 = mysqli_query($mysql,$sql3);

    if(mysqli_num_rows($query)==1){
        header("Location: \index.php?msg=7");
    }else{
        header("Location: \index.php?page=fesqsenha&msg=11");
    }
}
?>