<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">

				<a class="sidebar-brand" href="dashboard.php">
					<img src="build/img/logo_gray.svg" width="50px" alt="">
					 &nbspDiário Eletrônico
				</a>

				<?php include "sidebar/sidebar-".$_SESSION['UsuarioNivel'].".php"; ?>

			</div>
		</nav>