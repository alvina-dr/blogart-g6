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
    <title>Admin - Gestion du CRUD Article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>BLOGART21 Admin - Gestion du CRUD ARTICLE</h1>

<img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
<h2>Nouvel ARTICLE :&nbsp;<a href="./createArticle.php"><i>Créer un ARTICLE</i></a></h2>
<img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
<h2>Tous les ARTICLES</h2>

<table border="3" bgcolor="aliceblue">
<thead>
    <tr>
    <th>&nbsp;Numéro de l'article&nbsp;</th>
        <th>&nbsp;Nom du titre de l'article&nbsp;</th>
        <th>&nbsp;Nom du chapeau de l'article&nbsp;</th>
        <th>&nbsp;Nom de l'accroche de l'article&nbsp;</th>
        <th>&nbsp;Paragraphe du premier article&nbsp;</th>
        <th>&nbsp;Nom des sous titres du premier article&nbsp;</th>
        <th>&nbsp;Paragraphe du deuxième article&nbsp;</th>
        <th>&nbsp;Nom des sous titres du deuxième article&nbsp;</th>
        <th>&nbsp;Paragraphe du troisième article&nbsp;</th>
        <th>&nbsp;Nom de la conclusion de l'article&nbsp;</th>
        <th>&nbsp;URL de la photo de l'article&nbsp;</th>
        <th>&nbsp;Numéro de l'angle&nbsp;</th>
        <th>&nbsp;Numéro du thème&nbsp;</th>
        <th colspan="2">&nbsp;Action&nbsp;</th>
        
    </tr>
</thead>
<tbody>

<?
$allStatuts = $monStatutArt->get_AllArt();
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

<?
require_once __DIR__ . '/footer.php';
?>
</body>
</html>