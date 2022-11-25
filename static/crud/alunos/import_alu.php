<?php 

$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador',
);
    include "base/testa_nivel.php";
?>

<style>

@media screen and (max-width:1000px) {

    .templateexcl{
        width:300px;
    }

}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> 
    <div id="main" class="container-fluid mt-5">
        <div class="row">
            <div class="col">
                <form enctype="multipart/form-data" action="dashboard.php?page=inserexls_alu" method="POST">
                <div class="custom-file">
                    <input class="form-control " type="hidden" name="MAX_FILE_SIZE" value="30000"/>
                    <input type="file" class="custom-file-input" name="userfile" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Escolher arquivo</label>
                </div>

                <br>
                <hr>
                <h3>Baixe o template do excel -  <a href="../../docs/Planilhas_de_alunos_template.xlsx" download=""> <i class="fa-solid fa-download"></i> Template Excel  </a> </h3>
                <img class="templateexcl" src="../../build/img/templateplanilha.svg" alt="">

                
            </div>
            <div class="col">
                <input  class="btn btn-success" type="submit" value="Enviar arquivo" name="enviar"/>
            </div>
        </div>
    </form>
            
        
    </div>
</body>
</html>