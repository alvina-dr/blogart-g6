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
require_once __DIR__ . '/../../CLASS_CRUD/likeCom.class.php';
global $db;
$monLikeCom = new LIKECOM;
// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

  // Gestion du $_SERVER["REQUEST_METHOD"] => En POST
    // ajout effectif du statut 

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

      // Opérateur ternaire
      $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

      if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

          header("Location: ./createLikeCom.php");
      }   // End of if ((isset($_POST["submit"])) ...

      
      if (((isset($_POST['numSeqCom'])) AND !empty($_POST['numSeqCom']))
            AND ((isset($_POST['numArt'])) AND !empty($_POST['numArt']))
            AND ((isset($_POST['likeC'])) AND !empty($_POST['likeC']))
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

            // Saisies valides
            $erreur = false;
                
            /*$numLang = 0;*/
            $numSeqCom = ctrlSaisies(($_POST['numSeqCom']));
            $numArt = ctrlSaisies(($_POST['numArt']));
            $likeC = ctrlSaisies($_POST["likeC"]);



            $monLikeCom->create($numMemb, $numSeqCom, $numArt, $likeC);

            //header("Location: ./langue.php");

        }   // Fin if ((isset($_POST['legendImg'])) ...
        else {
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // Fin else erreur saisies

  }   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

    // Init variables form
    include __DIR__ . '/initLikeCom.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD LikeCom</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD LikeCom</h1>
    <h2>Ajout d'un LikeCom</h2>

    <form method="post" action="./createLikeCom.php" enctype="multipart/form-data">

      <fieldset>
        <legend class="legend1">Formulaire LikeCom...</legend>
        <br>
        <div class="control-group">
            <label class="control-label" for="numSeqCom"><b>Numéro du commentaire sélectionné :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="numSeqCom" id="numSeqCom" size="80" maxlength="30" value="<?= $numSeqCom; ?>" autofocus="autofocus" />
        </div>
        <br>
            <!-- Listbox Articles -->
    <br>
        <div class="control-group">
            <label class="control-label" for="LibNumArt"><b>Quel article :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idNumArt" name="idNumArt" value="<?= isset($_GET['numArt']) ? $_GET['numArt'] : '' ?>" />

                <select size="1" name="TypLikeArt" id="TypLikeArt" required class="form-control form-control-create" title="Sélectionnez le nom de l'article !" >
                   <option value="-1">Choisissez un article </option>
<?
            $numArt = "";
            $libTitrArt = "";

            $queryText = 'SELECT * FROM ARTICLE ORDER BY numArt;';
            $result = $db->query($queryText);
            if ($result) {
                while ($tuple = $result->fetch()) {
                    $LibNumArt = $tuple["numArt"];
                    $LibTitrArt = $tuple["libTitrArt"];
?>
                    <option value="<?= $LibNumArt; ?>" >
                        <?= $LibTitrArt; ?>
                    </option>
<?
                } // End of while
            }   // if ($result)
?>
                </select>
        </div>
    <!-- FIN Listbox article -->
        <br>
        <div class="control-group">
                <label class="control-label" for="likeC"><b>Liker le commentaire :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="checkbox" name="likeC" id="likeC" size="80" maxlength="30" value="<?= $likeC; ?>" autofocus="autofocus" />
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
      </fieldset>
    </form>
<?
require_once __DIR__ . '/footerLikeCom.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
