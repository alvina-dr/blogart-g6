<?
/////////////////////////////////////////////////////
//
//  CRUD COMMENTPLUS (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : commentPlus.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../CLASS_CRUD/commentPlus.class.php';
global $db; 
$monComPlus = new COMMENTPLUS;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Réponse au Commentaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Réponse au Commentaire</h1>

    <h2>Nouvelle RÉPONSE AU COMMENTAIRE :&nbsp;<a href="./createCommentPlus.php"><i>Créer une RÉPONSE AU COMMENTAIRE</i></a></h2>
<img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
<h2>Toutes les RÉPONSES AUX COMMENTAIRES</h2>

<table border="3" bgcolor="aliceblue">
<thead>
    <tr>
        <th>&nbsp;Numéro de la séquence du commentaire&nbsp;</th>
        <th>&nbsp;Numéro de l'article&nbsp;</th>
        <th>&nbsp;Numéro de la séquence du commentaire&nbsp;</th>
        <th>&nbsp;Numéro de l'article&nbsp;</th>

        <th colspan="2">&nbsp;Action&nbsp;</th>
        
    </tr>
</thead>
<tbody>

<?
$allStatuts = $monComPlus->get_AllComPlus();
foreach($allStatuts as $row) {
// Appel méthode : tous les statuts en BDD
?>
    <tr>
    <td><h4>&nbsp; <?= $row["numSeqCom"]; ?> &nbsp;</h4></td>
    <td>&nbsp; <?php echo $row["numArt"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["numSeqComR"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["numArtR"]; ?> &nbsp;</td>


    <td>&nbsp;<a href="./updateCommentPlus.php?id=<?=$row["numSeqCom"]; ?>"><i>Modifier</i></a>&nbsp;
    <br /></td>
    <td>&nbsp;<a href="./deleteCommentPlus.php?id=<?=$row["numSeqCom"]; ?>"><i>Supprimer</i></a>&nbsp;
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
