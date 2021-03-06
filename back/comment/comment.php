<?
/////////////////////////////////////////////////////
//
//  CRUD COMMENT (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : comment.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../CLASS_CRUD/comment.class.php';
global $db; 
$monStatutCom = new COMMENT;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Commentaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Commentaire</h1>

    <h2>Nouveau COMMENTAIRE :&nbsp;<a href="./createComment.php"><i>Créer un COMMENTAIRE</i></a></h2>
<img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
<h2>Tous les COMMENTAIRES</h2>

<table border="3" bgcolor="aliceblue">
<thead>
    <tr>
        <th>&nbsp;Numéro de la séquence du commentaire&nbsp;</th>
        <th>&nbsp;Numéro de l'article&nbsp;</th>
        <th>&nbsp;Date de la création du commentaire&nbsp;</th>
        <th>&nbsp;Nom du commentaire&nbsp;</th>
        <th>&nbsp;Validation du modérateur&nbsp;</th>
        <th>&nbsp;Visibilité du commentaire&nbsp;</th>
        <th>&nbsp;Motif du signalement&nbsp;</th>
        
        <th colspan="2">&nbsp;Action&nbsp;</th>
        
    </tr>
</thead>
<tbody>

<?
$allStatuts = $monStatutCom->get_AllCom();
foreach($allStatuts as $row) {
// Appel méthode : tous les statuts en BDD
?>
    <tr>
    <td><h4>&nbsp; <?= $row["numSeqCom"]; ?> &nbsp;</h4></td>

    <td>&nbsp; <?php echo $row["numArt"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["dtCreCom"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["libCom"]; ?> &nbsp;</td>
    <td>&nbsp; <?= ($row["attModOK"] == 1) ? "Oui" : "Non" ?> &nbsp;</td>
    <td>&nbsp; <?= ($row["affComOK"] == 1) ? "Oui" : "Non" ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["notifComKOAff"]; ?> &nbsp;</td>


    <td>&nbsp;<a href="./updateComment.php?id=<?=$row["numSeqCom"]; ?>"><i>Modifier</i></a>&nbsp;
    <br /></td>
    <td>&nbsp;<a href="./deleteComment.php?id=<?=$row["numSeqCom"]; ?>"><i>Supprimer</i></a>&nbsp;
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
