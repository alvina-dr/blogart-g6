<?
///////////////////////////////////////////////////////////////
//
//  CRUD STATUT (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : deleteStatut.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Récup dernière PK NumLang
require_once __DIR__ . '/../../CLASS_CRUD/getNextNumLang.php';

    // insertion classe LANGUE
    require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
    global $db;
    $maLangue = new LANGUE;
    // controle des saisies du formulaire
    require_once __DIR__ . '/../../util/ctrlSaisies.php';


    // Ctrl CIR


   // Gestion du $_SERVER["REQUEST_METHOD"] => En POST
   // suppression effective du statut
   if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Opérateur ternaire
    $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

    if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Annuler")) {

        $sameId = $_POST['id'];
        header("Location: ./deleteStatut.php?id=".$sameId);
    }   // End of if ((isset($_POST["submit"])) ...

    if (((isset($_POST['lib1Lang'])) AND !empty($_POST['lib1Lang']))
            AND ((isset($_POST['lib2Lang'])) AND !empty($_POST['lib2Lang']))
            AND ((isset($_POST['numPays'])) AND !empty($_POST['numPays']))
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

        // if (((isset($_POST['libStat'])) AND !empty($_POST['libStat']))) {

        //     // Saisies valides
            $erreur = false;

            $numLang = ctrlSaisies(($_POST['id']));

            $maLangue->delete($numLang);

        //     header("Location: ./statut.php");
        // }   // Fin if ((isset($_POST['legendImg'])) ...
        // else {
        //     $erreur = true;
        //     $errSaisies =  "Erreur, la saisie est obligatoire !";
        // }   // Fin else Saisies invalides
   }   // Fin maj
}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")

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
    <style type="text/css">
        #p1 {
            max-width: 600px;
            width: 600px;
            max-height: 200px;
            height: 200px;
            border: 1px solid #000000;
            background-color: whitesmoke;
            /* Coins arrondis et couleur du cadre */
            border: 2px solid grey;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            border-radius: 8px;
        }
        .error {
            padding: 2px;
            border: solid 0px black;
            color: red;
            font-style: italic;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Statut</h1>
    <h2>Suppression d'un statut</h2>
<?
    // Supp : récup id à supprimer
    if (isset($_GET['id']) and $_GET['id']) {

        $id = ctrlSaisies(($_GET['id']));

        $query = (array)$maLangue->get_1Langue($id);

        if ($query) {
            $lib1Lang = $query['lib1Lang'];
            $lib2Lang = $query['lib2Lang'];
            $numLang = $query['numLang'];
            $numPays = $query['numPays'];
        }   // Fin if ($query)
    }   // Fin if (isset($_GET['id'])...)

?>



<form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

<fieldset>
  <legend class="legend1">Formulaire Langue...</legend>
  <br>
  <input type="hidden" id="id" name="id" value="<?= $_GET['id']; ?>" />

  <div class="control-group">
      <label class="control-label" for="lib1Lang"><b>Langue (Exemple : Allemand) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
      <input type="text" name="lib1Lang" id="lib1lang" size="80" maxlength="30" value="<?= $lib1Lang; ?>" autofocus="autofocus" />
  </div>
  <br>
  <div class="control-group">
      <label class="control-label" for="lib2Lang"><b>Langue au féminin (Exemple : Langue Allemande) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
      <input type="text" name="lib2Lang" id="lib2Lang" size="80" maxlength="30" value="<?= $lib2Lang; ?>" autofocus="autofocus" />
  </div>
  <br>
  <div class="control-group">
      <label class="control-label" for="numPays"><b>Raccourci Pays (Exemple : ALLE pour l'Allemagne) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
      <input type="text" name="numPays" id="numPays" size="10" maxlength="4" value="<?= $numPays; ?>" autofocus="autofocus" />
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