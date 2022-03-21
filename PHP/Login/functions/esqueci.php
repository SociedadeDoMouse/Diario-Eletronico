<?php 
    //Importar PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    $cod = uniqid(rand());
    $email = $_POST['email'];
    
    //Importar PHPMailer

    
    require 'PHPMailer-master/src/PHPmailer.php';
    require 'PHPMailer-master/src/SMTP.php';
    require 'PHPMailer-master/src/Exception.php';
    
    //Conecta no banco de dados
    
    $mysql = mysqli_connect('localhost','root','');
    mysqli_select_db($mysql,'diario');
    
    //Recebe dados
    
    $sql = "SELECT `usuario`, `email`, `ativo` FROM `login` WHERE (`email` = '".$email."') AND (`ativo` = 1)";
    $query = mysqli_query($mysql,$sql);
    $dados = mysqli_fetch_assoc($query);

    $sql2 = "SELECT `data` FROM `troca_de_senha` WHERE (`email` = '".$email."')";
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
        
        //Email que vai enviar
        
        $mail->Username = "mousessmails@gmail.com";
        
        //Senha do Email
        
        $mail->Password = 'SENHA';
        
        //Remetente
        
        $mail->setFrom('mousessmails@gmail.com', 'MouseSS');
        
        //Destinatário
        
        $mail->addAddress($dados['email'], $dados['usuario']);
        
        //Assunto
        
        $mail->Subject = 'Recuperação de senha - Diário Eletrônico';

        
        
        //Anexar imagem
        
        //$mail->addAttachment('');
        
        //Corpo do Email
        
        $mail->Body = 'Olá, '.$dados['usuario'].'
        Você solicitou alteração de sua senha.
        Clique no link abaixo para alterá-la. Caso não tenha realizado tal solicitação, por favor, desconsidere esse e-mail.
        26.89.240.80/login/recuperarform.php?cod='.$cod.'
        Atenciosamente,
        Equipe MouseSS';   
        
            if (!$mail->send()) {
                error($mail->ErrorInfo);
            } else {
                //Insere dados
                $inserir = "INSERT INTO `troca_de_senha` (`email`, `codigo`, `data`) VALUES ('$email', '$cod', current_timestamp());";
                $queryinserir = mysqli_query($mysql,$inserir);

                echo  "<div class='alerta row fields col-md-8 alert alert-success' id='confirmRes'>Email enviado com sucesso! verifique seu email.</div>";
            }

            //Enviar e verificar se há errors
            }catch(Exception $e){
                error("Algo deu errado, por favor tente novamente.");
            }  
    }else if(mysqli_num_rows($query2)!=0){
        error("A recuperação de senha já foi solicitado para este email.");
    }else{
        error("Email não encontrado! verifique se está correto.");
    }
    //Capturar error
    
    //Enviar mensagem de error
    function error($e){
        echo "<div class='alerta row fields col-md-8 alert alert-danger' id='confirmRes'>$e</div>";
    }

    
?> 