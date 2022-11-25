<!-- <form action="base/functions/esqueci.php" method="post">   -->

        <?php 
            include "base/ch_pages.php";
        ?>

        <!-- <div class="row login-box   " style="padding:0; margin:0; height:100%;">
            <div class="card col-md-5">

                <div class="card-title">
                    <h1><img src="build/img/logo.png" alt="" width="60px"></h1>
                    <h3>RECUPERAR</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-control-label">Digite seu email: </label>
                        <input type="text" id="email" name="email" class="form-control form-inline">
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



<form action="base/functions/esqueci.php" method="post" > 


    <div class="card">


        <div class="row" style="padding:0; margin:0; height:100%;">

            <div class="card-left col-md-7">
                <div class="logoArea">
                    <img src="build/img/logo_gray.svg">

                    <hr>

                    <div class="bannerTitle">
                        <h1>
                            Seja
                            <br>
                            Bem-Vindo
                        </h1>
                    </div>

                    <div style="position: absolute;bottom: 0; left:5%; text-align:center;">
                    
                    <hr>

                    <div class="alert alert-dark" role="alert">
                        Caso não tenha login, entre em contato com a direção para realizar o cadastro.
                    </div>
                </div>

                </div>
            </div>
            <div class="card-right col-md-5">

                <div class="card-title">
                    <h3>ESQUECI</h3>
                </div>

                <hr>

                <div class="card-body">

                     <div class="form-group">
                        <input type="text" id="email" name="email" class="form-control form-inline" placeholder="Email">
                    </div>
                    
                    <div class="row justify-content-center" style="	text-align: center;">
                        <div class="col-md-10 col-sm-3">
                            <button type="submit" class="login-submit">Enviar</button>
                        </div>

                        <a style="margin-top: 3%;" href="index.php"> <i class="fa-solid fa-right-to-bracket"></i> Fazer Login</a>
                    </div>
                    <?php  include "crud/login/msglogin.php" ?>
                </div>


            </div>  

        </div>
    </div>  
</form>

<style>