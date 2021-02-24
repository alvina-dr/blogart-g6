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

      
      if (((isset($_POST['numArt'])) AND !empty($_POST['numArt']))
            AND ((isset($_POST['dtCreCom'])) AND !empty($_POST['dtCreCom']))
            AND ((isset($_POST['libCom'])) AND !empty($_POST['libCom']))
            AND ((isset($_POST['attModOK'])) AND !empty($_POST['attModOK']))
            AND ((isset($_POST['affComOK'])) AND !empty($_POST['affComOK']))
            AND ((isset($_POST['notifComKOAff'])) AND !empty($_POST['notifComKOAff']))
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

            // Saisies valides
            $erreur = false;
                
            //$numLang = 0;
            $numArt = ctrlSaisies(($_POST['numArt']));
            $dtCreCom = ctrlSaisies(($_POST['dtCreCom']));
            $libCom = ctrlSaisies($_POST["libCom"]);
            $attModOK = ctrlSaisies(($_POST['attModOK']));
            $affComOK = ctrlSaisies(($_POST['affComOK']));
            $notifComKOAff = ctrlSaisies($_POST["notifComKOAff"]);



            $monStatutCom->create($numSeqCom, $dtCreCom, $libCom, $attModOK, $affComOK, $notifComKOAff);

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
    <h1>BLOGART21 Admin - Gestion du CRUD Commentaire</h1>
    <h2>Ajout d'un Commentaire</h2>

    <form method="post" action="./createComment.php" enctype="multipart/form-data">

      <fieldset>
        <legend class="legend1">Formulaire Commentaire...</legend>
        <br>
        <div class="control-group">
            <label class="control-label" for="numSeqCom"><b>Numéro du commentaire :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="numSeqCom" id="numSeqCom" size="350" maxlength="300" value="<?= $numSeqCom; ?>" autofocus="autofocus" />
        </div>

        <br>
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
            <label class="control-label" for="dtCreCom"><b>Date de création du commentaire :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="dtCreCom" id="dtCreCom" size="350" maxlength="300" value="<?= $dtCreCom; ?>" autofocus="autofocus" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libCom"><b> Libellé du commentaire :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libCom" id="libCom" size="350" maxlength="300" value="<?= $libCom; ?>" autofocus="autofocus" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="attModOK"><b> Modération du commentaire :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="checkbox" name="attModOK" id="attModOK" size="350" maxlength="300" value="<?= $attModOK; ?>" autofocus="autofocus" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="affComOK"><b> Validité du commentaire :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="checkbox" name="affComOK" id="affComOK" size="350" maxlength="300" value="<?= $affComOK; ?>" autofocus="autofocus" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="notifComKOAff"><b>Note du modérateur :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="notifComKOAff" id="notifComKOAff" size="350" maxlength="300" value="<?= $notifComKOAff; ?>" autofocus="autofocus" />
        </div>


        
        <!-- FK : Langue -->
    <!-- Listbox langue -->
   
   
                </select>
        </div>
    <!-- FIN Listbox langue -->
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
require_once __DIR__ . '/footerComment.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
