<?php
use Mpdf\Mpdf;

require '../../vendor/autoload.php';
include '../functions/formdata.php';
include '../connect_crud.php';

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => [210, 297],
    'orientation' => 'P'
]); 

$min = $_GET['min'];
$data = date('d/m/Y');

// OBS: Este relatório correesponde a BOLETIM DA TURMA

$sql = mysqli_query($con, 'SELECT * FROM conteudo c INNER JOIN ministra m ON m.id_ministra = c.id_ministra INNER JOIN cursa cr ON cr.id_cursa = m.id_cursa INNER JOIN disciplina d ON cr.id_disc = d.id_disc INNER JOIN ano_letivo a ON cr.id_ano = a.id_ano where m.id_ministra = '.$min);
$info = mysqli_fetch_array($sql);

$mes_inicio = idate('m',strtotime($info['data_inicio']));

$meses = array(
        1 => 'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
    );


// ABERTURA DA TABLE
for ($i=1; $i <= 3; $i++) {
    
    $html = "";
    

    

    
    if(isset($info['n_turma'])){

        $sqla = mysqli_query($con, 'SELECT matriculado.id_mat FROM frequencia INNER JOIN matriculado ON matriculado.id_mat = frequencia.id_mat INNER JOIN aluno ON aluno.mat_aluno = matriculado.mat_aluno INNER JOIN enturmado ON aluno.mat_aluno = enturmado.mat_aluno WHERE n_turma = '.$info['n_turma'].' AND id_disc ='.$info['id_disc'].' AND matriculado.id_ano ='.$info['id_ano']);
        $infoa = mysqli_fetch_array($sqla);

        $sql2 = mysqli_query($con, 'SELECT data_freq FROM frequencia WHERE id_mat = '.$infoa[0].' AND trimestre_freq = '.$i.' ORDER BY data_freq,id_freq');

        $mpdf->AddPage();

        $html = '<table class="relatorio_turma" id="relatorio_turma">';

        $mes = '';

        for ($k=1; $k <= 3; $k++) { 
            if($k!=3){
                $mes .= $meses[$mes_inicio].',';
                $mes_inicio++;
            }else{
                $mes .= $meses[$mes_inicio];
                $mes_inicio++;
            }
        }

        // HEADER
        $html .= '
            <thead>

                <tr>
                    <th class="len_minTD" rowspan="5" colspan="1"> N° do Aluno </th>
                    <th class="len_maxTD" rowspan="1"> Turma: '.$info['n_turma'].' </th>
                    <th rowspan="1" colspan="30"> Componente Curricular: '.$info['nome_disc'].'. </th>
                    <th rowspan="1" colspan="31"> Doc Gerado em '.$data.'. </th>
                 </tr>
                <tr>
                    <th rowspan="1" colspan="30"> Mês: '.$mes.' </th>
                    <th rowspan="1" colspan="31"> Trimestre:  '.$i.'º </th>
                    <th rowspan="4" colspan="1">  Faltas </th>
                </tr>

                <tr>
                <th> Aulas Dadas: </th>

                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>

                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>

                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>

                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>

                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>

                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>
                <td> - </td>

                <td> - </td>
                <td> - </td>
            </tr>


                <tr><th rowspan="1">Data</th>';
            while($info2 = mysqli_fetch_array($sql2)){
                $html .='
                <td> '.date('d',strtotime($info2['data_freq'])).' </td>';
            }
                
        $html .='</tr>
                <tr>    
                    <th>Alunos</th>
                    <th colspan="60"></th>
                </tr>

            </thead>';

            // CORPO  OBS.: > #### < quando não houve avaliação ou a pessoa não existe //  > NA < Quando é NÃO AVALIADO !!!!

            $sql4 = mysqli_query($con, 'select DISTINCT num_enturmado,e.mat_aluno,id_enturmado, c.nome_curso, e.id_ano, t.ano_modulo, al.nome_ano, a.nome_aluno, e.num_enturmado from enturmado e INNER JOIN ano_letivo al ON e.id_ano = al.id_ano INNER JOIN aluno a ON a.mat_aluno = e.mat_aluno INNER JOIN turma t ON t.n_turma = e.n_turma INNER JOIN curso c ON c.id_curso = t.id_curso RIGHT JOIN cursa cs ON e.n_turma = cs.n_turma where e.n_turma = '.$info['n_turma'].' and e.id_ano ='.$info['id_ano'].';');

            $html .="<tbody>";
            
            while($info4 = mysqli_fetch_array($sql4)){
                $sql5 = mysqli_query($con, 'SELECT status FROM frequencia f INNER JOIN matriculado m ON m.id_mat = f.id_mat where mat_aluno='.$info4['mat_aluno'].' AND trimestre_freq = '.$i.' ORDER BY data_freq,id_freq' );

                $nome = explode(' ',$info4['nome_aluno']);
                $nomecompl = "";

                for ($n=0; $n < count($nome); $n++) { 

                    if($n != count($nome)-1 && $n > 0 && $nome[$n] != "da" && $nome[$n] != "de"){
                        $nomecompl .= $nome[$n][0].". ";
                    }else{
                        $nomecompl .= $nome[$n]." ";
                    }
                }

                $html .='
                
                    <tr>
                    <td class="len_minTD" colspan="1"> '.$info4['num_enturmado'].' </td>
                    <td class="len_maxTD"> '.$nomecompl.' </td>' ;

                $col = 60; 

                $totfal = 0;

                while($info5 = mysqli_fetch_array($sql5)){  
                if($info5['status']==1){
                    $icone = "●";
                }else if($info5['status']==2){
                    $icone = "J";
                }else{
                    $icone = "F";
                    $totfal++;
                }
                $html .="
                    <td> $icone </td>";
                    $col--;
                }

                while($col > 0){  
                    $html .='
                        <td> # </td>';
                        $col--;
                    }
                
                $html .= '<td colspan="2"> '.$totfal.' </td>
                    </tr>';
                    
            }
            $html .="</tbody></table>";
            // FOOTER
            $html .='
            <table>
                <tfoot>
                    <tr> 
                        <td colspan="2" style="text-align:left;"> <img src="../../build/img/FAETEC.png" width="140px"> </td>
                    </tr>
                </tfoot>
            </table>
        ';
    }
    $css = file_get_contents('../../build/css/relatorio.css');
    $mpdf->WriteHTML($css,1);
    $mpdf->WriteHTML($html); 

}


$mpdf->SetDisplayMode('fullpage'); 

$mpdf->Output(); 

if($html == ""){
    header('location: \dashboard.php?page=relatorios&modal=ERR');
}

exit; ?>

