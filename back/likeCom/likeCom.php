<?
/////////////////////////////////////////////////////
//
//  CRUD LIKECOM (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : likeCom.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../CLASS_CRUD/likeCom.class.php';
global $db; 
$monLikeCom = new LIKECOM;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD LikeCom sur Commentaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD LikeCom sur Commentaire</h1>

    <img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
	<h2>Nouvel LIKECOM :&nbsp;<a href="./createLikeCom.php"><i>Créer un likeCom</i></a></h2>
    <img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
	<h2>Tous les LIKECOM</h2>

	<table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
        <th>&nbsp;Numéro du membre&nbsp;</th>
            <th>&nbsp;Numéro de la séquence du commentaire&nbsp;</th>
            <th>&nbsp;Numéro de l'article&nbsp;</th>
            <th>&nbsp;Like du commentaire&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
            
        </tr>
    </thead>
    <tbody>

<?
 $allStatuts = $monLikeCom->get_AllLikeCom();
 foreach($allStatuts as $row) {
	// Appel méthode : tous les statuts en BDD
?>
        <tr>
		<td><h4>&nbsp; <?= $row["numMemb"]; ?> &nbsp;</h4></td>

        <td>&nbsp; <?php echo $row["numSeqCom"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["numArt"]; ?> &nbsp;</td>
        <td>&nbsp; <?= ($row["likeC"] == 1) ? "Oui" : "Non" ?> &nbsp;</td>


		<td>&nbsp;<a href="./updateLikeCom.php?id=<?=$row["numMemb"]; ?>"><i>Modifier</i></a>&nbsp;
		<br /></td>
		<td>&nbsp;<a href="./deleteAngle.php?id=<?=$row["numMemb"]; ?>"><i>Supprimer</i></a>&nbsp;
		<br /></td>
        </tr>
<?
	}	// End of foreach
?>
    </tbody>
    </table>
    <br><br>

<?
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
