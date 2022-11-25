<?php 
    //Importar PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\OAuth;
    //Alias the League Google OAuth2 provider class
    use League\OAuth2\Client\Provider\Google;

    $cod = uniqid(rand());

    $email = $_POST['email'];
    
    //Importar PHPMailer

    require '../../vendor/autoload.php';
    
    
    //Conecta no banco de dados
    
    $mysql = mysqli_connect('localhost','root','');
    mysqli_select_db($mysql,'diario_new');
    
    //Recebe dados
    
    $sql = "SELECT `id_usur`, `usuario`, `email`, `ativo` FROM `usuario` WHERE (`email` = '".$email."') AND (`ativo` = 1)";
    $query = mysqli_query($mysql,$sql);
    $data = mysqli_fetch_assoc($query);

    $id_usur = $data['id_usur'];

    $sql2 = "SELECT `data_rec` FROM `rec_conta` WHERE (`id_usur` = $id_usur)";
    $query2 = mysqli_query($mysql,$sql2);
    
    //Verifica se o Email existe
    
    if(mysqli_num_rows($query)==1 && mysqli_num_rows($query2)==0){
        //Verifica se há error  
        try { 
    
        //Cria nova instancia
        
        $mail = new PHPMailer;

        //Definir caracteres látinos
        
        $mail->CharSet = 'UTF-8';
        
        //Usar SMTP (Simple Mail Transfer Protocol)
        
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';
        
        //Número da porta SMTP
        
        $mail->Port = 587;
        
        //Define o sistema de criptografia
        
        $mail->SMTPSecure = 'tls';
        
        //autenticação SMTP
        
        $mail->SMTPAuth = true;
        
        //OAUTH
        $mail->AuthType = 'XOAUTH2';
        $email = "mousessmails@gmail.com";
        $clientId = "595206911534-31ksioprr7k8h1o22eq02m7i7m3087vr.apps.googleusercontent.com";
        $clientSecret = "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";
        $refreshToken = "1//0hYCUXmHfc2z-CgYIARAAGBESNwF-L9Irvw1HyhCVds-DwGUsnOroPi7Vyv1O4_wMTfuKdERLKFwde5kING4xmrHGiQt45eQnES4";
        
        $provider = new Google(
            [
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
            ]
        );

        $mail->setOAuth(
            new OAuth(
                [
                    'provider' => $provider,
                    'clientId' => $clientId,
                    'clientSecret' => $clientSecret,
                    'refreshToken' => $refreshToken,
                    'userName' => $email,
                ]
            )
        );
        
        //Email que vai enviar
        
        $mail->Username = "mousessmails@gmail.com";
        
        //Senha do Email
        
        $mail->Password = 'mousess3151';
        
        //Remetente
        
        $mail->setFrom('mousessmails@gmail.com', 'MouseSS');
        
        //Destinatário
        
        $mail->addAddress($data['email'], $data['usuario']);
        
        //Assunto
        
        $mail->Subject = 'Recuperação de senha - Diário Eletrônico';

        
        
        //Anexar imagem
        
        //$mail->addAttachment('');
        
        //Corpo do Email
        
        $mail->Body = 'Olá, '.$data['usuario'].'
        Você solicitou alteração de sua senha.
        
        Clique no link abaixo para alterá-la. Caso não tenha realizado tal solicitação, por favor, desconsidere esse e-mail.
        static/index.php?page=ftrocasenha&cod='.$cod.'

        Atenciosamente,
        Equipe MouseSS';   
        
            if (!$mail->send()) {
                echo $mail->ErrorInfo;
            } else {
                //Insere dados
                $insert = "INSERT INTO `rec_conta` (`id_usur`, `cod_rec`, `data_rec`) VALUES ($id_usur, '$cod', current_timestamp());";
                $queryinsert = mysqli_query($mysql,$insert);

                header("Location: \index.php?msg=2");
            }

            //Enviar e verificar se há errors
            }catch(Exception $e){
                header("Location: \index.php?msg=3");
            }  
    }else if(mysqli_num_rows($query2)!=0){
        header("Location: \index.php?msg=4");
    }else{
        header("Location: \index.php?msg=6");
    }
?> 