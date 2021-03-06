<?php
///////////////////////////////////////////////////////////////
//
//  Gestion des CRUD (PDO) - 23 Janvier 2021
//
//  Script  : index1.php 	-		BLOGART21 (Etud)
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '../../util/utilErrOn.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Gestion des CRUD</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" href="../../back/css/style.css">
    <style type="text/css">
				div {
					padding-top: 60px;
					padding-bottom: 40px;
					margin-bottom: 0px;
					margin-left: 60px;
				}
        span { /*Couleur du surlignage*/
            background-color: black;
        }
		#navbar{
			margin:0;
			padding:0;
		}
		#navbar .column{
			margin:0;
			padding:0;
		}
    </style>
	    <link rel="stylesheet" href="../../front/css/style.css">
		<link rel="stylesheet" href="../../front/css/header.css">
		<link rel="stylesheet" href="../../front/css/insolite.css">
</head>
<body>
	<?php
	require_once __DIR__ . '../../front/html/header_admin.php';
	?>
	<div class="title_blogart">
		<h1>Panneau d'Admin : Gestion des CRUD - BLOGART21</h1> 
		<img class="logo_manette"width="5%" class="soulignage2" src="../../front/assets/icons/gameboy.svg"> <!--BARRE--><br />
	</div>
	<small><span><i>CRUD fini et valide (reste à tester et à intégrer)</i></span></small><br>
	<small><i>(*) : CRUD en cours de construction</i></small>
	<br /> <!--saut à la ligne-->
	<br /> <!--saut à la ligne-->
	<img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
	<div>
	Gestion du CRUD :
	<a href="../../back/angle/angle.php"><span>Angle</span></a>
	<br /><br />
	Gestion du CRUD :
	<a href="../../back/article/article.php">Article (*)</a>
	<br /><br />
	Gestion du CRUD :
	<a href="../../back/comment/comment.php">Commentaire (*)</a>
	<br /><br />
	Gestion du CRUD :
	<a href="../../back/commentplus/commentPlus.php">Réponse au Commentaire </a>
	<br /><br />
	Gestion du CRUD :
	<a href="../../back/langue/langue.php"><span>Langue</span></a>
	<br /><br />
	Gestion du CRUD :
	<a href="../../back/likeart/likeart.php">Like Article (*)</a>
	<br /><br />
	Gestion du CRUD :
	<a href="../../back/likecom/likecom.php">Like Commentaire (*) </a>
	<br /><br />
	Gestion du CRUD :
	<a href="../../back/membre/membre.php">Membre (*)</a>
	<br /><br />
	Gestion du CRUD :
	<a href="../../back/motcle/motcle.php"><span>Mot-clé</span></a>
	<br /><br />
	Gestion du CRUD :
	<a href="../../back/motclearticle/motclearticle.php">Mot-clé Article </a>
	<br /><br />
	Gestion du CRUD :
	<a href="../../back/statut/statut.php"><span>Statut</span></a>
	<br /><br />
	Gestion du CRUD :
	<a href="../../back/thematique/thematique.php">Thématique (*)</a>
	<br /><br />
	Gestion du CRUD :
	<a href="../../back/user/user.php">User </a>
	</div>
	<br>
<?php
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
