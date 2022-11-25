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
$a = 'data:image/jpg;base64,'.base64_encode(file_get_contents('../../build/img/simbol-faetec.jpg'));

try{
    $html = "";

    $min = $_GET['min'];
    $data = date('d/m/Y');

    $sql = mysqli_query($con, 'SELECT * FROM conteudo c 
    INNER JOIN ministra m ON m.id_ministra = c.id_ministra 
    INNER JOIN cursa cr ON cr.id_cursa = m.id_cursa 
    INNER JOIN disciplina d ON cr.id_disc = d.id_disc 
    INNER JOIN ano_letivo a ON cr.id_ano = a.id_ano 
    INNER JOIN professor p ON m.mat_prof = p.mat_prof 
    INNER JOIN usuario u ON u.id_usur = p.id_usur
    INNER JOIN turma t ON  t.n_turma = cr.n_turma
    INNER JOIN curso cu ON cu.id_curso = t.id_curso
    INNER JOIN turno tn ON tn.id_turno = t.id_turno
    where m.id_ministra ='.$min);
    $info = mysqli_fetch_array($sql);


        
    // OBS: Este relatório correesponde a CAPA DO DIÁRIO
        // ABERTURA DA TABLE

            // HEADER
            $html .= '<table class="capa_diario">';
            // HEADER DOC
            $html .= '
                        <thead>

                            <tr>
                                <th colspan="12">  <img src="'.$a.'" style="width:80px;">  </th>
                            </tr>  

                            <tr>
                                <th colspan="12"> GOVERNO DO ESTADO DO RIO DE JANEIRO <br> SECRETÁRIA DE ESTADO DE CIÊNCIA E TECNOLOGIA <br> FUNDAÇÃO DE APOIO A ESCOLA TÉCNICA </th>
                            </tr>
                                
                        </thead>
                        </table>
            ';


                $html .= '<table class="capa_diario_corpo">';
                // BODY
                $html .= '
                        <tbody> 
                            <tr> <td colspan="12" style="text-align:center;"> <h2 style="text-align:center;"> DIÁRIO DE CLASSE </h2> </td>  </tr>
                            <tr>
                                <tr> 
                                    <td style="text-align:left;" colspan="6"><strong>Unidade Escolar:</strong> Escola Técnica Estadual Oscar Tenório<td>
                                    <td>'.$info['nome_ano'].'</td>
                                </tr>
                                <tr> 
                                    <td style="text-align:left;" colspan="6"><strong>Turma:</strong> '.$info['n_turma'].'<td>
                                    <td><strong>Turno:</strong> '.$info['turno'].'</td>
                                </tr>
                                <tr> 
                                    <td style="text-align:left;"><strong>Componente Curricular:</strong> '.$info['nome_disc'].'<td>
                                </tr>
                                <tr> 
                                    <td style="text-align:left;"><strong>Professor:</strong> '.$info['nome'].'</td>
                                </tr>
                                <tr> 
                                    <td style="text-align:left;"><strong>Curso:</strong> '.$info['nome_curso'].'</td>
                                </tr>
                            </tr>
                        </tbody>
                    </table>';

                
            $html .= '<table class="capa_diario_footer">';
            // FOOTER
            $html .='
            <tfoot>
                <tr>
                    <td style="text-align:center;">
                     Diretoria de Desenvolvimento da Educação Básica e Técnica <br> Rua Clarimundo de Melo, 846 - Cep 21.311-280 - RJ (21) 2332-4107 / 2332-4106
                     </td>
                </tr>
                <tr> <td> </td> </tr>
            </tfoot>
        </table>
        ';

        $css = file_get_contents('../../build/css/capa.css');
        $mpdf->WriteHTML($css,1);
        $mpdf->WriteHTML($html); 
    

    $mpdf->SetDisplayMode('fullpage'); 
    $mpdf->Output(); 

    if($html == ""){
        header('location: \dashboard.php?page=relatorios&modal=ERR');
    }
}catch(Exception $e){
    header('location: \dashboard.php?page=relatorios&modal=ERR');
}
exit; ?>
