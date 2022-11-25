
    <?php
        $sql = "select d.id_disc, n_turma, nome_disc, c.id_cursa, a.desc_aval, a.tipo_aval, a.id_aval, m.id_ministra from usuario u inner join professor p on p.id_usur = u.id_usur inner join ministra m on m.mat_prof = p.mat_prof left join avaliacao a on a.id_ministra = m.id_ministra inner join cursa c on m.id_cursa = c.id_cursa inner join disciplina d on c.id_disc = d.id_disc where u.id_usur = ".$_SESSION['UsuarioID']." GROUP BY c.id_cursa order by id_disc, n_turma";

        $resultado = mysqli_query($con, $sql);

        
        echo '<table class="table table-striped" cellspacing="0" id="table" cellpading="0" id="lista_turm">
                <thead>
                    <td>Turma</td>
                    <td>Disciplina</td>
                    <td>Última avaliação</td>
                    <td>Ação</td>
                </thead>';
        while ($info = mysqli_fetch_array($resultado)) {
            echo '
                    <tr>
                        <td>Turma '.$info['n_turma'].'</td>
                        <td>'.$info['nome_disc'].'</td>
                        <td>';
                        if(isset($info['desc_aval'])){
                            $sql2 = "select * FROM avaliacao where id_ministra = ".$info['id_ministra']." ORDER BY id_aval desc";
                            $resultado2 = mysqli_query($con, $sql2);
                            $info2 = mysqli_fetch_array($resultado2);

                            echo 'Última avaliação: '.$info2['desc_aval'].' ('.$info2['tipo_aval'].')  <a class="btn btn-warning" href="?page=fadd_avaliado&id_aval='.$info2['id_aval'].'">Avaliar</a>';
                            }
            echo '</td>
                        <td>
                        <a href="?page=fadd_aval&id_min='.$info['id_ministra'].'" class="btn btn-success">Programar avaliação</a>
                            <a href="?page=fadd_freq&cursa='.$info['id_cursa'].'" class="btn btn-info">Frequencia</a>
                        </td>
                    </tr>
                   ';
        }
        echo '</table>';
    ?>
    

                            