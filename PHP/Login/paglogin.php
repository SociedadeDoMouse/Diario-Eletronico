<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="css/pag.css">
  </head>
  <body>
          <div class="loginbox  ">
                <form action="functions/login.php" name="formlogin" method="post">
                
                    <h3>LOGIN</h3>
                    <hr>


                        <div class="row fields">
                          <span class="col-md-2 col-sm-2 col-xs-2 userpass"><img class="img-fluid" src="imgs/user.png"></span>
                          <input class="col-md-9 col-sm-8 col-xs-8" type="text" maxlength="15" placeholder="Usuário" name="usuario" required>
                        </div>

                        <div class="row fields">
                          <span class="col-md-2 col-sm-2 col-xs-2 userpass "><img  class="img-fluid" src="imgs/password.png"></span>
                          <input class="col-md-9 col-sm-8 col-xs-8" type="password" id="inppassword" maxlength="15" placeholder="Senha" name="senha" onkeyup="mascpass()" required> 
                          <span class="col-md-1 col-sm-2 col-xs-2"><img onclick="seepass()" src="imgs/openeye.png" class="eye" id="eyeimg"></span>
                        </div>

                        <div class="row fields">
                          <a href="esqueciForm.php" class="col-md-12"><p>Esqueci minha senha</p></a>
                          <input type="submit" class="col-md-6 btn btn-info" value="Login">
                        </div>


                        


                </form>
            </div>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/login.js"></script>
    <script src=""> new WOW().init();</script>
  </body>
</html>
