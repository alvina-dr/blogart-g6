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
require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';
global $db;
$monAngle = new ANGLE;
// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

    // Gestion du $_SERVER["REQUEST_METHOD"] => En POST
    // ajout effectif du statut 

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

      // Opérateur ternaire
      $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

      if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

          header("Location: ./createAngle.php");
      }   // End of if ((isset($_POST["submit"])) ...

      
      if (((isset($_POST['libAngl'])) AND !empty($_POST['libAngl']))
            AND ((isset($_POST['TypLang'])) AND !empty($_POST['TypLang']))
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

            // Saisies valides
            $erreur = false;
                
            $numAngl = 0;
            $libAngl = ctrlSaisies(($_POST['libAngl']));
            $numLang = ctrlSaisies(($_POST['TypLang']));
            

            // Récup dernière PK numLang
            $numNextAngl = getNextNumAngl($numLang);

            $monAngle->create($numNextAngl, $libAngl, $numLang);

            //header("Location: ./langue.php");

        }   // Fin if ((isset($_POST['legendImg'])) ...
        else {
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // Fin else erreur saisies

  }   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

    // Init variables form
    include __DIR__ . '/initAngle.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Angle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Angle</h1>
    <h2>Ajout d'un angle </h2>

    <form method="post" action="./createAngle.php" enctype="multipart/form-data">

      <fieldset>
        <legend class="legend1">Formulaire Angle...</legend>
        <br>
        <div class="control-group">
            <label class="control-label" for="libAngl"><b>Angle (Exemple : Insolite) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libAngl" id="libAngl" size="80" maxlength="30" value="<?= $libAngl; ?>" autofocus="autofocus" />
        </div>
        <br>
        <!-- FK : Langue -->
    <!-- Listbox langue -->
    <br>
        <div class="control-group">
            <label class="control-label" for="LibTypLang"><b>Quelle langue :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idTypLang" name="idTypLang" value="<?= isset($_GET['numLang']) ? $_GET['numLang'] : '' ?>" />

                <select size="1" name="TypLang" id="TypLang" required class="form-control form-control-create" title="Sélectionnez la langue !" >
                   <option value="-1">Choisissez une langue </option>
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
                <input type="submit" value="Initialiser" class="imputFields" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" class="imputFields" name="Submit" value="on"/>
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
