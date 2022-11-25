<?php
$id		  		= $_SESSION['UsuarioID'];
$nome 			= $_POST["nome"];
$usuario		= $_POST["usuario"];
$email		    = $_POST["email"];
$img            = $_FILES['img'];


$arquivo = pathinfo($_FILES['img']['name']);
$arquivo = "user$id.".$arquivo['extension'];
    
//diretorio dos arquivos
$pasta_dir = "crud/perfil/perfils_img/";

// Faz o upload da imagem
$arquivo_nome = $pasta_dir.$arquivo;



//salva no banco
move_uploaded_file($_FILES["img"]['tmp_name'], $arquivo_nome);

$sql = "update usuario set ";

if(isset($img) != ''){
    $sql .= " usuario= '$usuario', nome= '$nome', email= '$email', foto = '".$arquivo."'";
}
else{
    $sql .= " usuario= '$usuario', nome= '$nome', email= '$email'";
}

$sql .= " where id_usur = '".$id."';";

$resultado = mysqli_query($con, $sql)or die(mysqli_error());

if($resultado){
	header("Location: \dashboard.php?page=view_perfil&msg=1&sla=$arquivo_nome");
    mysqli_close($con);
}



?>
