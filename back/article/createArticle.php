<?
///////////////////////////////////////////////////////////////
//
//  CRUD ANGLE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : createStatut.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Récup dernière PK NumLang
require_once __DIR__ . '/../../CLASS_CRUD/getNextNumAngl.php';

    // insertion classe STATUT
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
global $db;
$monArticle = new ARTICLE;
// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

    // Gestion du $_SERVER["REQUEST_METHOD"] => En POST
    // ajout effectif du statut 

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

      // Opérateur ternaire
      $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

      if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

          header("Location: ./createArticle.php");
      }   // End of if ((isset($_POST["submit"])) ...

      
      if (((isset($_POST['libTitrArt'])) AND !empty($_POST['libTitrArt']))
            AND ((isset($_POST['libChapoArt'])) AND !empty($_POST['libChapoArt']))
            AND ((isset($_POST['libAccrochArt'])) AND !empty($_POST['libAccrochArt']))
            AND ((isset($_POST['parag1Art'])) AND !empty($_POST['parag1Art']))
            AND ((isset($_POST['libSsTitr1Art'])) AND !empty($_POST['libSsTitr1Art']))
            AND ((isset($_POST['parag2Art'])) AND !empty($_POST['parag2Art']))
            AND ((isset($_POST['libSsTitr2Art'])) AND !empty($_POST['libSsTitr2Art']))
            AND ((isset($_POST['parag3Art'])) AND !empty($_POST['parag3Art']))
            AND ((isset($_POST['libConclArt'])) AND !empty($_POST['libConclArt']))
            AND ((isset($_POST['urlPhotArt'])) AND !empty($_POST['urlPhotArt']))
            AND ((isset($_POST['numAngl'])) AND !empty($_POST['numAngl']))
            AND ((isset($_POST['numThem'])) AND !empty($_POST['numThem'])){

            // Saisies valides
            $erreur = false;
                
            $numArt = 0;
            $libTitrArt = ctrlSaisies(($_POST['libTitrArt']));
            $libChapoArt = ctrlSaisies(($_POST['libChapoArt']));
            $libAccrochArt = ctrlSaisies(($_POST['libAccrochArt']));
            $parag1Art = ctrlSaisies(($_POST['parag1Art']));
            $libSsTitr1Art = ctrlSaisies(($_POST['libSsTitr1Art']));
            $parag2Art = ctrlSaisies(($_POST['parag2Art']));
            $libSsTitr2Art = ctrlSaisies(($_POST['libSsTitr2Art']));
            $parag3Art = ctrlSaisies(($_POST['parag3Art']));
            $urlPhotArt = ctrlSaisies(($_POST['urlPhotArt']));
            $numAngl = ctrlSaisies(($_POST['numAngl']));
            $numThem = ctrlSaisies(($_POST['numThem']));


        }   // Fin if ((isset($_POST['legendImg'])) ...
        else {
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // Fin else erreur saisies

  }   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

    // Init variables form
    include __DIR__ . '/initArticle.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Article</h1>
    <h2>Ajout d'un Article </h2>

    <form method="post" action="./createArticle.php" enctype="multipart/form-data">

      <fieldset>
        <legend class="legend1">Formulaire Article...</legend>
        <br>
        <!-- Titre -->
        <div class="control-group">
            <label class="control-label" for="libTitrArt"><b>Titre Article (Exemple : Pourquoi les canards aiment le pain ?) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libTitrArt" id="libTitrArt" size="150" maxlength="150" value="<?= $libTitrArt; ?>" autofocus="autofocus" />
        </div>
        <br>
        <!-- Chapeau -->
        <div class="control-group">
            <label class="control-label" for="libChapoArt"><b>Chapeau introductif :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libChapoArt" id="libChapoArt" size="200" maxlength="200" value="<?= $libChapoArt; ?>" autofocus="autofocus" />
        </div>
        <br>
        <!-- Accroche -->
        <div class="control-group">
            <label class="control-label" for="libAccrochArt"><b>Accroche :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libAccrochArt" id="libAccrochArt" size="200" maxlength="200" value="<?= $libAccrochArt; ?>" autofocus="autofocus" />
        </div>
        <br>
        <!-- Paragraphe 1 -->
        <div class="control-group">
            <label class="control-label" for="parag1Art"><b>Paragraphe 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="parag1Art" id="parag1Art" size="2000" maxlength="2000" value="<?= $parag1Art; ?>" autofocus="autofocus" />
        </div>
        <br>
        <!-- Sous titre 1 -->
        <div class="control-group">
            <label class="control-label" for="libSsTitr1Art"><b>Premier Sous Titre :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libSsTitr1Art" id="libSsTitr1Art" size="150" maxlength="150" value="<?= $libSsTitr1Art; ?>" autofocus="autofocus" />
        </div>
        <br>
        <!-- Paragraphe 2 -->
        <div class="control-group">
            <label class="control-label" for="parag2Art"><b>Paragraphe 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="parag2Art" id="parag2Art" size="2000" maxlength="2000" value="<?= $parag2Art; ?>" autofocus="autofocus" />
        </div>
        <br>
        <!-- Sous titre 2 -->
        <div class="control-group">
            <label class="control-label" for="libSsTitr2Art"><b>Second Sous Titre ::&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libSsTitr2Art" id="libSsTitr2Art" size="150" maxlength="150" value="<?= $libSsTitr2Art; ?>" autofocus="autofocus" />
        </div>
        <br>
        <!-- Paragraphe 3 -->
        <div class="control-group">
            <label class="control-label" for="parag3Art"><b>Paragraphe 3 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="parag3Art" id="parag3Art" size="2000" maxlength="2000" value="<?= $parag3Art; ?>" autofocus="autofocus" />
        </div>
        <br>
        <!-- Conclusion -->
        <div class="control-group">
            <label class="control-label" for="libConclArt"><b>Conclusion :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libConclArt" id="libConclArt" size="800" maxlength="800" value="<?= $libSsTitr2Art; ?>" autofocus="autofocus" />
        </div>
        <br>
        <!-- Url Photo -->
        <div class="control-group">
            <label class="control-label" for="urlPhotArt"><b>Photo :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="urlPhotArt" id="urlPhotArt" size="2000" maxlength="2000" value="<?= $urlPhotArt; ?>" autofocus="autofocus" />
        </div>
        <br>
        <!-- FK : Angl -->
    <!-- Listbox Angl -->
    <br>
        <div class="control-group">
            <label class="control-label" for="LibTypLang"><b>Quelle langue :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idTypLang" name="idTypLang" value="<?= isset($_GET['numLang']) ? $_GET['numLang'] : '' ?>" />

                <select size="1" name="TypLang" id="TypLang" required class="form-control form-control-create" title="Sélectionnez la langue !" >
                   <option value="-1">- - - Choisissez une langue - - -</option>
<?
            $numLang = "";
            $lib1Lang = "";

            $queryText = 'SELECT * FROM LANGUE ORDER BY lib1Lang;';
            $result = $db->query($queryText);
            if ($result) {
                while ($tuple = $result->fetch()) {
                    $ListNumLang = $tuple["numLang"];
                    $ListLibLang = $tuple["lib1Lang"];
?>
                    <option value="<?= $ListNumLang; ?>" >
                        <?= $ListLibLang; ?>
                    </option>
<?
                } // End of while
            }   // if ($result)
?>
                </select>
        </div>
    <!-- FIN Listbox langue -->
        </div>
        <br>

        <div class="control-group">
            <div class="controls">
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Initialiser" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" value="on"/>
                <br>       
            </div>
        </div>
      </fieldset>
    </form>
<?
require_once __DIR__ . '/footerAngle.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
