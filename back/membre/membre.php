<?
/////////////////////////////////////////////////////
//
//  CRUD MEMBRE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : membre.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
global $db; 
$monStatutMM = new MEMBRE;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Membre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Membre</h1>

    <img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
	<h2>Nouveau membre :&nbsp;<a href="./createMembre.php"><i>Créer un membre</i></a></h2>
    <img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
	<h2>Tous les MEMBRES</h2>

    <br><br>
    <table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
        <th>&nbsp;numMemb&nbsp;</th>
            <th>&nbsp;prenomMemb&nbsp;</th>
            <th>&nbsp;nomMemb&nbsp;</th>
            <th>&nbsp;pseudoMemb&nbsp;</th>
            <th>&nbsp;passMemb&nbsp;</th>
            <th>&nbsp;eMailMemb&nbsp;</th>
            <th>&nbsp;dtCreaMemb&nbsp;</th>
            <th>&nbsp;souvenirMemb&nbsp;</th>
            <th>&nbsp;accordMemb&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
            
        </tr>
    </thead>
    <tbody>

    <?
 $allStatuts = $monStatutMM->get_AllMembre();
 foreach($allStatuts as $row) {
	// Appel méthode : tous les statuts en BDD
?>
        <tr>
		<td><h4>&nbsp; <?= $row["numMemb"]; ?> &nbsp;</h4></td>

        <td>&nbsp; <?php echo $row["prenomMemb"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["nomMemb"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["pseudoMemb"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["passMemb"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["eMailMemb"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["dtCreaMemb"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["souvenirMemb"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["accordMemb"]; ?> &nbsp;</td>
    
		<td>&nbsp;<a href="./updateMembre.php?id=<?=$row["numMemb"]; ?>"><i>Modifier</i></a>&nbsp;
		<br /></td>
		<td>&nbsp;<a href="./deleteMembre.php?id=<?=$row["numMemb"]; ?>"><i>Supprimer</i></a>&nbsp;
		<br /></td>
        </tr>
<?
	}	// End of foreach
?>
    </tbody>
    </table>
    <br><br>

    <br><br>

<?
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
