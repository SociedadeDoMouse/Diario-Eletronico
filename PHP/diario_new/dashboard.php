<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="icon" href="images/favicon.ico" type="image/ico" />
    <link rel="stylesheet" href="build/css/custom.css">

    <title> Diário </title>
    
    <?php session_start(); if(!isset($_SESSION['UsuarioNome'])){	header("Location: index.php"); exit;} include "base/head.php"; include "base/connect_crud.php"; $nv = $_SESSION['UsuarioNivel'];?>
  </head>

  <body class="nav-sm">
    <div class="container body">
      <div class="main_container ">
        
        <!-- Page content -->
         <div class="right_col mt-0 content" style="height:100vh;width:100vw - 22%;" role="main">
            <div class="row" style="display:block;">
              <div class="col-md-12 volum_content">
                <?php include "base/ch_pages.php"; ?>
              </div>
            </div>
          </div>
              
          
          <!-- Top navigation and Sidebar -->
          <div style="position:absolute;top:0;width:100vw;">
            <?php include "base/topnavigation.php"?>
            <?php include "base/sidebar.php"?>
          </div>
        </div>
      </div>

   <?php include "base/scripts.php"?>

  </body>
</html>
