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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <br>
<h2>COMMENTAIRES</h2>
<img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE-->

<table border="3" bgcolor="aliceblue" class="table_comment">
<tbody>
<?
$allStatuts = $monStatutCom->get_SomeCom2();
foreach($allStatuts as $row) {
// Appel méthode : tous les statuts en BDD
?>
    <tr>
    <!--td>&nbsp; <?php echo $row["numArt"]; ?> &nbsp;</td--> <!--DONNÉES COLONNE NUMÉRO DE L'ARTICLE-->
    <td>&nbsp; <?php echo $row["dtCreCom"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["libCom"]; ?> &nbsp;</td>
    <br /></td>
    </tr>
<?
}	// End of foreach
?>
</tbody>
</table>
<br><br>

</body>
</html>
