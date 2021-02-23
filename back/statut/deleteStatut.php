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



    // insertion classe STATUT
    require_once __DIR__ . '/../../CLASS_CRUD/statut.class.php';
    global $db;
    $monStatut = new STATUT;
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

    if ((isset($_POST['id']) AND $_POST['id'] > 0)
        AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

        // if (((isset($_POST['libStat'])) AND !empty($_POST['libStat']))) {

        //     // Saisies valides
            $erreur = false;

            $idStat = ctrlSaisies(($_POST['id']));

            $monStatut->delete($idStat);

        //     header("Location: ./statut.php");
        // }   // Fin if ((isset($_POST['legendImg'])) ...
        // else {
        //     $erreur = true;
        //     $errSaisies =  "Erreur, la saisie est obligatoire !";
        // }   // Fin else Saisies invalides
   }   // Fin maj
}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")

    // Init variables form
    include __DIR__ . '/initStatut.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Statut</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
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
    if (isset($_GET['id']) and $_GET['id'] > 0) {

        $id = ctrlSaisies(($_GET['id']));

        $query = (array)$monStatut->get_1Statut($id);

        if ($query) {
            $libStat = $query['libStat'];
            $idStat = $query['idStat'];
        }   // Fin if ($query)
    }   // Fin if (isset($_GET['id'])...)

?>



      <form method="post" action="./deleteStatut.php" enctype="multipart/form-data">

      <fieldset>
        <legend class="legend1">Formulaire Statut...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libStat"><b>Nom du statut :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libStat" id="libStat" size="80" maxlength="80" value="<?= $libStat; ?>" disabled="disabled" />
        </div>

        <div class="control-group">
            <div class="controls">
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Annuler" class="imputFields" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" class="imputFields" name="Submit" />
                <br>
            </div>
        </div>
      </fieldset>
    </form>
    <br>
<?
require_once __DIR__ . '/footerStatut.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
