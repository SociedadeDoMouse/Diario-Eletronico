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

$html = "";

$min = $_GET['min'];
$data = date('d/m/Y');

// OBS: Este relatório correesponde a BOLETIM DA TURMA
try{
for ($i=1; $i <= 3; $i++) {
    
    $sql = mysqli_query($con, 'SELECT * FROM conteudo c INNER JOIN ministra m ON m.id_ministra = c.id_ministra INNER JOIN cursa cr ON cr.id_cursa = m.id_cursa INNER JOIN disciplina d ON cr.id_disc = d.id_disc INNER JOIN ano_letivo a ON cr.id_ano = a.id_ano where m.id_ministra = '.$min);
    $info = mysqli_fetch_array($sql);
    
    $mpdf->AddPage();

    // ABERTURA DA TABLE
    $html = '<table class="relatorio_turma" id="relatorio_turma">';

    // HEADER

    $html .= '
        <thead>
            <tr>
                <th rowspan="2" colspan="1">N° de Aluno</th>
                <th rowspan="2" colspan="3">Nome do Aluno</th>
                
                <th colspan="7">'.$i.'º Trimestre de: '.$info['nome_disc'].'</th>
                <th colspan="1">Doc. Gerado em '.$data.'. </th>
            </tr>
            <tr>
                <th colspan="5" rowspan="1"> <strong> AVALIAÇÕES </strong> </th>

                <th colspan="1" rowspan="1">MÉDIA</th>
                <th colspan="1" rowspan="1">REC PARAL</th>
                <th colspan="1" rowspan="1">MÉDIA TRIMESTRE</th>
            </tr>
        </thead>';

        // CORPO  OBS.: > #### < quando não houve avaliação ou a pessoa não existe //  > NA < Quando é NÃO AVALIADO !!!!
        $sql4 = mysqli_query($con, 'select DISTINCT num_enturmado,e.mat_aluno,id_enturmado, c.nome_curso, e.id_ano, t.ano_modulo, al.nome_ano, a.nome_aluno, e.num_enturmado from enturmado e INNER JOIN ano_letivo al ON e.id_ano = al.id_ano INNER JOIN aluno a ON a.mat_aluno = e.mat_aluno INNER JOIN turma t ON t.n_turma = e.n_turma INNER JOIN curso c ON c.id_curso = t.id_curso RIGHT JOIN cursa cs ON e.n_turma = cs.n_turma where e.n_turma = '.$info['n_turma'].' and e.id_ano ='.$info['id_ano'].';');

        $html .='<tbody>';
        while($info4 = mysqli_fetch_array($sql4)){

            $media = 0;
            $rmedia = 0;

            $sql5 = mysqli_query($con, 'SELECT distinct nome_disc, d.id_disc, m.mat_aluno FROM cursa INNER JOIN matriculado m ON m.id_ano = '.$info['id_ano'].' AND m.mat_aluno = '.$info4['mat_aluno'].' INNER JOIN disciplina d ON cursa.id_disc = d.id_disc WHERE cursa.n_turma = '.$info['n_turma'].' AND cursa.dep = 0 AND nome_disc = "'.$info['nome_disc'].'"');

            

            $html .='
            <tr>
                <td colspan="1" name="num_aluno"> '.$info4['num_enturmado'].' </td>
                <td colspan="3" name="nome_aluno"> '.$info4['nome_aluno'].' </td>';

                $info5 = mysqli_fetch_array($sql5);

                $sql6 = mysqli_query($con, 'SELECT * FROM avaliacao av INNER JOIN avaliado a ON a.id_aval = av.id_aval INNER JOIN ministra m ON m.id_ministra = av.id_ministra INNER JOIN matriculado ma ON ma.id_mat = a.id_mat INNER JOIN cursa c ON m.id_cursa = c.id_cursa WHERE c.id_disc = '.$info5['id_disc'].' AND av.trimestre = '.$i.' AND mat_aluno = '.$info5['mat_aluno'].' AND c.n_turma = '.$info['n_turma'].' AND recuperacao = 0');

                $rec6 = mysqli_query($con, 'SELECT * FROM avaliacao av INNER JOIN avaliado a ON a.id_aval = av.id_aval INNER JOIN ministra m ON m.id_ministra = av.id_ministra INNER JOIN matriculado ma ON ma.id_mat = a.id_mat INNER JOIN cursa c ON m.id_cursa = c.id_cursa WHERE c.id_disc = '.$info5['id_disc'].' AND av.trimestre = '.$i.' AND mat_aluno = '.$info5['mat_aluno'].' AND c.n_turma = '.$info['n_turma'].' AND recuperacao = 1');
                
                $tabelas = 5;
                $totaval = 0;
                $notatot = 0;
                $rtotaval = 0;
                $rnotatot = 0;

                while($info6 = mysqli_fetch_array($rec6)){

                    $rnotatot += $info6['nota_avaliado'];
                    $rtotaval += $info6['nota_max'];

                }

                while($info6 = mysqli_fetch_array($sql6)){

                    $notatot += $info6['nota_avaliado'];
                    $totaval += $info6['nota_max'];
                
                    $html .= '
                        <td colspan="1" name="primeira_avaliação"> '.$info6['nota_avaliado'].' </td>
                    ';

                    $tabelas--;
                }

                if($totaval != 0){
                    $media = round(($notatot/$totaval)*10,1);
                }else{
                    $media = " - ";
                }
                if($rtotaval != 0){
                    $rmedia = round(($rnotatot/$rtotaval)*10,1);
                }else{
                    $rmedia = " - ";
                }

            while ($tabelas > 0) {
                $html .='
                    <td colspan="1" name="primeira_avaliação">-</td>
                ';
                $tabelas--;
            }

            if($media < $rmedia){
                $mediafim = $rmedia;
            }else{
                $mediafim = $media;
            }

            $html .='<td colspan="1" name="média"> '.$media.' </td>
                <td colspan="1" name="rec_paralela"> '.$rmedia.' </td>
                <td colspan="1" name="med_trim"> '.$mediafim.' </td>
            </tr>
        ';
}
        $html .='</tbody>';
        // FOOTER
        $sql2 = mysqli_query($con, 'SELECT * FROM conteudo c INNER JOIN ministra m ON m.id_ministra = c.id_ministra INNER JOIN aula ON aula.id_ministra = m.id_ministra INNER JOIN cursa cr ON cr.id_cursa = m.id_cursa INNER JOIN ano_letivo a ON cr.id_ano = a.id_ano where m.id_ministra = '.$min);
            
        $info2 = mysqli_fetch_array($sql2);

        $html .='
        <tfoot>
            <tr> 
                <td colspan="5" rowspan="2" style="text-align:left;"> <img src="../../build/img/eteot.png" width="140px"> </td>

                <td colspan="3" name="aulas_prev"> Aulas Previstas: '.$info2['aula_prev'].'</td>
                <td colspan="1" name="aulas_dadas"> Aulas Dadas: '.$info2['aula_min'].'</td>
                <td colspan="2" name="data_fim"> Encerrado em: '.formdata($info2['data_fim']).'</td>
            </tr>
            <tr>
                <td colspan="4"> Ass. do Professor: _______ </td>
                <td colspan="4"> Ass. do Supervisor/Coordenador: _______  </td>
            </tr>
        </tfoot>
    </table>
    ';

    $css = file_get_contents('../../build/css/relatorio.css');
    $mpdf->WriteHTML($css,1);
    $mpdf->WriteHTML($html); 
}

$mpdf->SetDisplayMode('fullpage'); 
$mpdf->Output(); 

if($html == ""){
    header('location: \dashboard.php?page=relatorios&modal=ERR');
}
}catch(Exception $e){
    header('location: \dashboard.php?page=relatorios&modal=ERR');
}
exit; ?>

