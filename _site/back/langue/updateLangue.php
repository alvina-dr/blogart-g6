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
require_once __DIR__ . '/../../CLASS_CRUD/getNextNumLang.php';

// insertion classe STATUT
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
global $db;
$maLangue = new LANGUE;

// controle des saisies du formulaire

require_once __DIR__ . '/../../util/ctrlSaisies.php';

    // Gestion du $_SERVER["REQUEST_METHOD"] => En POST

    // modification effective du statut
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Opérateur ternaire
        $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

        if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

            $sameId = $_POST['id'];
            header("Location: ./updateLangue.php?id=".$sameId);
        }   // End of if ((isset($_POST["submit"])) ...

        if ((isset($_POST['id']) AND $_POST['id'])
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

        if (((isset($_POST['lib1Lang'])) AND !empty($_POST['lib1Lang']))
        AND ((isset($_POST['lib2Lang'])) AND !empty($_POST['lib2Lang']))
        AND ((isset($_POST['TypPays'])) AND !empty($_POST['TypPays']))
        AND (!empty($_POST['id']) AND !empty($_POST['id']))) {

                // Saisies valides
                $erreur = false;

                $numLang = ctrlSaisies(($_POST['id']));;
                $lib1Lang = ctrlSaisies(($_POST['lib1Lang']));
                $lib2Lang = ctrlSaisies(($_POST['lib2Lang']));
                $numPays = ctrlSaisies($_POST["TypPays"]);

                $maLangue->update($numLang, $lib1Lang, $lib2Lang, $numPays);


                header("Location: ./langue.php");
            }   // Fin if ((isset($_POST['legendImg'])) ...
            else {
                $erreur = true;
                $errSaisies =  "Erreur, la saisie est obligatoire !";
            }   // Fin else Saisies invalides
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
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Langue</h1>
    <h2>Modification d'un Langue</h2>
<?
    // Modif : récup id à modifier
    if (isset($_GET['id']) and $_GET['id']) {

        $numLang = ctrlSaisies(($_GET['id']));

        $query = (array)$maLangue->get_1Langue($numLang);

        if ($query) {
            $lib1Lang = $query['lib1Lang'];
            $lib2Lang = $query['lib2Lang'];
            $numLang = $query['numLang'];
            $numPays = $query['TypPays'];
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
            <input type="text" name="lib1Lang" id="lib1Lang" size="80" maxlength="30" value="<?= $lib1Lang; ?>" autofocus="autofocus" />
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="lib2Lang"><b>Langue au féminin (Exemple : Langue Allemande) :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="lib2Lang" id="lib2Lang" size="80" maxlength="30" value="<?= $lib2Lang; ?>" autofocus="autofocus" />
        </div>
        <br>
        <!-- FK : Langue -->
    <!-- Listbox langue -->
    <br>
        <div class="control-group">
            <label class="control-label" for="LibTypPays"><b>Quelle pays :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idTypPays" name="idTypPays" value="<?= isset($_GET['numPays']) ? $_GET['numPays'] : '' ?>" />

                <select size="1" name="TypPays" id="TypPays" required class="form-control form-control-create" title="Sélectionnez le Pays !" >
                   <option value="-1">- - - Choisissez un Pays - - -</option>
<?
            $numPays = "";
            $lib1Lang = "";

            $queryText = 'SELECT * FROM PAYS ORDER BY frPays;';
            $result = $db->query($queryText);
            if ($result) {
                while ($tuple = $result->fetch()) {
                    $ListNumPays = $tuple["numPays"];
                    $ListfrPays = $tuple["frPays"];
?>
                    <option value="<?= $ListNumPays; ?>" >
                        <?= $ListfrPays; ?>
                    </option>
<?
                } // End of while
            }   // if ($result)
?>
                </select>
        </div>
    <!-- FIN Listbox langue -->

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
