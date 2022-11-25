
    <?php
        $sql = "select d.id_disc, n_turma, nome_disc, c.id_cursa, a.desc_aval, a.tipo_aval, a.id_aval, m.id_ministra from usuario u inner join professor p on p.id_usur = u.id_usur inner join ministra m on m.mat_prof = p.mat_prof left join avaliacao a on a.id_ministra = m.id_ministra inner join cursa c on m.id_cursa = c.id_cursa inner join disciplina d on c.id_disc = d.id_disc where u.id_usur = ".$_SESSION['UsuarioID']." GROUP BY c.id_cursa order by id_disc, n_turma";
    
        $resultado = mysqli_query($con, $sql);

        

        while ($info = mysqli_fetch_array($resultado)) {
            echo '<div class="col-md-6">
            <div id="card" class="card" style="border:0.5px solid black;">
                <div class="card-body">
                    <h2>Turma '.$info['n_turma'].'</h2>
                    <h3>'.$info['nome_disc'].'</h3>
                </div>';
                if(isset($info['desc_aval'])){
                    $sql2 = "select * FROM avaliacao where id_ministra = ".$info['id_ministra']." ORDER BY id_aval desc";
                    $resultado2 = mysqli_query($con, $sql2);
                    $info2 = mysqli_fetch_array($resultado2);

                echo '<div class="card-body" style="padding:0; padding-left:1.25rem;">
                    <p>Última avaliação: '.$info2['desc_aval'].' ('.$info2['tipo_aval'].')  <a class="btn btn-warning" href="?page=fadd_avaliado&id_aval='.$info2['id_aval'].'">Avaliar</a></p>
                </div>';
                }
                echo '
                <div class="card-body">
                    <a href="?page=fadd_aval&id_min='.$info['id_ministra'].'" class="btn btn-success">Programar avaliação</a>
                    
                    <a href="?page=fadd_freq&cursa='.$info['id_cursa'].'" class="btn btn-info">Frequencia</a>
                </div>
            </div>
        </div>';
        }
    ?>
    

                            