<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="build/css/login-style.css">
    <link rel="shortcut icon" href="build/img/logo_gray.svg" type="image/x-icon">
</head>
<body>
    <?php session_start(); 

        if(isset($_SESSION['UsuarioNome'])){header("Location: dashboard.php");} 

            else if(!isset($_GET['page'])){
                echo include "crud/login/flogin.php";
                echo "<title>Login</title>";
            }else if($_GET['page'] == 'fesqsenha'){
                echo include "crud/login/fesq_senha.php";
                echo "<title>Recuperação</title>";
            }else if($_GET['page'] == 'ftrocasenha'){
                echo include "crud/login/ftroca_senha.php";
                echo "<title>Troca de Senha</title>";
            }

    ?>
    

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js'></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="build/js/app.js"></script>

</body>
</html>


