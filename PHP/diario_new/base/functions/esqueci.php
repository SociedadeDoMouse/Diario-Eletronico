z<?php 
    //Importar PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    $cod = uniqid(rand());

    $email = $_POST['email'];
    
    //Importar PHPMailer

    require '../vendor/autoload.php';
    
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
        
        //Email que vai enviar
        
        $mail->Username = "coloque seu email aqui";
        
        //Senha do Email
        
        $mail->Password = 'senha do email acima';
        
        //Remetente
        
        $mail->setFrom('coloque seu email aqui', 'MouseSS');
        
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
        http://localhost/diario_new/index.php?page=ftrocasenha&cod='.$cod.'

        Atenciosamente,
        Equipe MouseSS';   
        
            if (!$mail->send()) {
                error($mail->ErrorInfo);
            } else {
                //Insere dados
                $insert = "INSERT INTO `rec_conta` (`id_usur`, `cod_rec`, `data_rec`) VALUES ($id_usur, '$cod', current_timestamp());";
                $queryinsert = mysqli_query($mysql,$insert);

                header("Location: \diario_new/index.php?msg=2");
            }

            //Enviar e verificar se há errors
            }catch(Exception $e){
                header("Location: \diario_new/index.php?msg=3");
            }  
    }else if(mysqli_num_rows($query2)!=0){
        header("Location: \diario_new/index.php?msg=4");
    }else{
        header("Location: \diario_new/index.php?msg=6");
    }
?> 