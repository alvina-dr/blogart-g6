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
require_once __DIR__ . '/../../CLASS_CRUD/getNextNumCom.php';
    
// insertion classe STATUT
require_once __DIR__ . '/../../CLASS_CRUD/comment.class.php';
global $db;
$monStatutCom = new COMMENT;
// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

  // Gestion du $_SERVER["REQUEST_METHOD"] => En POST
    // ajout effectif du statut 

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

      // Opérateur ternaire
      $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

      if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

          header("Location: ./createComment.php");
      }   // End of if ((isset($_POST["submit"])) ...

      
      if (((isset($_POST['libCom'])) AND !empty($_POST['libCom']))
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

            // Saisies valides
            $erreur = false;
                

            $numMemb = 2;//ctrlSaisies(($_POST['TypNumMemb']));
            $numArt = 1/*ctrlSaisies(($_POST['TypArt']))*/;
            $dtCreCom = date("Y-m-d-H-i-s");
            $numSeqCom = getNextNumCom($numArt);
            $libCom = ctrlSaisies(($_POST["libCom"]));

            $monStatutCom->create($numSeqCom, $numArt, $dtCreCom, $libCom, $numMemb);
            

            //header("Location: ./langue.php");

        }   // Fin if ((isset($_POST['legendImg'])) ...
        else {
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // Fin else erreur saisies

  }   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

    // Init variables form
    include __DIR__ . '/initComment.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Commentaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>



    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
        <fieldset>


            <!-- DÉBUT Listbox COMMENT CHOISIR L'ARTICLE -->
            <legend class="legend1">| Laissez un commentaire ! |</legend>


            <!-- FIN Listbox COMMENT CHOISIR L'ARTICLE -->
            <br>
            <!-- DÉBUT Listbox COMMENT CHOISIR LE MEMBRE -->

            <!-- FIN Listbox COMMENT CHOISIR LE MEMBRE -->
            <br>
            <!-- DÉBUT Listbox COMMENT ÉCRIRE LE COMMENTAIRE -->
            <div class="control-group">
                <label class="control-label" for="libCom"><b>Rédigez votre commentaire ici
                        :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <textarea type="text" name="libCom" id="libCom" size="2000" maxlength="2000" value="<?= $libCom; ?>"
                    autofocus="autofocus" style="margin: 0px; width: 500px; height: 150px;"></textarea>
            </div>

            <br>
            </div>

            <div class="control-group">
                <div class="controls">
                    <br>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Valider" class="imputFields" name="Submit" />
                    <br>
                </div>
            </div>
            <!-- DÉBUT Listbox COMMENT ÉCRIRE LE COMMENTAIRE -->


        </fieldset>
    </form>
</body>

</html>