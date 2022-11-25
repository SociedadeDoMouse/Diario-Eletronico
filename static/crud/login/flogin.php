<div class="alerta" style="width:80vw;margin-left:10vw; margin-top:-13vh;position:absolute;">
<?php 
    include "base/ch_pages.php";
?>
</div>


<form action="validacao.php" method="post" > 


    <div class="card">

        
        
        <div class="row" style="padding:0; margin:0; height:100%;">

            <div class="card-left col-md-7">
                
                <div class="logoArea">
                    <img src="build/img/logo_gray.svg">

                    <hr>

                    <div class="bannerTitle">
                        <h1>
                            Bem-Vindo!
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
                    <h3>LOGIN</h3>
                </div>

                <hr>
                

                <div class="card-body">
                    <div class="form-group">
						<input type="text" id="usuario" name="usuario" class="form-control shadow-sm form-inline" placeholder="Usuário">
					</div>
					<div class="form-group">

						<input type="password" id="senha" name="senha" class="form-control shadow-sm" placeholder="Senha">
					</div>
                    
                    <div class="row justify-content-center" style="	text-align: center;">
                        <div class="col-md-10 col-sm-3">
                            <button type="submit" class="login-submit">Login</button>
                        </div>

                        <a style="margin-top: 3%;" href="index.php?page=fesqsenha"> <i class="fa-solid fa-lock"></i> Esqueceu a senha?</a>
                    </div>
                    <?php  include "crud/login/msglogin.php" ?>
                </div>


            </div>

        </div>
    </div>  
</form>