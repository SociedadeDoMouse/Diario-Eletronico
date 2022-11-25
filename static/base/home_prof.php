<div class="row">
    <?php
        $sql = "select d.id_disc, n_turma, nome_disc, c.id_cursa from usuario u inner join professor p on p.id_usur = u.id_usur inner join ministra m on m.mat_prof = p.mat_prof inner join cursa c on m.id_cursa = c.id_cursa inner join disciplina d on c.id_disc = d.id_disc where u.id_usur = ".$_SESSION['UsuarioID']." order by id_disc, n_turma";
    
        $resultado = mysqli_query($con, $sql);

        

        while ($info = mysqli_fetch_array($resultado)) {
            echo '<div class="col">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h2>Turma '.$info['n_turma'].'</h2>
                    <h3>'.$info['nome_disc'].'</h3>
                </div>
                <div class="card-body">
                    <button href="#" class="btn btn-success">Avaliações</button>
                    
                    <a href="?page=fadd_freq&cursa='.$info['id_cursa'].'" class="btn btn-info">Frequencia</a>
                </div>
            </div>
        </div>';
        }
    ?>
    
</div>
    