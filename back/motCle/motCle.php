<?
/////////////////////////////////////////////////////
//
//  CRUD MOTCLE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : motCle.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../CLASS_CRUD/motcle.class.php';
global $db; 
$monStatutMC = new MOTCLE;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Mot-Clé</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>BLOGART21 Admin - Gestion du CRUD MOTCLÉ</h1>

<img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
<h2>Nouveau mot clé :&nbsp;<a href="./createMotCle.php"><i>Créer un mot clé</i></a></h2>
<img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
<h2>Tous les MOTS CLÉS</h2>

<table border="3" bgcolor="aliceblue">
<thead>
    <tr>
    <th>&nbsp;numMotCle&nbsp;</th>
        <th>&nbsp;libMotCle&nbsp;</th>
        <th>&nbsp;numLang&nbsp;</th>
        <th colspan="2">&nbsp;Action&nbsp;</th>
        
    </tr>
</thead>
<tbody>

<?
$allStatuts = $monStatutMC->get_AllMotCle();
foreach($allStatuts as $row) {
// Appel méthode : tous les statuts en BDD
?>
    <tr>
    <td><h4>&nbsp; <?= $row["numMotCle"]; ?> &nbsp;</h4></td>

    <td>&nbsp; <?php echo $row["libMotCle"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["numLang"]; ?> &nbsp;</td>

    <td>&nbsp;<a href="./updateMotCle.php?id=<?=$row["numMotCle"]; ?>"><i>Modifier</i></a>&nbsp;
    <br /></td>
    <td>&nbsp;<a href="./deleteMotCle.php?id=<?=$row["numMotCle"]; ?>"><i>Supprimer</i></a>&nbsp;
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
