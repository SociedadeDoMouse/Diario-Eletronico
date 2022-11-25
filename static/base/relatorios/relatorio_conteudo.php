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



try{
    $html = "";

    $min = $_GET['min'];
    $data = date('d/m/Y');

    $sql = mysqli_query($con, 'SELECT * FROM conteudo c INNER JOIN ministra m ON m.id_ministra = c.id_ministra INNER JOIN cursa cr ON cr.id_cursa = m.id_cursa INNER JOIN disciplina d ON cr.id_disc = d.id_disc INNER JOIN ano_letivo a ON cr.id_ano = a.id_ano where m.id_ministra = '.$min);
    $info = mysqli_fetch_array($sql);

    $datai = new DateTime($info['data_inicio']);
    $dataf = new DateTime($info['data_inicio']);
    $dataf -> modify('+3 month');
    $datai->format('Ymd');
    $dataf->format('Ymd');

    for ($i=1; $i <= 3; $i++) { 

        $mpdf->AddPage();

        
    // OBS: Este relatório correesponde a CONTEÚDOS
        // ABERTURA DA TABLE
        $html = '<table class="relatorio_conteúdo" id="relatorio_conteúdo">';

            // HEADER
            $html .= '
                <thead>
                    <tr>
                        <th colspan="9">CONTEÚDOS E ATIVIDADES DESENVOLVIDAS</th>
                        <th colspan="3">'.$i.'º Trimestre de '.$info['nome_disc'].'</th>
                    </tr>
                    <tr>
                        <th colspan="2" rowspan="1">DIA/MÊS</th>
                        <th colspan="8" rowspan="1">RESUMO</th>
                        <th colspan="2"> Doc. Gerado em '.$data.'. </th>
                    </tr>
                </thead>';
                
                $sql2 = mysqli_query($con, 'SELECT * FROM conteudo c INNER JOIN ministra m ON m.id_ministra = c.id_ministra INNER JOIN aula ON aula.id_ministra = m.id_ministra INNER JOIN cursa cr ON cr.id_cursa = m.id_cursa INNER JOIN ano_letivo a ON cr.id_ano = a.id_ano where m.id_ministra = '.$min.' and trimestre = '.$i);
                
                $info2 = mysqli_fetch_array($sql2);




                    $sql3 = mysqli_query($con, 'SELECT * FROM conteudo c INNER JOIN ministra m ON m.id_ministra = c.id_ministra INNER JOIN cursa cr ON cr.id_cursa = m.id_cursa INNER JOIN disciplina d ON cr.id_disc = d.id_disc INNER JOIN ano_letivo a ON cr.id_ano = a.id_ano where m.id_ministra = '.$min.' ORDER BY data_cont');
                    

                    while($info3 = mysqli_fetch_array($sql3)){
                        if(date('Ymd', strtotime($info3['data_cont'])) >= $datai->format('Ymd')
                        &&
                        date('Ymd',strtotime($info3['data_cont'])) < $dataf->format('Ymd')){
                            
                            $html .='
                            <tbody>
                            
                                <tr>
                                    <td colspan="2" name="data"> '.date('d/m',strtotime($info3['data_cont'])).' </td>
                                    <td colspan="10" name="desc_cont"> '.$info3['desc_cont'].' </td>
                                </tr>

                            </tbody>';
                        }
                    }
                
                $datai -> modify('+3 month');
                $dataf -> modify('+3 month');
                
            // FOOTER

            if(!isset($info2['aula_prev'])){
                header('location: \dashboard.php?page=relatorios&modal=ERR');
            }

            $html .='
            <tfoot>
                <tr> 
                    <td colspan="4" rowspan="2" style="text-align:left;"> <img src="../../build/img/FAETEC.png" width="140px"> </td>

                    <td colspan="3" name="aulas_prev"> Aulas Previstas: '.$info2['aula_prev'].'</td>
                    <td colspan="2" name="aulas_dadas"> Aulas Dadas: '.$info2['aula_min'].'</td>
                    <td colspan="3" name="data_fim"> Encerrado em: '.formdata($info2['data_fim']).'</td>
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
