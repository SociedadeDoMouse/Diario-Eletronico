
<?php

use Mpdf\Mpdf;

include '../connect_crud.php';
require '../../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => [210, 297],
    'orientation' => 'P'
]); 



try{
    $mch = curl_multi_init();

    $url = "static/base/relatorios/bi_exec.php";

    $html='';
    $turma = $_GET['turma'];
    $ano = $_GET['ano'];

    $i = 1;
    
    $sql = mysqli_query($con, 'select DISTINCT e.mat_aluno,id_enturmado, c.nome_curso, e.id_ano, t.ano_modulo, al.nome_ano, a.nome_aluno, e.num_enturmado from enturmado e INNER JOIN ano_letivo al ON e.id_ano = al.id_ano INNER JOIN aluno a ON a.mat_aluno = e.mat_aluno INNER JOIN turma t ON t.n_turma = e.n_turma INNER JOIN curso c ON c.id_curso = t.id_curso RIGHT JOIN cursa cs ON e.n_turma = cs.n_turma where e.n_turma = '.$turma.' and e.id_ano ='.$ano.';');

        while($info = mysqli_fetch_array($sql)){

            $info2 = array_merge($info,$_GET);
            
            $ch[$i] = curl_init($url);

            curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch[$i], CURLOPT_POSTFIELDS, $info2);

            $i++;

        }
        if(isset($ch)){
            for ($k=1; $k <= count($ch); $k++) { 

                curl_multi_add_handle($mch, $ch[$k]);
                curl_multi_exec($mch, $active);
                
            }

            do{
                curl_multi_exec($mch, $active);
            } while ($active > 0);

            for ($j=1; $j <= count($ch); $j++) { 

                $result = curl_multi_getcontent($ch[$j]);

                $html = $result;

                curl_multi_remove_handle($mch, $ch[$j]); 

                $mpdf->AddPage();

                $mpdf->SetDisplayMode('fullpage'); 
                $css = file_get_contents('../../build/css/relatorio.css');
                $mpdf->WriteHTML($css,1);
                $mpdf->WriteHTML($html);   

            }
        }

        $mpdf->SetDisplayMode('fullpage');  
                $mpdf->Output(); 

                if($html == ""){
                    header('location: \dashboard.php?page=relatorios&modal=ERR');
                }

}catch(Exception $e){
    header('location: \dashboard.php?page=relatorios&modal=ERR');
}

    exit;

?>
