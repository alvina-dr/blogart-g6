<?php 
require_once __DIR__ . "../../CLASS_CRUD/membre.class.php";
require_once __DIR__ . '../../CLASS_CRUD/auth.class.php';
$membre = new MEMBRE();
$auth = new AUTH();
?>
			<?php
			if ($auth->is_connected()) {
				?>
				<li><a href="../../back/membre/logout.php">Déconnexion</a></li>
				<?php
			}
			else {
				?>
				<li><a href="../../front/html/inscription.php">Inscription</a></li>
				<li ><a class="connexion" href="../../front/html/connexion.php"></a></li>
				<?php
			}
			?>