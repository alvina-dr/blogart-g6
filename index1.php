<?php
///////////////////////////////////////////////////////////////
//
//  Gestion des CRUD (PDO) - 23 Janvier 2021
//
//  Script  : index1.php 	-		BLOGART21 (Etud)
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/util/utilErrOn.php';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Gestion des CRUD</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" href="./back/css/style.css">
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
    </style>
</head>
<body>
	<br />
	<div class="title_blogart">
		<h1>Panneau d'Admin : Gestion des CRUD - BLOGART21</h1> 
		<img class="logo_manette"width="5%" class="soulignage2" src="./FRONT/assets/icons/gameboy.svg"> <!--BARRE--><br />
	</div>
	<small><span><i>CRUD fini et valide (reste à tester et à intégrer)</i></span></small><br>
	<small><i>(*) : CRUD en cours de construction</i></small>
	<br /> <!--saut à la ligne-->
	<br /> <!--saut à la ligne-->
	<img class="soulignage2" src="./FRONT/assets/icons/soulignage.svg"> <!--BARRE--><br />
	<div>
	Gestion du CRUD :
	<a href="./BACK/angle/angle.php"><span>Angle</span></a>
	<br /><br />
	Gestion du CRUD :
	<a href="./BACK/article/article.php">Article (*)</a>
	<br /><br />
	Gestion du CRUD :
	<a href="./BACK/comment/comment.php">Commentaire (*)</a>
	<br /><br />
	Gestion du CRUD :
	<a href="./BACK/commentplus/commentplus.php">Réponse sur Commentaire </a>
	<br /><br />
	Gestion du CRUD :
	<a href="./BACK/langue/langue.php"><span>Langue</span></a>
	<br /><br />
	Gestion du CRUD :
	<a href="./BACK/likeart/likeart.php">Like Article (*)</a>
	<br /><br />
	Gestion du CRUD :
	<a href="./BACK/likecom/likecom.php">Like Commentaire (*) </a>
	<br /><br />
	Gestion du CRUD :
	<a href="./BACK/membre/membre.php">Membre (*)</a>
	<br /><br />
	Gestion du CRUD :
	<a href="./BACK/motcle/motcle.php"><span>Mot-clé</span></a>
	<br /><br />
	Gestion du CRUD :
	<a href="./BACK/motclearticle/motclearticle.php">Mot-clé Article </a>
	<br /><br />
	Gestion du CRUD :
	<a href="./BACK/statut/statut.php"><span>Statut</span></a>
	<br /><br />
	Gestion du CRUD :
	<a href="./BACK/thematique/thematique.php">Thématique (*)</a>
	<br /><br />
	Gestion du CRUD :
	<a href="./BACK/user/user.php">User </a>
	</div>
	<br>
<?php
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
