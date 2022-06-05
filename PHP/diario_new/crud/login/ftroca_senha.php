<?php 
            $cod = $_GET['cod'];
            $_SESSION['cod'] = $cod;
?>

<div class="page-wrapper flex-row align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <form action="base/functions/recuperar.php" method="post" class="col-lg-8"> 
                    <div class="card p-4">
                        <?php 
                             include "crud/login/msglogin.php"
                        ?>
                        <div class="row">
                            <div class="col-md-5 mt-3 title-login">
                                <img src="build/images/rato.png" width="40%" class="img-fluid logo" />
                                <div class="card-header text-center text-white text-uppercase h3 font-weight-dark">MOUSE</div>
                                <h5 class="text-center" style="margin-top:5px;">TROCAR SENHA</h5>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-control-label">Senha nova</label>
                                        <input type="text" id="senha" name="senha" class="form-control form-inline">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Confirmar senha</label>
                                        <input type="text" id="csenha" name="csenha" class="form-control">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-3">
                                            <button type="submit" class="btn btn-outline-success px-5 ">Enviar</button>
                                        </div>
                                        
                                        <div class="col-md-8 col-sm-6">
                                        <a href="index.php" type="button" class="btn btn-outline-primary">Logar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
