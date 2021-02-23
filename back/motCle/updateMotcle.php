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
require_once __DIR__ . '/../../CLASS_CRUD/getNextNumMoCle.php';

// insertion classe STATUT
require_once __DIR__ . '/../../CLASS_CRUD/motcle.class.php';
global $db;
$monMotCle = new MOTCLE;

// controle des saisies du formulaire

require_once __DIR__ . '/../../util/ctrlSaisies.php';

    // Gestion du $_SERVER["REQUEST_METHOD"] => En POST

    // modification effective du statut
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Opérateur ternaire
        $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

        if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

            $sameId = $_POST['id'];
            header("Location: ./updateMotcle.php?id=".$sameId);
        }   // End of if ((isset($_POST["submit"])) ...

        if ((isset($_POST['id']) AND $_POST['id'])
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

        if (((isset($_POST['libMotCle'])) AND !empty($_POST['libMotCle']))
        AND ((isset($_POST['TypLang'])) AND !empty($_POST['TypLang']))
        AND (!empty($_POST['id']) AND !empty($_POST['id']))) {

                // Saisies valides
                $erreur = false;

                $numMotCle = ctrlSaisies(($_POST['id']));;
                $libMotCle = ctrlSaisies(($_POST['libMotCle']));
                $numLang = ctrlSaisies(($_POST['TypLang']));

                $monMotCle->update($numMotCle, $libMotCle, $numLang);


                header("Location: ./motCle.php");
            }   // Fin if ((isset($_POST['legendImg'])) ...
            else {
                $erreur = true;
                $errSaisies =  "Erreur, la saisie est obligatoire !";
            }   // Fin else Saisies invalides
       }   // Fin maj
    }   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")


     // Init variables form
include __DIR__ . '/initMotCle.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Mot CLE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD MOT CLE</h1>
    <h2>Modif d'un Mot clé</h2>

    <?
    // Modif : récup id à modifier
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

<form method="post" action="./updateMotcle.php" enctype="multipart/form-data">

<fieldset>
        <legend class="legend1">Formulaire Mot clé...</legend>
        <br>
        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />
        <div class="control-group">
            <label class="control-label" for="libMotCle"><b>Mot clé (Exemple : Parapluie) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libMotCle" id="libMotCle" size="80" maxlength="30" value="<?= $libMotCle; ?>" autofocus="autofocus" />
        </div>
        <br>
    <!-- FK : Langue -->
    <!-- Listbox langue -->
    <br>
        <div class="control-group">
            <label class="control-label" for="LibTypLang"><b>Quelle langue :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idTypLang" name="idTypLang" value="<?= isset($_GET['numLang']) ? $_GET['numLang'] : '' ?>" />

                <select size="1" name="TypLang" id="TypLang" required class="form-control form-control-create" title="Sélectionnez la langue !" >
                   <option value="-1">Choisissez une langue </option>
<?
            $numLang = "";
            $lib1Lang = "";

            $queryText = 'SELECT * FROM LANGUE ORDER BY lib1Lang;';
            $result = $db->query($queryText);
            if ($result) {
                while ($tuple = $result->fetch()) {
                    $ListNumLang = $tuple["numLang"];
                    $ListLibLang = $tuple["lib1Lang"];
?>
                    <option value="<?= $ListNumLang; ?>" >
                        <?= $ListLibLang; ?>
                    </option>
<?
                } // End of while
            }   // if ($result)
?>
                </select>
        </div>
    <!-- FIN Listbox langue -->
        </div>
        <br>

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
require_once __DIR__ . '/footerMotCle.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>