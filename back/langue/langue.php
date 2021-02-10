<?
/////////////////////////////////////////////////////
//
//  CRUD LANGUE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : langue.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
global $db; 
$monStatutL = new LANGUE;
?>

<!DOCTYPE html> 
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Langue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Langue</h1>

    <hr /><br />
	<h2>Nouvelle Langue :&nbsp;<a href="./createLangue.php"><i>Créer une Langue</i></a></h2>
	<br /><hr />
	<h2>Toute les Langues</h2>

	<table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
        <th>&nbsp;numLang&nbsp;</th>
            <th>&nbsp;langue&nbsp;</th>
            <th>&nbsp;Nom complet&nbsp;</th>
            <th>&nbsp;numPays&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
            
        </tr>
    </thead>
    <tbody>

<?
 $allStatuts = $monStatutL->get_AllLangues();
 foreach($allStatuts as $row) {
	// Appel méthode : tous les statuts en BDD
?>
        <tr>
		<td><h4>&nbsp; <?= $row["numLang"]; ?> &nbsp;</h4></td>

        <td>&nbsp; <?php echo $row["lib1Lang"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["lib2Lang"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["numPays"]; ?> &nbsp;</td>

		<td>&nbsp;<a href="./updateLangue.php?id=<?=$row["numLang"]; ?>"><i>Modifier</i></a>&nbsp;
		<br /></td>
		<td>&nbsp;<a href="./deleteLangue.php?id=<?=$row["numLang"]; ?>"><i>Supprimer</i></a>&nbsp;
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
