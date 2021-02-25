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

    // insertion classe STATUT
require_once __DIR__ . '/../../CLASS_CRUD/likeArt.class.php';
global $db;
$monLikeArt = new LIKEART;
// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

  // Gestion du $_SERVER["REQUEST_METHOD"] => En POST
    // ajout effectif du statut 

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

      // Opérateur ternaire
      $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

      if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

          //header("Location: ./createLikeArt.php");
      }   // End of if ((isset($_POST["submit"])) ...

      
      if (((isset($_POST['numArt'])) AND !empty($_POST['numArt']))
            AND ((isset($_POST['likeA'])) AND !empty($_POST['likeA']))
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) { //PAS TOUCHER CETTE LIGNE

            // Saisies valides
            $erreur = false;
                
            //$numLikeArt = 0;
            $numArt = ctrlSaisies(($_POST['numArt']));
            $likeA = ctrlSaisies(($_POST['likeA']));

            $monLikeArt->create($numMemb, $numArt, $likeA);

            //header("Location: ./langue.php");

        }   // Fin if ((isset($_POST['legendImg'])) ...
        else {
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // Fin else erreur saisies

  }   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

    // Init variables form
    include __DIR__ . '/initLikeArt.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Like</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <form method="post" action="./createLikeArt.php" enctype="multipart/form-data">


        <br>
    <!-- Listbox Articles -->

    <!-- FIN Listbox article -->
        <br>
        <div class="control-group">
            <label class="control-label" for="likeA"><b>Clique pour liker chacal :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="checkbox" name="likeA" id="likeA" size="80" maxlength="30" value="<?= $likeA; ?>" autofocus="autofocus" />
        </div>
 
        <br>
        </div>

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

    </form>
</body>
</html>
