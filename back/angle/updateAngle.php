<?
///////////////////////////////////////////////////////////////
//
//  CRUD STATUT (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : updateStatut.php  (ETUD)   -   BLOGART21
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

    // modification effective du statut
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Opérateur ternaire
        $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

        if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

            $sameId = $_POST['id'];
            header("Location: ./updateAngle.php?id=".$sameId);
        }   // End of if ((isset($_POST["submit"])) ...

        if ((isset($_POST['id']) AND $_POST['id'])
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

        if (((isset($_POST['libAngl'])) AND !empty($_POST['libAngl']))
        AND ((isset($_POST['numLang'])) AND !empty($_POST['numLang']))
        AND (!empty($_POST['id']) AND !empty($_POST['id']))) {

                // Saisies valides
                $erreur = false;

                $numAngl = ctrlSaisies(($_POST['id']));;
                $libAngl = ctrlSaisies(($_POST['libAngl']));
                $numLang = ctrlSaisies(($_POST['numLang']));

                $monAngle->update($numAngl, $libAngl, $numLang);


                header("Location: ./angle.php");
            }   // Fin if ((isset($_POST['legendImg'])) ...
            else {
                $erreur = true;
                $errSaisies =  "Erreur, la saisie est obligatoire !";
            }   // Fin else Saisies invalides
       }   // Fin maj
    }   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")


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

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Angle</h1>
    <h2>Ajout d'une Langue</h2>

    <?
    // Modif : récup id à modifier
    if (isset($_GET['id']) and $_GET['id']) {

        $numAngl = ctrlSaisies(($_GET['id']));

        $query = (array)$monAngle->get_1Angle($numAngl);

        if ($query) {
            $numAngl = $query['numAngl'];
            $libAngl = $query['libAngl'];
            $numLang = $query['numLang'];
        }   // Fin if ($query)
    }   // Fin if (isset($_GET['id'])...)
?>

    <form method="post" action="./updateAngle.php" enctype="multipart/form-data">

      <fieldset>
        <legend class="legend1">Formulaire Angle...</legend>
        <br>
        <div class="control-group">
            <label class="control-label" for="libAngl"><b>Angle (Exemple : Insolite) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libAngl" id="libAngl" size="80" maxlength="30" value="<?= $libAngl; ?>" autofocus="autofocus" />
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="numLang"><b>Langue (Exemple : FRAN01) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="numLang" id="numLang" size="80" maxlength="30" value="<?= $numLang; ?>" autofocus="autofocus" />
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