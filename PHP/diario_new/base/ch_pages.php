<?php
    if(isset($_GET['page'])){

        switch ($_GET['page']) {
            case 'home':
                include 'dashboard.php';
                break;

             // ---- PERFIL ----///    
            case 'view_perfil':
                include 'crud/perfil/view_perfil.php';
                break;
            case 'fedit_perfil':
                include 'crud/perfil/fedit_perfil.php';
                break;
            case 'atualiza_perfil':
                include 'crud/perfil/atualiza_perfil.php';
                break;

            // ---- ALUNOS ----///
            case 'lista_alu':
                include "crud/alunos/lista_alu.php";
                break;
            
            case 'fadd_alu':
                include "crud/alunos/fadd_alu.php";
                break;
            
            case 'insere_alu':
                include "crud/alunos/insere_alu.php";
                break;
            
            case 'fedita_alu':
                include "crud/alunos/fedita_alu.php";
                break;
                
            case 'view_alu':
                include "crud/alunos/view_alu.php";
                break;
            
            case 'excluir_alu':
                include "crud/alunos/excluir_alu.php";
                break;
            
            case 'atualiza_alu':
                include "crud/alunos/atualiza_alu.php";
                break;
            // ---- USUÁRIOS ----///
            case 'lista_usu':
                include "crud/usuarios/lista_usu.php";
                break;
            
            case 'fadd_usu':
                include "crud/usuarios/fadd_usu.php";
                break;
            
            case 'insere_usu':
                include "crud/usuarios/insere_usu.php";
                break;
            
            case 'fedita_usu':
                include "crud/usuarios/fedita_usu.php";
                break;
                
            case 'view_usu':
                include "crud/usuarios/view_usu.php";
                break;
            
            case 'atualiza_usu':
                include "crud/usuarios/atualiza_usu.php";
                break;
            
            case 'block_usu':
                include "crud/usuarios/block_usu.php";
                break;
            
            case 'ativa_usu':
                include "crud/usuarios/ativa_usu.php";
                break;
                // ---- Documento ----///

            case 'lista_doc':
                include "crud/documento/lista_doc.php";
                break;

            case 'excluir_doc':
                include "crud/documento/excluir_doc.php";
                break;
            
            case 'fadd_doc':
                include "crud/documento/fadd_doc.php";
                break;
            
            case 'insere_doc':
                include "crud/documento/insere_doc.php";
                break;
            
            case 'fedita_doc':
                include "crud/documento/fedita_doc.php";
                break;
                
            case 'view_doc':
                include "crud/documento/view_doc.php";
                break;
            
            case 'atualiza_doc':
                include "crud/documento/atualiza_doc.php";
                break;
            
            case 'block_doc':
                include "crud/documento/block_doc.php";
                break;
            
            case 'ativa_doc':
                include "crud/documento/ativa_doc.php";
                break;


        }
    }
?>