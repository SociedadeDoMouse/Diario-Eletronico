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

            case 'import_alu':
                include "crud/alunos/import_alu.php";
                break;

            case 'inserexls_alu':
                include "crud/alunos/inserexls_alu.php";
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

                // ---- PROFESSOR  ----///
            case 'lista_prof':
                include "crud/professor/lista_prof.php";
                break;
            case 'fadd_prof':
                include "crud/professor/fadd_prof.php";
                break;
            case 'turmas_prof':
                include "crud/professor/area_prof/turmas_prof.php";
                break;

            case 'insere_prof':
                include "crud/professor/insere_prof.php";
                break;

            case 'select_cursa':
                include "crud/professor/select_cursa.php";
                break;
            
                // ---- Turma ----///

            case 'lista_turm':
                include "crud/turma/lista_turm.php";
                break;

            case 'excluir_turm':
                include "crud/turma/excluir_turm.php";
                break;
            
            case 'fadd_turm':
                include "crud/turma/fadd_turm.php";
                break;
            
            case 'insere_turm':
                include "crud/turma/insere_turm.php";
                break;
            
            case 'fedita_turm':
                include "crud/turma/fedita_turm.php";
                break;
                
            case 'view_turm':
                include "crud/turma/view_turm.php";
                break;
            
            case 'atualiza_turm':
                include "crud/turma/atualiza_turm.php";
                break;
            
            case 'block_turm':
                include "crud/turma/block_turm.php";
                break;
            
            case 'ativa_turm':
                include "crud/turma/ativa_turm.php";
                break;

                // ---- MINISTRA ----///

            case 'lista_min':
                include "crud/ministra/lista_min.php";
                break;

            case 'excluir_min':
                include "crud/ministra/excluir_min.php";
                break;
            
            case 'fadd_min':
                include "crud/ministra/fadd_min.php";
                break;
            
            case 'insere_min':
                include "crud/ministra/insere_min.php";
                break;
            
            case 'fedita_min':
                include "crud/ministra/fedita_min.php";
                break;
                
            case 'view_min':
                include "crud/ministra/view_min.php";
                break;
            
            case 'atualiza_min':
                include "crud/ministra/atualiza_min.php";
                break;
            
            case 'block_min':
                include "crud/ministra/block_min.php";
                break;
            
            case 'ativa_min':
                include "crud/ministra/ativa_min.php";
                break;

                // ---- Frequência ----///

            case 'lista_freq':
                include "crud/frequencia/lista_freq.php";
                break;

            case 'excluir_freq':
                include "crud/frequencia/excluir_freq.php";
                break;
            
            case 'fadd_freq':
                include "crud/frequencia/fadd_freq.php";
                break;
            
            case 'insere_freq':
                include "crud/frequencia/insere_freq.php";
                break;
                
            
            case 'just_freq':
                include "crud/frequencia/just_freq.php";
                break;

                           // ---- MATRICULADO  ----///
            case 'lista_mat':
                include "crud/matriculado/lista_mat.php";
                break;
            
            case 'fadd_mat':
                include "crud/matriculado/fadd_mat.php";
                break;
            
            case 'insere_mat':
                include "crud/matriculado/insere_mat.php";
                break;
            
            case 'fedita_mat':
                include "crud/matriculado/fedita_mat.php";
                break;
                
            case 'view_mat':
                include "crud/matriculado/view_mat.php";
                break;
            
            case 'atualiza_mat':
                include "crud/matriculado/atualiza_mat.php";
                break;
            
            case 'excluir_mat':
                include "crud/matriculado/excluir_mat.php";
                break;

                // ---- DISCIPLINA  ----///
            case 'lista_disc':
                include "crud/disciplina/lista_disc.php";
                break;
            
            case 'fadd_disc':
                include "crud/disciplina/fadd_disc.php";
                break;
            
            case 'insere_disc':
                include "crud/disciplina/insere_disc.php";
                break;
            
            case 'fedita_disc':
                include "crud/disciplina/fedita_disc.php";
                break;
                
            case 'view_disc':
                include "crud/disciplina/view_disc.php";
                break;
            
            case 'atualiza_disc':
                include "crud/disciplina/atualiza_disc.php";
                break;
            
            case 'excluir_disc':
                include "crud/disciplina/excluir_disc.php";
                break;
            
            case 'ativa_disc':
                include "crud/disciplina/ativa_disc.php";
                break;
        
                // ---- CURSOS  ----///
            case 'lista_curso':
                include "crud/curso/lista_curso.php";
                break;
            
            case 'fadd_curso':
                include "crud/curso/fadd_curso.php";
                break;
            
            case 'insere_curso':
                include "crud/curso/insere_curso.php";
                break;
            
            case 'fedita_curso':
                include "crud/curso/fedita_curso.php";
                break;
                
            case 'view_curso':
                include "crud/curso/view_curso.php";
                break;
            
            case 'atualiza_curso':
                include "crud/curso/atualiza_curso.php";
                break;
            
            case 'excluir_curso':
                include "crud/curso/excluir_curso.php";
                break;
            
            case 'ativa_usu':
                include "crud/curso/ativa_curso.php";
                break;
        
                // ---- CURSOS  ----///
            case 'lista_cursa':
                include "crud/cursa/lista_cursa.php";
                break;
            
            case 'fadd_cursa':
                include "crud/cursa/fadd_cursa.php";
                break;
            
            case 'insere_cursa':
                include "crud/cursa/insere_cursa.php";
                break;
            
            case 'fedita_cursa':
                include "crud/cursa/fedita_cursa.php";
                break;
                
            case 'view_cursa':
                include "crud/cursa/view_cursa.php";
                break;
            
            case 'atualiza_cursa':
                include "crud/cursa/atualiza_cursa.php";
                break;
            
            case 'excluir_cursa':
                include "crud/cursa/excluir_cursa.php";
                break;

         // ---- ANO LETIVO  ----///
            case 'lista_ano':
                include "crud/ano/lista_ano.php";
                break;
            
            case 'fadd_ano':
                include "crud/ano/fadd_ano.php";
                break;
            
            case 'insere_ano':
                include "crud/ano/insere_ano.php";
                break;
            
            case 'fedita_ano':
                include "crud/ano/fedita_ano.php";
                break;
                
            case 'view_ano':
                include "crud/ano/view_ano.php";
                break;
            
            case 'atualiza_ano':
                include "crud/ano/atualiza_ano.php";
                break;
            
            case 'excluir_ano':
                include "crud/ano/excluir_ano.php";
                break;
        
                // ---- CONTEÚDO  ----///
            case 'lista_cont':
                include "crud/conteudo/lista_cont.php";
                break;
            
            case 'fadd_cont':
                include "crud/conteudo/fadd_cont.php";
                break;
            
            case 'insere_cont':
                include "crud/conteudo/insere_cont.php";
                break;
            
            case 'fedita_cont':
                include "crud/conteudo/fedita_cont.php";
                break;
                
            case 'view_cont':
                include "crud/conteudo/view_cont.php";
                break;
            
            case 'atualiza_cont':
                include "crud/conteudo/atualiza_cont.php";
                break;
            
            case 'excluir_cont':
                include "crud/conteudo/excluir_cont.php";
                break;

                 // ---- AULA  ----///
            case 'lista_aula':
                include "crud/aula/lista_aula.php";
                break;
            
            case 'fadd_aula':
                include "crud/aula/fadd_aula.php";
                break;
            
            case 'insere_aula':
                include "crud/aula/insere_aula.php";
                break;
            
            case 'fedita_aula':
                include "crud/aula/fedita_aula.php";
                break;
                
            case 'view_aula':
                include "crud/aula/view_aula.php";
                break;
            
            case 'atualiza_aula':
                include "crud/aula/atualiza_aula.php";
                break;
            
            case 'excluir_aula':
                include "crud/aula/excluir_aula.php";
                break;

                // ---- AVALIAÇÃO  ----///
            case 'lista_aval':
                include "crud/avaliacao/lista_aval.php";
                break;
            
            case 'fadd_aval':
                include "crud/avaliacao/fadd_aval.php";
                break;
            
            case 'insere_aval':
                include "crud/avaliacao/insere_aval.php";
                break;
            
            case 'fedita_aval':
                include "crud/avaliacao/fedita_aval.php";
                break;
                
            case 'view_aval':
                include "crud/avaliacao/view_aval.php";
                break;
            
            case 'atualiza_aval':
                include "crud/avaliacao/atualiza_aval.php";
                break;
            
            case 'excluir_aval':
                include "crud/avaliacao/excluir_aval.php";
                break;

                // ---- AVALIADO  ----///
            case 'lista_avaliado':
                include "crud/avaliado/lista_avaliado.php";
                break;
            
            case 'fadd_avaliado':
                include "crud/avaliado/fadd_avaliado.php";
                break;
            
            case 'insere_avaliado':
                include "crud/avaliado/insere_avaliado.php";
                break;
            
            case 'fedita_avaliado':
                include "crud/avaliado/fedita_avaliado.php";
                break;
                
            case 'view_avaliado':
                include "crud/avaliado/view_avaliado.php";
                break;
            
            case 'atualiza_avaliado':
                include "crud/avaliado/atualiza_avaliado.php";
                break;
            
            case 'excluir_avaliado':
                include "crud/avaliado/excluir_avaliado.php";
                break;

                // ---- DIA AULA  ----///
            case 'lista_alerta':
                include "crud/alerta/lista_alerta.php";
                break;
            
            case 'fadd_alerta':
                include "crud/alerta/fadd_alerta.php";
                break;
            
            case 'insere_alerta':
                include "crud/alerta/insere_alerta.php";
                break;
            
            case 'fedita_alerta':
                include "crud/alerta/fedita_alerta.php";
                break;
                
            case 'view_alerta':
                include "crud/alerta/view_alerta.php";
                break;
            
            case 'atualiza_alerta':
                include "crud/alerta/atualiza_alerta.php";
                break;
            
            case 'excluir_alerta':
                include "crud/alerta/excluir_alerta.php";
                break;

                // ---- DIA AULA  ----///
            case 'lista_dia':
                include "crud/dia_aula/lista_dia.php";
                break;
            
            case 'fadd_dia':
                include "crud/dia_aula/fadd_dia.php";
                break;
            
            case 'insere_dia':
                include "crud/dia_aula/insere_dia.php";
                break;
            
            case 'fedita_dia':
                include "crud/dia_aula/fedita_dia.php";
                break;
                
            case 'view_dia':
                include "crud/dia_aula/view_dia.php";
                break;
            
            case 'atualiza_dia':
                include "crud/dia_aula/atualiza_dia.php";
                break;
            
            case 'excluir_dia':
                include "crud/dia_aula/excluir_dia.php";
                break;

                // ---- RELATÓRIOS  ----///
            case 'relatorios':
                include "base/relatorios/relatorios.php";
                break;
        


        }
    }else if(isset($_SESSION['UsuarioNivel']) && $_SESSION['UsuarioNivel'] == 5){
        include 'crud/professor/area_prof/home_prof.php';
    }else if(isset($_SESSION['UsuarioNivel']) && $_SESSION['UsuarioNivel'] != 5){
        include 'base/home.php';
    }
?>