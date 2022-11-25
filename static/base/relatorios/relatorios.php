<?php
$nivel_necessario = array(
	1 => 'Administrador',
	2 => 'Diretor',
	3 => 'Coodernador'
);
	include "base/testa_nivel.php";
  ?>
<div id="main" class="col-md-12">
	<div id="top" class="row">
		<div class="col-md-9">
		<h1 class="h3 mb-3">Painel de <strong>Relatórios</strong></h1>
		</div>

	</div>


	<hr class="d-none d-md-block">

	<div id="list" class="row">
		<div class="card" style="width: 18rem;">
			<img class="card-img-top" src="base/relatorios/img/Boletim_Individual.jpg" alt="Card image cap">
			<div class="card-body">
				<h2>Boletim Individual</h2>
			</div>
			<div class="card-body">
				<a href="?page=relatorios&modal=BI" class="btn btn-info px-7 py-3">Gerar</a>
			</div>
        </div>

		<div class="card" style="width: 18rem;">
			<img class="card-img-top" src="base/relatorios/img/Boletim_Turma.jpg" alt="Card image cap">
			<div class="card-body">
				<h2>Boletim de Turma</h2>
			</div>
			<div class="card-body">
				<a href="?page=relatorios&modal=BT" class="btn btn-info px-7 py-3">Gerar</a>
			</div>
        </div>

		<div class="card" style="width: 18rem;">
			<img class="card-img-top" src="base/relatorios/img/Relatorio_Conteudo.jpg" alt="Card image cap">
			<div class="card-body">
				<h2>Relatório de Conteúdos</h2>
			</div>
			<div class="card-body">
				<a href="?page=relatorios&modal=RC" class="btn btn-info px-7 py-3">Gerar</a>
			</div>

        </div>

		<div class="card" style="width: 18rem;">
			<img class="card-img-top" src="base/relatorios/img/Relatorio_Frequencia.jpg" alt="Card image cap">
			<div class="card-body">
				<h2>Relatório de Frequência</h2>
			</div>
			<div class="card-body">
				<a href="?page=relatorios&modal=RF" class="btn btn-info px-7 py-3">Gerar</a>
			</div>

        </div>

		<div class="card" style="width: 18rem;">
			<img class="card-img-top" src="base/relatorios/img/capa_diario.jpg" alt="Card image cap">
			<div class="card-body">
				<h2>Capa do Diário de Classe</h2>
			</div>
			<div class="card-body">
				<a href="?page=relatorios&modal=CD" class="btn btn-info px-7 py-3">Gerar</a>
			</div>

        </div>

		<?php
			include "modals_rel.php";
		?>
	</div>
</div>



