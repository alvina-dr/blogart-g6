<?php
///////////////////////////////////////////////////////////////
//
//  CRUD STATUT (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : updateThematique.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';


    // controle des saisies du formulaire


    // insertion classe STATUT
    require_once __DIR__ . '/../../util/ctrlSaisies.php';
    require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
    global $db;
    $maThematique = new THEMATIQUE;


    // Gestion du $_SERVER["REQUEST_METHOD"] => En POST
    // ajout effectif du statut
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Opérateur ternaire
        $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

        if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

            header("Location: ./updateThem.php");
        }   // End of if ((isset($_POST["submit"])) ...

        // Mode création
        if (((isset($_POST['id'])) AND !empty($_POST['id']))
            AND((isset($_POST['libThem'])) AND !empty($_POST['libThem']))
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))
            AND ((isset($_POST['numLang'])) AND !empty($_POST['numLang']))) {
            // Saisies valides 
            $erreur = false;

            $libThem = ctrlSaisies(($_POST['libThem']));
            $numLang = ctrlSaisies($_POST['numLang']);
            $numThem = ($_POST['id']);

            $maThematique->update($numThem, $libThem, $numLang);

            header("Location: ./thematique.php");
        }   // Fin if ((isset($_POST['libStat'])) ...
        else {
        $erreur = true;
        $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // End of else erreur saisies
        // End of else erreur saisies

    }   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

    // Init variables form
    include __DIR__ . '/initThematique.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Thématique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link rel="stylesheet" href="../../front/assets/css/normalize.css">
    <link rel="stylesheet" href="../css/footer.css">

</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Thématique</h1>
    <h2>Modification d'une thématique</h2>
<?
    // Modif : récup id à modifier
    if (isset($_GET['id']) and !empty($_GET['id'])) {

        $id = ctrlSaisies(($_GET['id']));

        $query = (array)$maThematique->get_1ThemByLangue($id);

        if ($query) {
            $libThem = $query['libThem'];
            $numLang = $query['numLang'];
            $lib1Lang = $query['lib1Lang'];
        }   // Fin if ($query)
    }   // Fin if (isset($_GET['id'])...)


?>
    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

      <fieldset>
        <legend class="legend1">Formulaire Thématique...</legend>

        <input type="hidden" id="id" name="id" value="<?= $_GET['id']; ?>" />

        <div class="control-group">
            <label class="control-label" for="libThem"><b>Nouveau nom de la thématique :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libThem" id="libThem" size="80" maxlength="80" value="<?= $libThem; ?>" autofocus="autofocus" />
        </div>
        <div class="control-group">
            <label for="numLang">Langue :</label>  
            <select id="numLang" name="numLang"  onchange="select()">
            <?php 
            global $db;
            $requete = 'SELECT * FROM LANGUE ;';
            $result = $db->query($requete);
            $allLangue = $result->fetchAll();
            foreach ($allLangue AS $langue)
            {
            ?>
            <option value="<?= ($langue['numLang']); ?>" <?= (isset($numLang) && $numLang == $langue['numLang'] ) ? " selected=\"selected\"" : null; ?> >
                <?= $langue['lib1Lang']; ?>
            </option>
            <?php
            }
            ?>
            </select>
        </div>

        <div class="control-group">
            <div class="controls">
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Initialiser" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                <br>
            </div>
        </div>
      </fieldset>
    </form>
<?php
require_once __DIR__ . '/footerThematique.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
