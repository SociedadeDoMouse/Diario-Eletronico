<?php

//Recebe dados do formulário

$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

//Conecta no banco de dados

$mysql = mysqli_connect('localhost','root','');
mysqli_select_db($mysql,'diario');

//Recebe dados

$sql = "SELECT `senha`, `nome`, `nivel`, `ativo` FROM `login` WHERE (`usuario` = '".$usuario."') AND (`senha` = '".$senha."') AND (`ativo` = 1)";
$query = mysqli_query($mysql,$sql);
$dados = mysqli_fetch_assoc($query);

//Saída

if(mysqli_num_rows($query)==1){

    //Verifica se é professor ou admin
    if($dados['nivel'] == 2){
        $nivel = "Admin";
    }else{
        $nivel = "Professor";
    }

    echo "Bem-vindo, ".$nivel." ".$dados['nome'];
}else{
    echo "USUÁRIO OU SENHA INVALIDO";
}
?>