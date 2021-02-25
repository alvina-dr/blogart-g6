<?
/////////////////////////////////////////////////////
//
//  CRUD ARTICLE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : article.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
global $db; 
$monStatutArt = new ARTICLE;

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
<? // ON RÉCUPÈRE L'ID DE L'ARTICLE QUE L'ON VEUT MODIFIER
   
    if (isset($_GET['id']) and $_GET['id'] > 0) {

        $numArt = ctrlSaisies(($_GET['id']));

        $query = (array)$monArticle->get_1Art($numArt);

        if ($query) {
            $libTitrArt = $query['libTitrArt'];
            $libChapoArt = $query['libChapoArt'];
            $libAccrochArt = $query['libAccrochArt'];
            $parag1Art = $query['parag1Art'];
            $libSsTitr1Art = $query['libSsTitr1Art'];
            $parag2Art = $query['parag2Art'];
            $libSsTitr2Art = $query['libSsTitr2Art'];
            $parag3Art = $query['parag3Art'];
            $libConclArt = $query['libConclArt'];
            $idAngl = $query['numAngl'];
            $idThem = $query['numThem'];

        }   // Fin if ($query)
    }   // Fin if (isset($_GET['id'])...)
?>
<table border="3" bgcolor="aliceblue">
<thead>
    <tr>
    <th>&nbsp;numArt&nbsp;</th>
        <th>&nbsp;libTitrArt&nbsp;</th>
        <th>&nbsp;libChapoArt&nbsp;</th>
        <th>&nbsp;libAccrochArt&nbsp;</th>
        <th>&nbsp;parag1Art&nbsp;</th>
        <th>&nbsp;libSsTitr1Art&nbsp;</th>
        <th>&nbsp;parag2Art&nbsp;</th>
        <th>&nbsp;libSsTitr2Art&nbsp;</th>
        <th>&nbsp;parag3Art&nbsp;</th>
        <th>&nbsp;libConclArt&nbsp;</th>
        <th>&nbsp;urlPhotArt&nbsp;</th>
        <th>&nbsp;numAngl&nbsp;</th>
        <th>&nbsp;numThem&nbsp;</th>
        <th colspan="2">&nbsp;Action&nbsp;</th>
        
    </tr>
</thead>
<tbody>

<?
$allStatuts = $monStatutArt->get_SomeArt();
foreach($allStatuts as $row) {
// Appel méthode : tous les statuts en BDD
?>
    <tr>
    <td><h4>&nbsp; <?= $row["numArt"]; ?> &nbsp;</h4></td>

    <td>&nbsp; <?php echo $row["libTitrArt"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["libChapoArt"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["libAccrochArt"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["parag1Art"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["libSsTitr1Art"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["parag2Art"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["libSsTitr2Art"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["parag3Art"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["libConclArt"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["urlPhotArt"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["numAngl"]; ?> &nbsp;</td>
    <td>&nbsp; <?php echo $row["numThem"]; ?> &nbsp;</td>

    <td>&nbsp;<a href="./updateArticle.php?id=<?=$row["numArt"]; ?>"><i>Modifier</i></a>&nbsp;
    <br /></td>
    <td>&nbsp;<a href="./deleteArticle.php?id=<?=$row["numArt"]; ?>"><i>Supprimer</i></a>&nbsp;
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