<?php
$cod = $_GET['cod'];;
$senha = $_POST['senha'];

//Conecta no banco de dados

$mysql = mysqli_connect('localhost','root','');
mysqli_select_db($mysql,'diario');

//Atualiza

$sql = "SELECT `email` FROM `troca_de_senha` WHERE `codigo` = '".$cod."'";
$query = mysqli_query($mysql,$sql);
$dados = mysqli_fetch_assoc($query);

$sql2 = "UPDATE `login` SET `senha` = '$senha' WHERE `email` ='".$dados['email']."'";
$query2 = mysqli_query($mysql,$sql2);

$sql3 = "DELETE FROM `troca_de_senha` WHERE `codigo` = '$cod'";
$query3 = mysqli_query($mysql,$sql3);

if(mysqli_num_rows($query)==1){

echo "Senha modificada com sucesso!";
}else{
    echo "Seu código de recuperação expirou, por favor solicite a troca de senha novamente.";
}
?>