<?
///////////////////////////////////////////////////////////////
//
//  CRUD STATUT (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : createStatut.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Récup dernière PK NumLang
require_once __DIR__ . '/../../CLASS_CRUD/getNextNumLang.php';

    // insertion classe STATUT
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
global $db;
$maLangue = new LANGUE;
// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

  // Gestion du $_SERVER["REQUEST_METHOD"] => En POST
    // ajout effectif du statut 

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

      // Opérateur ternaire
      $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

      if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

          header("Location: ./createLangue.php");
      }   // End of if ((isset($_POST["submit"])) ...

      
      if (((isset($_POST['lib1Lang'])) AND !empty($_POST['lib1Lang']))
            AND ((isset($_POST['lib2Lang'])) AND !empty($_POST['lib2Lang']))
            AND ((isset($_POST['numPays'])) AND !empty($_POST['numPays']))
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

            // Saisies valides
            $erreur = false;
                
            $numLang = 0;
            $lib1Lang = ctrlSaisies(($_POST['lib1Lang']));
            $lib2Lang = ctrlSaisies(($_POST['lib2Lang']));
            $numPays = ctrlSaisies($_POST["numPays"]);

            // Récup dernière PK numLang
            $numNextLang = getNextNumLang($numPays);

            $maLangue->create($numNextLang, $lib1Lang, $lib2Lang, $numPays);

            //header("Location: ./langue.php");

        }   // Fin if ((isset($_POST['legendImg'])) ...
        else {
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // Fin else erreur saisies

  }   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

    // Init variables form
    include __DIR__ . '/initLangue.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Langue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Langue</h1>
    <h2>Ajout d'une Langue</h2>

    <form method="post" action="./createLangue.php" enctype="multipart/form-data">

      <fieldset>
        <legend class="legend1">Formulaire Langue...</legend>
        <br>
        <div class="control-group">
            <label class="control-label" for="lib1Lang"><b>Langue (Exemple : Allemand) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="lib1Lang" id="lib1Lang" size="80" maxlength="30" value="<?= $lib1Lang; ?>" autofocus="autofocus" />
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="lib2Lang"><b>Langue au féminin (Exemple : Langue Allemande) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="lib2Lang" id="lib2Lang" size="80" maxlength="30" value="<?= $lib2Lang; ?>" autofocus="autofocus" />
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="numPays"><b>Raccourci Pays (Exemple : ALLE pour l'Allemagne) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
<?
$arrayPays = array(
 
    'ALLEMAGNE' => 'ALLE',
    'ANGLETERRE' => 'ANGL',
    'BULGARIE' => 'BULG',
    'ESPAGNE' => 'ESPA',
    'FRANCE' => 'FRAN',
    'ITALIE' => 'ITAL',
    'RUSSIE' => 'RUSS',
    'UKRAINE' => 'UKRA'
  );
  // Variable qui ajoutera l'attribut selected de la liste déroulante
  $selected = '';
 
  // Parcours du tableau
  echo '<select name="numPays" id="numPays">',"n";
  foreach($arrayPays as $valeur => $numPays)
  {
    // Test du pays
    if($numPays === 'ALLE')
    {
      $selected = ' selected="selected"';
    }
    // Affichage de la ligne
    echo "\t",'<option value="', $valeur ,'"', $selected ,'>', $numPays ,'</option>',"\n";
    // Remise à zéro de $selected
    $selected='';
  }
  echo '</select>',"\n";
?>
</input>
        </div>

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
require_once __DIR__ . '/footerLangue.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
