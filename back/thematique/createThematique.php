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
require_once __DIR__ . '/../../CLASS_CRUD/getNextNumThem.php';

    // insertion classe STATUT
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
global $db;
$maThematique = new THEMATIQUE;
// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

    // Gestion du $_SERVER["REQUEST_METHOD"] => En POST
    // ajout effectif du statut 

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

      // Opérateur ternaire
      $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

      if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

          header("Location: ./createThematique.php");
      }   // End of if ((isset($_POST["submit"])) ...

      
      if (((isset($_POST['libThem'])) AND !empty($_POST['libThem']))
            AND ((isset($_POST['numLang'])) AND !empty($_POST['numLang']))
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

            // Saisies valides
            $erreur = false;
                
            $numThem = 0;
            $libThem = ctrlSaisies(($_POST['libThem']));
            $numLang = ctrlSaisies(($_POST['numLang']));
            

            // Récup dernière PK numLang
            $numNextThem = getNextNumThem($numThem);

            $maThematique->create($numNextThem, $libThem, $numLang);

            //header("Location: ./langue.php");

        }   // Fin if ((isset($_POST['legendImg'])) ...
        else {
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // Fin else erreur saisies

  }   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

    // Init variables form
    include __DIR__ . '/initThematique.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD thematique</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD thematique</h1>
    <h2>Ajout d'une Thematique</h2>

    <form method="post" action="./createThematique.php" enctype="multipart/form-data">

      <fieldset>
        <legend class="legend1">Formulaire Thematique...</legend>
        <br>
        <div class="control-group">
            <label class="control-label" for="libThem"><b>Thématique (Exemple : Enquète) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libThem" id="libThem" size="80" maxlength="30" value="<?= $libThem; ?>" autofocus="autofocus" />
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
require_once __DIR__ . '/footerThematique.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
