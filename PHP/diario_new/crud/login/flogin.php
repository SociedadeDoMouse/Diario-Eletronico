<div class="page-wrapper flex-row align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <form action="validacao.php" method="post" class="col-lg-8"> 
                        <div class="card p-4">
                            <?php 
                                include "base/ch_pages.php";
                                include "crud/login/msglogin.php"
                            ?>
                            <div class="row">
                                <div class="col-md-5 mt-3 title-login">
                                    <img src="build/images/rato.png" width="40%" class="img-fluid logo" />
                                    <div class="card-header text-center text-white text-uppercase h3 font-weight-dark">MOUSE</div>
                                    <h5 class="text-center" style="margin-top:5px;">LOGIN</h5>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-control-label">Usuário</label>
                                            <input type="text" id="usuario" name="usuario" class="form-control form-inline">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label">Senha</label>
                                            <input type="password" id="senha" name="senha" class="form-control">
                                        </div>
                                    </div>
                                    <div class="card-footer justify-content-center">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-3">
                                                <button type="submit" class="btn btn-outline-success px-5 ">Login</button>
                                            </div>
                                            <div class="col-md-1 col-sm-1"> </div>
                                            <div class="col-md-6 col-sm-5">
                                            <a href="index.php?page=fesqsenha" type="button" class="btn btn-outline-primary">Esqueci minha senha</a>
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