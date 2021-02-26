<?
/////////////////////////////////////////////////////
//
//  CRUD ANGLE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : angle.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';
global $db; 
$monStatutA = new ANGLE;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Angle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD ANGLE</h1>

    <img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
	<h2>Nouvel ANGLE :&nbsp;<a href="./createAngle.php"><i>Créer un angle</i></a></h2>
    <img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
	<h2>Tous les ANGLES</h2>

	<table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
        <th>&nbsp;Numéro de l'angle&nbsp;</th>
            <th>&nbsp;lNom de l'angle&nbsp;</th>
            <th>&nbsp;Numéro de la langue&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
            
        </tr>
    </thead>
    <tbody>

<?
 $allStatuts = $monStatutA->get_AllAngle();
 foreach($allStatuts as $row) {
	// Appel méthode : tous les statuts en BDD
?>
        <tr>
		<td><h4>&nbsp; <?= $row["numAngl"]; ?> &nbsp;</h4></td>

        <td>&nbsp; <?php echo $row["libAngl"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["lib1Lang"]; ?> &nbsp;</td>

		<td>&nbsp;<a href="./updateAngle.php?id=<?=$row["numAngl"]; ?>"><i>Modifier</i></a>&nbsp;
		<br /></td>
		<td>&nbsp;<a href="./deleteAngle.php?id=<?=$row["numAngl"]; ?>"><i>Supprimer</i></a>&nbsp;
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
