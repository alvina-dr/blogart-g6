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
require_once __DIR__ . '/../../CLASS_CRUD/getNextNumMoCle.php';

    // insertion classe LANGUE
    require_once __DIR__ . '/../../CLASS_CRUD/motcle.class.php';
    global $db;
    $monMotCle = new MOTCLE;
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
        header("Location: ./deleteMotcle.php?id=".$sameId);
    }   // End of if ((isset($_POST["submit"])) ...

    if (((isset($_POST['libMotCle'])) AND !empty($_POST['libMotCle']))
            AND ((isset($_POST['numLang'])) AND !empty($_POST['numLang']))
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

        // if (((isset($_POST['libStat'])) AND !empty($_POST['libStat']))) {

        //     // Saisies valides
            $erreur = false;

            $numMotCle = ctrlSaisies(($_POST['id']));

            $monMotCle->delete($numMotCle);

        //     header("Location: ./statut.php");
        // }   // Fin if ((isset($_POST['legendImg'])) ...
        // else {
        //     $erreur = true;
        //     $errSaisies =  "Erreur, la saisie est obligatoire !";
        // }   // Fin else Saisies invalides
   }   // Fin maj
}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")

    // Init variables form
    include __DIR__ . '/initMotCle.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD MOT CLE</title>
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
    <h1>BLOGART21 Admin - Gestion du CRUD MOT CLE</h1>
    <h2>Suppression d'un Mot clé</h2>

    <?
    // Suppr : récup id à modifier
    if (isset($_GET['id']) and $_GET['id']) {

        $numMotCle = ctrlSaisies(($_GET['id']));

        $query = (array)$monMotCle->get_1MotCle($numMotCle);

        if ($query) {
            $numMotCle = $query['numMotCle'];
            $libMotCle = $query['libMotCle'];
            $numLang = $query['numLang'];
        }   // Fin if ($query)
    }   // Fin if (isset($_GET['id'])...)
?>
 <form method="post" action="./deleteMotcle.php" enctype="multipart/form-data">

<fieldset>
  <legend class="legend1">Formulaire Mot clé...</legend>
  <br>
  <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />
  <div class="control-group">
      <label class="control-label" for="libMotCle"><b>Mot clé (Exemple : Parapluie) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
      <input type="text" name="libMotCle" id="libMotCle" size="80" maxlength="30" value="<?= $libMotCle; ?>" autofocus="autofocus" />
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
require_once __DIR__ . '/footerMotCle.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>