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

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
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
        <th>&nbsp;Numéro du membre&nbsp;</th>
            <th>&nbsp;Prénom du membre&nbsp;</th>
            <th>&nbsp;Nom du membre&nbsp;</th>
            <th>&nbsp;Pseudo du membre&nbsp;</th>
            <th>&nbsp;Mot de passe du membre&nbsp;</th>
            <th>&nbsp;E-mail du membre&nbsp;</th>
            <th>&nbsp;Date de la création du membre&nbsp;</th>
            <th>&nbsp;Souvenir du membre&nbsp;</th>
            <th>&nbsp;Accord du membre&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
            
        </tr>
    </thead>
    <tbody>

    <?
 $allStatuts = $monStatutMM->get_AllMembre();
 foreach($allStatuts as $row)
 {
	// Appel méthode : tous les statuts en BDD
?>
        
        
        <tr>
		<td><h4>&nbsp; <?= $row["numMemb"]; ?> &nbsp;</h4></td>

        <td>&nbsp; <?php echo $row["prenomMemb"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["nomMemb"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["pseudoMemb"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["eMailMemb"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["dtCreaMemb"]; ?> &nbsp;</td>
        <td>&nbsp; <?= ($row["souvenirMemb"] == 1) ? "Oui" : "Non" ?> &nbsp;</td>
        <td>&nbsp; <?= ($row["accordMemb"] == 1) ? "Oui" : "Non" ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["idStat"]; ?> &nbsp;</td>
    
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

<!-- maurinette et paulinette tente le php -->