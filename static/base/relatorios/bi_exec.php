
<?php
    include '../functions/formdata.php';
    include '../connect_crud.php';
    include '../functions/maiusculo.php';

    $a = 'data:image/jpg;base64,'.base64_encode(file_get_contents('../../build/img/FAETEC.jpg'));

    $info = $_POST;
    $data = date('d/m/Y');

            $ano_letivo = explode(" ",$info['nome_ano']);
            
            

            // ABERTURA DA TABLE HEADER DOC
            $html='';

            $html .= '<table class="header_relatorio_individual">';
            // HEADER DOC
            $html .= '
                        <thead>
                            <tr>
                                <th colspan="2" rowspan="4">  <img src="'.$a.'" style="width:60px;">  </th>
                            </tr>

                            <tr>
                                <th colspan="10"> ESCOLA TÉCNICA ESTADUAL OSCAR TENÓRIO </th>
                            </tr>  

                            <tr>
                                <th colspan="10"> FICHA INDIVIDUAL DE RENDIMENTOS - '.$ano_letivo[2].' </th>
                            </tr>

                            <tr>
                                <th colspan="10"> ENSINO MÉDIO INTEGRADO EM <strong> '.maiusculo($info['nome_curso']).' </strong> - <span> '.$info['ano_modulo'].'ª Série <span> </th> 
                            </tr>
                            
                            <tr>
                                <th colspan="12"> ALUNO: <span> '.$info['nome_aluno'].' </span> </th>
                            </tr>
                            <tr>
                                <th colspan="5">  TURMA: <span> '.$info['turma'].' <span>  </th>
                                <th colspan="4"> N°: '.$info['num_enturmado'].' </th>
                                <th colspan="3">  Doc. Gerado em '.$data.'. </th>
                            </tr>
                                
                        </thead>
                    </table>
            ';


            // ABERTURA DA TABLE HEADER TABELA
            $html .= '<table class="relatorio_individual" id="relatorio_individual">';

            // CABEÇALHO TABELA
            $html .= '
                    <thead>
                        <tr>
                            <th rowspan="2" colspan="2">DISCIPLINAS CURSADAS</th>
                            <th colspan="3">1° ETAPA</th>
                            <th colspan="3">2° ETAPA</th>
                            <th colspan="3">3° ETAPA</th>
                            <th colspan="2">TOTAL ANUAL</th>
                            <th colspan="1" rowspan="2">REC FINAL</th>
                        </tr>
                        <tr>
                            <th colspan="1">NOTA</th>
                            <th colspan="1">N° FALTAS</th>
                            <th colspan="1">% FALTAS</th>
                            <th colspan="1">NOTA</th>
                            <th colspan="1">N° FALTAS</th>
                            <th colspan="1">% FALTAS</th>
                            <th colspan="1">NOTA</th>
                            <th colspan="1">N° FALTAS</th>
                            <th colspan="1">% FALTAS</th>

                            <th colspan="1">MÉDIA</th>
                            <th colspan="1">FALTAS</th>

                        </tr>
                    </thead>
            ';

            // CORPO

            $ntcf1 = 0;
            $ntcf2 = 0;
            $ntcf3 = 0;
            $ftcf1 = 0;
            $ftcf2 = 0;
            $ftcf3 = 0;
            $pftcf1 = 0;
            $pftcf2 = 0;
            $pftcf3 = 0;
            $qntmat = 0;
            $mdcf1 = 0;
            $fttotcf1 = 0;

            $situacao = 'Aprovado'; 
            $situacaorf = 'Aprovado'; 

            $sql2 = mysqli_query($con, 'SELECT distinct nome_disc, d.id_disc, m.mat_aluno FROM cursa
            INNER JOIN matriculado m ON m.id_ano = '.$info['ano'].' AND m.mat_aluno = '.$info['mat_aluno'].'
            INNER JOIN disciplina d ON cursa.id_disc = d.id_disc WHERE cursa.n_turma = '.$info['turma'].' AND cursa.dep = 0 order by nome_disc;');

            while($info2 = mysqli_fetch_array($sql2)){

                $nomeed = explode(' ', $info2['nome_disc']);
                $nomed = "";
                
                    for ($k=0; $k < count($nomeed); $k++) { 
                        $p = "";
                        if ($k != 0 && $k != count($nomeed)) {
                            $abrev = $nomeed[$k][0];
                            for ($j=1; $j < strlen($nomeed[$k]) && $j < 4; $j++) { 

                                    if($j == 3){
                                        $p = 1;
                                    }else{
                                        $abrev .= $nomeed[$k][$j];
                                    }

                            }
                            if($p != 1){
                                $nomed .= $abrev." ";
                            }else{
                                $nomed .= $abrev.". ";
                            }
                        }else{
                            $nomed .= $nomeed[$k]." ";
                        }
                    }
                    
                
                
                $html .= '
                <tbody>
                    <tr>
                        <td colspan="2" style="text-align:left;"> <strong>'.$nomed.' </strong></td>';
                
                $totnota = 0;
                $totfalta = 0;

                $qntmat++;

                for ($i=1; $i <= 3; $i++) { 

                    

                        //NOTA

                        $media = 0;
                        $rmedia = 0;
                        $nota = 0;
                        $notamax = 0;
                        $rnota = 0;
                        $rnotamax = 0;
                        $mediatot = 0;



                        $sql3 = mysqli_query($con, 'SELECT nota_avaliado, nota_max FROM avaliacao av INNER JOIN avaliado a ON a.id_aval = av.id_aval INNER JOIN ministra m ON m.id_ministra = av.id_ministra INNER JOIN matriculado ma ON ma.id_mat = a.id_mat INNER JOIN cursa c ON m.id_cursa = c.id_cursa WHERE c.id_disc = '.$info2['id_disc'].' AND av.trimestre = '.$i.' AND mat_aluno = '.$info2['mat_aluno'].' AND c.n_turma = '.$info['turma'].' AND recuperacao = 0');

                        $rec3 = mysqli_query($con, 'SELECT nota_avaliado, nota_max FROM avaliacao av INNER JOIN avaliado a ON a.id_aval = av.id_aval INNER JOIN ministra m ON m.id_ministra = av.id_ministra INNER JOIN matriculado ma ON ma.id_mat = a.id_mat INNER JOIN cursa c ON m.id_cursa = c.id_cursa WHERE c.id_disc = '.$info2['id_disc'].' AND av.trimestre = '.$i.' AND mat_aluno = '.$info2['mat_aluno'].' AND c.n_turma = '.$info['turma'].' AND recuperacao = 1');
                        
                        while($info3 = mysqli_fetch_array($sql3)){
                            $nota += $info3['nota_avaliado'];
                            $notamax += $info3['nota_max'];
                        }

                        while($infor3 = mysqli_fetch_array($rec3)){
                            $rnota += $infor3['nota_avaliado'];
                            $rnotamax += $infor3['nota_max'];
                        }

                        if($rnotamax != 0){
                            $rmedia = round(($rnota/$rnotamax)*10,1);
                        }

                        if($notamax != 0){

                            $media = round(($nota/$notamax)*10,1);

                            if($media < $rmedia){
                                $media = $rmedia;
                            }
                        
                            $totnota += $media;

                            if($i == 1){
                                $ntcf1 += $media;
                            }else if($i == 2){
                                $ntcf2 += $media;
                            }else if($i == 3){
                                $ntcf3 += $media;
                            }  
                        }else if($rmedia != 0){
                            $media = $rmedia;
                            $totnota += $media;

                            if($i == 1){
                                $ntcf1 += $media;
                            }else if($i == 2){
                                $ntcf2 += $media;
                            }else if($i == 3){
                                $ntcf3 += $media;
                            }  
                        }else{
                            $media = ' - ';
                        }

                        //Faltas

                        $sql4 = mysqli_query($con, 'SELECT SUM(CASE WHEN STATUS = 0 THEN 1 ELSE 0 END), count(*) FROM frequencia f INNER JOIN matriculado ma ON ma.id_mat = f.id_mat WHERE mat_aluno = '.$info2['mat_aluno'].' AND trimestre_freq = '.$i.' AND id_disc ='.$info2['id_disc']);

                        $info4 = mysqli_fetch_array($sql4);



                        if($info4[0] == ""){
                            $info4[0] = 0;
                        }

                        if($info4[1] != 0 && $info4[0] != 0){
                            $pfalta = ($info4[0]/$info4[1])*100;

                            if($i == 1){
                                $pftcf1 += $pfalta;
                            }else if($i == 2){
                                $pftcf2 += $pfalta;
                            }else if($i == 3){
                                $pftcf3 += $pfalta;
                            }
                        }else{
                            $pfalta = 0;
                        }

                        $totfalta += $info4[0];

                        if($i == 1){
                            $ftcf1 += $info4[0];
                        }else if($i == 2){
                            $ftcf2 += $info4[0];
                        }else if($i == 3){
                            $ftcf3 += $info4[0];
                        }  

                        $html .= '
                                <td> '.$media.' </td>
                                <td> '.$info4[0].' </td>
                                <td> '.round($pfalta,1).'% </td>';  
                            
                    }

                $sql5 = mysqli_query($con, 'SELECT nota_avaliado, nota_max FROM avaliacao av INNER JOIN avaliado a ON a.id_aval = av.id_aval INNER JOIN ministra m ON m.id_ministra = av.id_ministra INNER JOIN matriculado ma ON ma.id_mat = a.id_mat INNER JOIN cursa c ON m.id_cursa = c.id_cursa WHERE c.id_disc = '.$info2['id_disc'].' AND av.trimestre = "RF" AND mat_aluno = '.$info2['mat_aluno']);

                $notarf = 0;
                $notamaxrf = 0;

                while($info5 = mysqli_fetch_array($sql5)){
                    $notarf += $info5['nota_avaliado'];
                    $notamaxrf += $info5['nota_max'];
                }
                if($notamaxrf != 0 ){
                    $mediarf = round(($notarf/$notamaxrf)*10,1);
                }else{
                    $mediarf = ' - ';
                }


                    $mdcf1 += $mediatot;
                    $fttotcf1 += $totfalta;

                $mediatot = $totnota/3;
                $html .= '
                                <td> '.round($mediatot,1).' </td>
                                <td> '.$totfalta.' </td>
                                <td> '.$mediarf.' </td>
                            </tr>
                        
                    
                ';

                if($mediatot < 6 || $media == 'NA' || round($pfalta,1) > 25){
                    $situacao = 'Reprovado';  
                }
                if($mediarf < 6 || $mediarf == 'NA'){
                    $situacaorf = 'Reprovado';  
                }
            }
            if($qntmat!=0){
            $coef1 = $ntcf1/$qntmat;
            $coef2 = $ntcf2/$qntmat;
            $coef3 = $ntcf3/$qntmat;

            $coefft1 = $ftcf1/$qntmat;
            $coefft2 = $ftcf2/$qntmat;
            $coefft3 = $ftcf3/$qntmat;

            $pcoefft1 = $pftcf1/$qntmat;
            $pcoefft2 = $pftcf2/$qntmat;
            $pcoefft3 = $pftcf3/$qntmat;

            $coefmd1 = $mdcf1/$qntmat;
            
            $fttotmd1 = $fttotcf1/$qntmat;
            }
            $html .= '
            <tr>
                <td colspan="2"> <b>Coef. Rendimento</b> </td>
                <td>'.round($coef1,1).'</td>
                <td>'.round($coefft1).'</td>
                <td>'.round($pcoefft1,1).'%</td>
                <td>'.round($coef2,1).'</td>
                <td>'.round($coefft2).'</td>
                <td>'.round($pcoefft2,1).'%</td>
                <td>'.round($coef3,1).'</td>
                <td>'.round($coefft3).'</td>
                <td>'.round($pcoefft3,1).'%</td>
                <td>'.round($coefmd1,1).'</td>
                <td>'.round($fttotmd1).'</td>
            </tr>
            ';
            $html .= '</tbody></table>';
            

            $sql6 = mysqli_query($con, 'SELECT DISTINCT disciplina.nome_disc, disciplina.id_disc 
            FROM matriculado
            INNER JOIN avaliado ON matriculado.id_mat = avaliado.id_mat
            INNER JOIN avaliacao ON avaliacao.id_aval = avaliado.id_aval
            INNER JOIN ministra ON ministra.id_ministra = avaliacao.id_ministra 
            INNER JOIN cursa ON cursa.id_cursa = ministra.id_cursa 
            INNER JOIN disciplina ON cursa.id_disc = disciplina.id_disc 
            WHERE cursa.dep = 1 AND cursa.id_ano = '.$info['ano'].' AND mat_aluno = '.$info['mat_aluno'].';');

            // FOOTER
            $html .= '
                <table class="footer_relatorio_individual">
                    <thead>
                        <tr>
                            <th colspan="6"> DEPENDÊNCIAS</th>
                        </tr>';

            
            while($info6 = mysqli_fetch_array($sql6)){  
                
                if(isset($info6['nome_disc'])){   
                        $sql7 = mysqli_query($con, 'select * FROM avaliacao a INNER JOIN avaliado av ON av.id_aval = a.id_aval INNER JOIN ministra m ON a.id_ministra = m.id_ministra INNER JOIN cursa c ON m.id_cursa = c.id_cursa INNER JOIN matriculado mt ON av.id_mat = mt.id_mat WHERE c.id_disc = '.$info6['id_disc'].' and c.id_ano ='.$info['ano'].' AND mt.mat_aluno = '.$info['mat_aluno'].';');

                        $notadp = 0;
                        $notamaxdp = 0;
                        $totnotadp = 0;
                        
                        while($info7 = mysqli_fetch_array($sql7)){
                            $notadp += $info7['nota_avaliado'];
                            $notamaxdp += $info7['nota_max'];
                        }

                        if($notamaxdp != 0){
                            $mediadp = round(($notadp/$notamaxdp)*10,1);
                            $totnotadp += $mediadp;
                        }else{
                            $mediadp = 'NA';
                        }
                    
                    $html   .=  '<tr>
                                    <td colspan="4"> '.$info6['nome_disc'].' </td> 
                                    <td colspan="2"> '.$mediadp.' </td>
                                </tr>';
                }
            }
            

            $html   .=  '<tr>
                            <th colspan="3"> SITUAÇÃO NA 3° ETAPA: </th>
                            <th colspan="3"> SITUAÇÃO Após Rec. Final: </th>
                        </tr>
                        <tr>
                            <td colspan="3"> '.$situacao.' </td> 
                            <td colspan="3"> '.$situacaorf.' </td>
                        </tr>
                    </thead>

                    
            ';

            $html .='</table>';

            echo $html;
        ?>