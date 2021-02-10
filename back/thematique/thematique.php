<?
/////////////////////////////////////////////////////
//
//  CRUD THEME (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : angle.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
global $db; 
$monStatutT = new THEMATIQUE;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD THEMATIQUE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD THEMATIQUE</h1>

    <hr /><br />
	<h2>Nouvelle THEMATIQUE :&nbsp;<a href="./createThematique.php"><i>Créer une Thématique</i></a></h2>
	<br /><hr />
	<h2>Tout les THEMATIQUE</h2>

	<table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
        <th>&nbsp;numThem&nbsp;</th>
            <th>&nbsp;libThem&nbsp;</th>
            <th>&nbsp;numLang&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
            
        </tr>
    </thead>
    <tbody>

<?
 $allStatuts = $monStatutT->get_AllTheme();
 foreach($allStatuts as $row) {
	// Appel méthode : tous les statuts en BDD
?>
        <tr>
		<td><h4>&nbsp; <?= $row["numThem"]; ?> &nbsp;</h4></td>

        <td>&nbsp; <?php echo $row["libThem"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["numLang"]; ?> &nbsp;</td>

		<td>&nbsp;<a href="./updateThematique.php?id=<?=$row["numThem"]; ?>"><i>Modifier</i></a>&nbsp;
		<br /></td>
		<td>&nbsp;<a href="./deleteThematique.php?id=<?=$row["numThem"]; ?>"><i>Supprimer</i></a>&nbsp;
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

