<!-- <?php 
    $cod = $_GET['cod'];
    $_SESSION['cod'] = $cod;

    if(!isset($cod)){
        header("Location: index.php");
    }
?>

    <form action="base/functions/recuperar.php" method="post"> 
    <div class="card">
        <?php 
            include "base/ch_pages.php";
            include "crud/login/msglogin.php";
        ?>

        <div class="row" style="padding:0; margin:0; height:100%;">

            <div class="card-left col-md-7">
                <div class="card-left-background">
                    
                </div>
            </div>
            <div class="card-right col-md-5">

                <div class="card-title">
                    <h1><img src="build/img/logo.png" alt="" width="60px"></h1>
                    <h3>TROCAR SENHA</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-control-label">Senha nova</label>
                        <input type="text" id="senha" placeholder="senha" name="senha" class="form-control form-inline">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Confirmar senha</label>
                        <input type="text" id="csenha" name="csenha" class="form-control">
                    </div>
                        
                    <div class="row justify-content-center">
                        <a href="index.php">Fazer login</a>
                        <div class="col-md-10 col-sm-3">
                            <button type="submit" class="login-submit">Enviar</button>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
</form>     -->


<div class="alerta" style="width:80vw;margin-left:10vw; margin-top:-13vh;position:absolute;">
<?php 
    include "base/ch_pages.php";
?>
</div>


<form action="base/functions/recuperar.php" method="post" > 


    <div class="card">

        
        
        <div class="row" style="padding:0; margin:0; height:100%;">

            <div class="card-left col-md-7">
                
                <div class="logoArea">
                    <img src="build/img/logo_gray.svg">

                    <hr>

                    <div class="bannerTitle">
                        <h1>
                            Recuperar
                        </h1>
                    </div>

                    <div style="position: absolute;bottom: 0; left:5%; text-align:center;">
                    <hr>

                    <div class="alert alert-dark" role="alert" style="max-width:100%; margin:auto;">
                        Caso não tenha login, entre em contato com a direção para realizar o cadastro.
                    </div>
                </div>

                </div>
            </div>
            
            <div class="card-right col-md-5">

                <div class="card-title">
                    <h3>TROCAR SENHA</h3>
                </div>

                <hr>
                

                <div class="card-body">
                    <div class="form-group">
                        <input type="text" id="senha" placeholder="Senha" name="senha" class="form-control form-inline">
                    </div>
                    <div class="form-group">
                        <input type="text" id="csenha" name="csenha" placeholder="Senha" class="form-control">
                    </div>
                        

                    <div class="row justify-content-center" style="	text-align: center;">
                        <div class="col-md-10 col-sm-3">
                            <button type="submit" class="login-submit">Enviar</button>
                        </div>

                        <a href="index.php">Fazer login</a>
                    </div>

                    <?php  include "crud/login/msglogin.php" ?>
                </div>

            </div>

        </div>
    </div>  
</form>