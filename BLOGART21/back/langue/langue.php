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

    <br><br>

<?
 $allStatuts = $monStatutL->get_AllStatuts();
 foreach($allStatuts as $row) {
	// Appel méthode : tous les statuts en BDD
?>
        <tr>
		<td><h4>&nbsp; <?= $row["numLang"]; ?> &nbsp;</h4></td>

        <td>&nbsp; <?php echo $row["lib1Lang"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["lib2Lang"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["frPays"]; ?> &nbsp;</td>

		<td>&nbsp;<a href="./updateStatut.php?id=<?=1 ?>"><i>Modifier</i></a>&nbsp;
		<br /></td>
		<td>&nbsp;<a href="./deleteStatut.php?id=<?=1 ?>"><i>Supprimer</i></a>&nbsp;
		<br /></td>
        </tr>
<?
	}	// End of foreach
?>

    <br><br>

<?
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
