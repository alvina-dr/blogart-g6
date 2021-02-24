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

      if ((isset($_POST['Submit'])) AND ($Submit === 'Initialiser')) {
        header("Location: ./createArticle.php");
        exit();
      }   // End of if ((isset($_POST["submit"])) ...


      if (((isset($_POST['libTitrArt'])) AND !empty($_POST['libTitrArt']))
            AND (isset($_POST['id'])) AND !empty($_POST['id'])
            AND ((isset($_POST['libChapoArt'])) AND !empty($_POST['libChapoArt']))
            AND ((isset($_POST['libAccrochArt'])) AND !empty($_POST['libAccrochArt']))
            AND ((isset($_POST['parag1Art'])) AND !empty($_POST['parag1Art']))
            AND ((isset($_POST['libSsTitr1Art'])) AND !empty($_POST['libSsTitr1Art']))
            AND ((isset($_POST['parag2Art'])) AND !empty($_POST['parag2Art']))
            AND ((isset($_POST['libSsTitr2Art'])) AND !empty($_POST['libSsTitr2Art']))
            AND ((isset($_POST['parag3Art'])) AND !empty($_POST['parag3Art']))
            AND ((isset($_POST['libConclArt'])) AND !empty($_POST['libConclArt']))
            // AND ((isset($_POST['urlPhotArt'])) AND !empty($_POST['urlPhotArt']))
            AND ((isset($_POST['TypAngl'])) AND !empty($_POST['TypAngl']))
//
// Erreur nom var numThem => TypThem
//
            AND ((isset($_POST['TypThem'])) AND !empty($_POST['TypThem']))
//
// Erreur : Ajout Submit => "valider"
//

        AND (!empty($_POST['Submit']) AND ($Submit == "Valider"))) {

            // Saisies valides
            $erreur = false;

            $libTitrArt = ctrlSaisies(($_POST['libTitrArt']));
            $libChapoArt = ctrlSaisies(($_POST['libChapoArt']));
            $libAccrochArt = ctrlSaisies(($_POST['libAccrochArt']));
            $parag1Art = ctrlSaisies(($_POST['parag1Art']));
            $libSsTitr1Art = ctrlSaisies(($_POST['libSsTitr1Art']));
            $parag2Art = ctrlSaisies(($_POST['parag2Art']));
            $libSsTitr2Art = ctrlSaisies(($_POST['libSsTitr2Art']));
            $parag3Art = ctrlSaisies(($_POST['parag3Art']));

            //$urlPhotArt = ctrlSaisies(($_POST['urlPhotArt']));
            $urlPhotArt = -1;

            $numAngl = ctrlSaisies(($_POST['TypAngl']));
            $numThem = ctrlSaisies(($_POST['TypThem']));

//
// erreur id => auto-incrément
//
            // $monArticle->create($numArt, $libTitrArt, $libChapoArt, $libAccrochArt, $parag1Art, $libSsTitr1Art, $parag2Art, $libSsTitr2Art, $parag3Art, $urlPhotArt, $TypAngl, $numThem);

            $monArticle->create($libTitrArt, $libChapoArt, $libAccrochArt, $parag1Art, $libSsTitr1Art, $parag2Art, $libSsTitr2Art, $parag3Art, $numAngl, $numThem);


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

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Article</h1>
    <h2>Ajout d'un Article </h2>

    <?
    // Modif : récup id à modifier
    if (isset($_GET['id']) and $_GET['id']) {

        $numArt = ctrlSaisies(($_GET['id']));

        $query = (array)$monArticle->get_1Art($numArt);

        if ($query) {
            $libTitrArt = $query['libT$libTitrArt'];
            $libChapoArt = $query['libChapoArt'];
            $libAccrochArt = $query['libAccrochArt'];
            $parag1Art = $query['parag1Art'];
            $libSsTitr1Art = $query['libSsTitr1Art'];
            $parag2Art = $query['parag2Art'];
            $libSsTitr2Art = $query['libSsTitr2Art'];
            $parag3Art = $query['parag3Art'];
            $numAngl = $query['numAngl'];
            $numThem = $query['numThem'];

        }   // Fin if ($query)
    }   // Fin if (isset($_GET['id'])...)
?>

<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">


      <fieldset>
        <legend class="legend1">Formulaire Article...</legend>
        <input type="hidden" id="id" name="id" value="<?= $_GET['id']; ?>" />
        <br>
        <!-- Titre -->
        <div class="control-group">
            <label class="control-label" for="libTitrArt"><b>Titre Article (Exemple : Pourquoi les canards aiment le pain ?) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <textarea type="text" name="libTitrArt" id="libTitrArt" maxlength="150" value="<?= $libTitrArt; ?>" autofocus="autofocus" style="margin: 0px; width: 500px; height: 25px;"></textarea>
        </div>
        <br>
        <!-- Chapeau -->
        <div class="control-group">
            <label class="control-label" for="libChapoArt"><b>Chapeau introductif :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <textarea type="text" name="libChapoArt" id="libChapoArt" size="200" maxlength="200" value="<?= $libChapoArt; ?>" autofocus="autofocus" style="margin: 0px; width: 500px; height: 25px;"></textarea>
        </div>
        <br>
        <!-- Accroche -->
        <div class="control-group">
            <label class="control-label" for="libAccrochArt"><b>Accroche :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <textarea type="text" name="libAccrochArt" id="libAccrochArt" size="200" maxlength="200" value="<?= $libAccrochArt; ?>" autofocus="autofocus" style="margin: 0px; width: 500px; height: 50px;"></textarea>
        </div>
        <br>
        <!-- Paragraphe 1 -->
        <div class="control-group">
            <label class="control-label" for="parag1Art"><b>Paragraphe 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <textarea type="text" name="parag1Art" id="parag1Art" size="2000" maxlength="2000" value="<?= $parag1Art; ?>" autofocus="autofocus" style="margin: 0px; width: 500px; height: 150px;"></textarea>
        </div>
        <br>
        <!-- Sous titre 1 -->
        <div class="control-group">
            <label class="control-label" for="libSsTitr1Art"><b>Premier Sous Titre :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <textarea type="text" name="libSsTitr1Art" id="libSsTitr1Art" size="150" maxlength="150" value="<?= $libSsTitr1Art; ?>" autofocus="autofocus" style="margin: 0px; width: 500px; height: 25px;"></textarea>
        </div>
        <br>
        <!-- Paragraphe 2 -->
        <div class="control-group">
            <label class="control-label" for="parag2Art"><b>Paragraphe 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <textarea type="text" name="parag2Art" id="parag2Art" size="2000" maxlength="2000" value="<?= $parag2Art; ?>" autofocus="autofocus" style="margin: 0px; width: 500px; height: 150px;"></textarea>
        </div>
        <br>
        <!-- Sous titre 2 -->
        <div class="control-group">
            <label class="control-label" for="libSsTitr2Art"><b>Second Sous Titre :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <textarea type="text" name="libSsTitr2Art" id="libSsTitr2Art" size="150" maxlength="150" value="<?= $libSsTitr2Art; ?>" autofocus="autofocus" style="margin: 0px; width: 500px; height: 25px;"></textarea>
        </div>
        <br>
        <!-- Paragraphe 3 -->
        <div class="control-group">
            <label class="control-label" for="parag3Art"><b>Paragraphe 3 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <textarea type="text" name="parag3Art" id="parag3Art" size="2000" maxlength="2000" value="<?= $parag3Art; ?>" autofocus="autofocus" style="margin: 0px; width: 500px; height: 150px;"></textarea>
        </div>
        <br>
        <!-- Conclusion -->
        <div class="control-group">
            <label class="control-label" for="libConclArt"><b>Conclusion :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <textarea type="text" name="libConclArt" id="libConclArt" size="800" maxlength="800" value="<?= $libConclArt; ?>" autofocus="autofocus" style="margin: 0px; width: 500px; height: 25px;"></textarea>
        </div>
        <br>
        <!-- Url Photo -->
        <div class="control-group">
            <label class="control-label" for="urlPhotArt"><b>Photo :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="file" name="urlPhotArt"  accept="image/png, image/jpeg" id="urlPhotArt" size="2000" maxlength="2000" value="<?= $urlPhotArt; ?>" autofocus="autofocus" style="margin: 0px; width: 500px; height: 25px;" />
        </div>
        <br>
        <!-- FK : Angl -->
    <!-- Listbox Angl -->
    <br>
        <div class="control-group">
            <label class="control-label" for="LibTypAngl"><b>Quel Angle :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idTypAngl" name="idTypAngl" value="<?= isset($_GET['numAngl']) ? $_GET['numAngl'] : '' ?>" />

                <select size="1" name="TypAngl" id="TypAngl" required class="form-control form-control-create" title="Sélectionnez l'Angle !" >
                   <option value="-1">Choisissez un Angle </option>
<?
            $numAngl = "";
            $libAngl = "";

            $queryText = 'SELECT * FROM ANGLE ORDER BY numAngl;';
            $result = $db->query($queryText);
            if ($result) {
                while ($tuple = $result->fetch()) {
                    $ListNumAngl = $tuple["numAngl"];
                    $ListLibAngl = $tuple["libAngl"];
?>
                    <option value="<?= $ListNumAngl; ?>" >
                        <?= $ListLibAngl; ?>
                    </option>
<?
                } // End of while
            }   // if ($result)
?>
                </select>
        </div>
    <!-- FIN Angle -->
        </div>
        <br>
<!-- FK : Them -->
    <!-- Listbox Them -->
    <br>
        <div class="control-group">
            <label class="control-label" for="LibTypThem"><b>Quelle Thématique :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idTypThem" name="idTypThem" value="<?= isset($_GET['numThem']) ? $_GET['numThem'] : '' ?>" />

                <select size="1" name="TypThem" id="TypThem" required class="form-control form-control-create" title="Sélectionnez le Them !" >
                   <option value="-1">Choisissez un Thème </option>
<?
            $numThem = "";
            $libthem = "";

            $queryText = 'SELECT * FROM THEMATIQUE ORDER BY numThem;';
            $result = $db->query($queryText);
            if ($result) {
                while ($tuple = $result->fetch()) {
                    $ListNumThem = $tuple["numThem"];
                    $ListfrThem = $tuple["libThem"];
?>
                    <option value="<?= $ListNumThem; ?>" >
                        <?= $ListfrThem; ?>
                    </option>
<?
                } // End of while
            }   // if ($result)
?>
                </select>
        </div>
    <!-- FIN Listbox Pays -->
        </div>
        <br>
        <div class="control-group">
            <div class="controls">
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Initialiser" class="imputFields" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
<!-- ------------------------------------- -->
<!--  Erreur 2 VALUE dans input "VALIDER"  -->
<!-- ------------------------------------- -->
                <input type="submit" value="Valider" class="imputFields" name="Submit" />
                <br>
            </div>
        </div>
      </fieldset>
    </form>
<?
require_once __DIR__ . '/footerArticle.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
