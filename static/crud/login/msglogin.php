<?php 
if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
    switch($msg){

        //REFERENTE AO FORM DE LOGIN
        case 1:
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Usuário ou senha incorretos ou inexistentes! <br> (Caso ache que tenha algo de errado, entre em contato com o administrador)
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            break;

            // REFERENTE AO FORM DE ENVIAR EMAIL
        case 2:
            echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">Email enviado com sucesso!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            break;

        case 3:
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Algo deu errado tente novamente!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            break;

        case 4:
            echo '<div class="alert alert-info alert-dismissible fade show" role="alert">A solitação já foi enviada a este email!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            break;

        case 5:
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Email não encontrado verifique!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            break;

        case 6:
            echo '<div class="alert alert-dark alert-dismissible fade show" role="alert">Insira um email válido!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            break;

            // REFERENTE AO FORM DE TROCAR SENHA
        case 7:
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">Senha alterada com sucesso!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            break;
        case 8:
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">As senhas não correspondem!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            break;
        case 10:
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"> Você não tem nivel de acesso!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            break;
        case 11:
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">Seu código de recuperação, expirou. Por favor reenvie a solicitação!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
            break;
    }
    $msg = 0;
}
?>