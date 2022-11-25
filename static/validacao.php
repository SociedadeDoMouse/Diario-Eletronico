<?php
// Verifica se houve POST e se o usuário ou a senha estão vazios
if (!empty($_POST) and (empty($_POST['usuario']) or empty($_POST['senha']))) {
	header("Location: index.php"); exit;
}
// Tenta se conectar ao servidor MySQL e ao DB
$con = mysqli_connect('localhost', 'root', '', 'diario_new') or trigger_error(mysqli_error());

$usuario = mysqli_real_escape_string($con, $_POST['usuario']);
$senha = mysqli_real_escape_string($con, $_POST['senha']);


// Validação do usuário/senha digitados
$sql  = "select id_usur, usuario, nome, funcao, nome_func from usuario INNER JOIN funcao ON funcao.id_func = USUARIO.funcao where usuario = '". $usuario ."' ";
$sql .= "and (senha = '".sha1($senha)."') and (ativo = 1) limit 1";

$query = mysqli_query($con, $sql);
// Salva os dados encontados na variável $resultado
$resultado = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) != 1) {
	// Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
	header('Content-Type: text/html; charset=utf-8');
	header("Location: index.php?msg=1");
	
}
else {
	
////// 4.0 - Salvando os dados na sessão do PHP ////////

	// Se a sessão não existir, inicia uma
	if (!isset($_SESSION)) session_start();

	// Salva os dados encontrados na sessão
	$_SESSION['UsuarioID'] = $resultado['id_usur'];
	$_SESSION['UsuarioUser'] = $resultado['usuario'];
	$_SESSION['UsuarioNome'] = $resultado['nome'];
	$_SESSION['UsuarioNivel'] = $resultado['funcao'];
	$_SESSION['UsuarioFuncao'] = $resultado['nome_func'];

	// Redireciona o visitante
	switch($_SESSION['UsuarioNivel']){
		case 1: header("Location: dashboard.php"); exit;break;
		case 2: header("Location: dashboard.php"); exit;break;
		case 3: header("Location: dashboard.php"); exit;break;
		case 4: header("Location: dashboard.php"); exit;break;
		case 5: header("Location: dashboard.php"); exit;break;
		case 6: header("Location: dashboard.php"); exit;break;
	}
}

?>