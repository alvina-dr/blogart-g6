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
require_once __DIR__ . '/../../CLASS_CRUD/commentPlus.class.php';
global $db;
$monComPlus = new COMMENTPLUS;
// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

  // Gestion du $_SERVER["REQUEST_METHOD"] => En POST
    // ajout effectif du statut 

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

      // Opérateur ternaire
      $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

      if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

          header("Location: ./createCommentPlus.php");
      }   // End of if ((isset($_POST["submit"])) ...

      
      if (((isset($_POST['numArt'])) AND !empty($_POST['numArt']))
            AND ((isset($_POST['numSeqComR'])) AND !empty($_POST['numSeqCom']))
            AND ((isset($_POST['numArtR'])) AND !empty($_POST['numArtR']))
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

            // Saisies valides
            $erreur = false;
                
            $numArt = ctrlSaisies(($_POST['numArt']));
            $numSeqComR = ctrlSaisies(($_POST['numSeqComR']));
            $numArtR = ctrlSaisies(($_POST["numArtR"]));

            $numNextCom = getNextNumCom($numArt, $numSeqCom);

            //$monComPlus->create($numNextCom, $dtCreCom, $libCom);
            $monComPlus->create($numArt, $numSeqComR, $numArtR); //Je sais pas trop ce qu'il faut modifier ici, la ligne d'origine est au-dessus en commentaire.

            //header("Location: ./langue.php");

        }   // Fin if ((isset($_POST['legendImg'])) ...
        else {
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // Fin else erreur saisies

  }   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

    // Init variables form
    include __DIR__ . '/initCommentPlus.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Réponse aux Commentaires</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Réponse aux Commentaires</h1>
    <h2>Ajout d'une Réponse au Commentaire</h2>

    <form method="post" action="./createCommentPlus.php" enctype="multipart/form-data">
      <fieldset>
    

    <!-- DÉBUT Listbox COMMENTPLUS CHOISIR L'ARTICLE -->
        <legend class="legend1">Formulaire Réponse au Commentaire...</legend>
        <br>
        <br>
        <div class="control-group">
            <label class="control-label" for="LibNumArt"><b>Quel commentaire :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idNumArt" name="idNumArt" value="<?= isset($_GET['numArt']) ? $_GET['numArt'] : '' ?>" />

                <select size="1" name="TypLikeArt" id="TypLikeArt" required class="form-control form-control-create" title="Sélectionnez le nom de l'article !" >
                   <option value="-1">Choisissez un commentaire </option>
<?
            $numArt = "";
            $libCom = "";

            $queryText = 'SELECT * FROM COMMENT ORDER BY numSeqCom;'; //Permet de choisir les commentaires par leur numéros
            $result = $db->query($queryText);
            if ($result) {
                while ($tuple = $result->fetch()) {
                    $LibNumArt = $tuple["numArt"];
                    $libCom = $tuple["libCom"];
?>
                    <option value="<?= $LibNumArt; ?>" >
                        <?= $libCom; ?>
                    </option>
<?
                } // End of while
            }   // if ($result)
?>
                </select>
        </div>
    <!-- FIN Listbox COMMENTPLUS CHOISIR L'ARTICLE -->
    <br>
    <!-- DÉBUT Listbox COMMENTPLUS CHOISIR LE MEMBRE -->
        <div class="control-group">
            <label class="control-label" for="LibNumMemb"><b>Quel membre :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idNumMemb" name="idNumMemb" value="<?= isset($_GET['numMemb']) ? $_GET['numMemb'] : '' ?>" />

                <select size="1" name="TypNumMemb" id="TypNumMemb" required class="form-control form-control-create" title="Sélectionnez le membre !" >
                   <option value="-1">Choisissez un membre </option>
<?
            $numMemb = "";
            $pseudoMemb = "";

            $queryText = 'SELECT * FROM MEMBRE ORDER BY numMemb;';
            $result = $db->query($queryText);
            if ($result) {
                while ($tuple = $result->fetch()) {
                    $LibNumMemb = $tuple["numMemb"];
                    $LibPseudoMemb = $tuple["pseudoMemb"];
?>
                    <option value="<?= $LibNumMemb; ?>" >
                        <?= $LibPseudoMemb; ?>
                    </option>
<?
                } // End of while
            }   // if ($result)
?>
                </select>
        </div>
    <!-- FIN Listbox COMMENTPLUS CHOISIR LE MEMBRE -->
    <br> 
    <!-- DÉBUT Listbox COMMENTPLUS ÉCRIRE LE COMMENTAIRE -->
    <div class="control-group">
            <label class="control-label" for="libComPlus"><b>Inscrivez votre commentaire ici :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <textarea type="text" name="libComPlus" id="libComPlus" size="2000" maxlength="2000" value="<?= $libComPlus; ?>" autofocus="autofocus" style="margin: 0px; width: 500px; height: 150px;"></textarea>
        </div>
        <br>

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
    <!-- DÉBUT Listbox COMMENTPLUS ÉCRIRE LE COMMENTAIRE -->


      </fieldset>
    </form>
<?
require_once __DIR__ . '/footerCommentPlus.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
