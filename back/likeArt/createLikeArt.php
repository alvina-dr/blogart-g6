<?
///////////////////////////////////////////////////////////////
//
//  CRUD LIKEART (PDO) - Code Modifié - 30 Janvier 2021
//
//  Script  : createLangue.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
    require_once __DIR__ . '/../../util/utilErrOn.php';
    
    
    // controle des saisies du formulaire
    require_once __DIR__ . '/../../util/ctrlSaisies.php';
    include __DIR__ . '/../../CLASS_CRUD/likeart.class.php';

    
    global $db;
    $monLikeArt= new LIKEART;
    // insertion classe STATUT

    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Opérateur ternaire
        $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';
        //Submit = "";
        if ((isset($_POST['Submit'])) AND ($_POST["Submit"] === "Initialiser")) {
            header("Location: ./createLikeart.php");
        }
        // Mode création
        if (((isset($_POST['numArt'])) AND !empty($_POST['numArt']))
        AND ((isset($_POST['numMemb'])) AND !empty($_POST['numMemb']))
        AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {
            // Saisies valides
            $erreur = false;
            $numMemb = ctrlSaisies(($_POST['numMemb']));
            $numArt = ctrlSaisies(($_POST['numArt']));
            $valLikeA = ctrlSaisies($_POST['likeA']);
            $likeA = ($valLikeA == "on") ? 1 : 0;
            var_dump($numMemb);
            var_dump($numArt);
            var_dump($likeA);
            $monLikeArt->create($numMemb, $numArt, $likeA);

            header("Location: ./likeArt.php");

        }   // Fin if
        else {
            $erreur = true;
            $errSaisies = "Erreur, la saisie est obligatoire !";
        }
            
    }

    include __DIR__ . '/initLikeArt.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Like Article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Like Article</h1>
    <h2>Ajout d'une langue</h2>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

        <fieldset>
            <legend class="legend1">Formulaire Like Article...</legend>

            <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

            <div class="control-group">
                <label class="control-label" for="numMemb"><b>Quel Membre :&nbsp;</b></label>
                <input type="hidden" id="idTypMemb" name="idTypMemb" value="<?= $numMemb; ?>" />
                <select size="1" name="numMemb" id="numMemb" class="form-control form-control-create" tabindex="30">
                    <option value="-1">--- Selectionner un membre ---</option>

                    <?
                global $db;
                $numMemb = "";
                $pseudoMemb = "";

                $queryText = 'SELECT * FROM MEMBRE ORDER BY pseudoMemb;';
                $result = $db->query($queryText);
                if ($result) {
                    while ($tuple = $result->fetch()) {
                        $ListNumMemb = $tuple["numMemb"];
                        $ListPseudoMemb = $tuple["pseudoMemb"];
?>
                    <option value="<?= ($ListNumMemb); ?>">
                        <?= $ListPseudoMemb; ?>
                    </option>
                    <?
                    }
                }   
?>
                </select>

                <br><br>
                <label class="control-label" for="numArt"><b>Quel Article :&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idTypArt" name="idTypArt" value="<?= $numArt; ?>" />
                <select size="1" name="numArt" id="numArt" class="form-control form-control-create" tabindex="30">
                    <option value="-1">--- Selectionner un Article ---</option>
                    <?
                global $db;
                $numArt = "";
                $libTitrArt = "";

                $queryText = 'SELECT * FROM ARTICLE ORDER BY libTitrArt;';
                $result = $db->query($queryText);
                if ($result) {
                    while ($tuple = $result->fetch()) {
                        $ListNumArt = $tuple["numArt"];
                        $ListLibTitrArt = $tuple["libTitrArt"];
?>
                    <option value="<?= ($ListNumArt); ?>">
                        <?= $ListLibTitrArt; ?>
                    </option>
                    <?
                    } 
                }
?>
                </select>
                <br><br>
                <label class="control-label" for=""><b> Voulez vous liker cet article? :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label><br>

                <input type="checkbox" name="likeA" id="likeA" value="on"  />


            </div>

            <?
            if ($erreur)
            {
                echo ($errSaisies);
            }
            else {
                $errSaisies= "";
                echo ($errSaisies);
    
            }
?>
            <div class="control-group">

                <div class="controls">
                    <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="inputFields" type="submit" value="Initialiser" name="Submit" />
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="inputFields" type="submit" value="Valider" name="Submit" />
                    <br>
                </div>
            </div>
        </fieldset>
    </form>
    <?
require_once __DIR__ . '/footerLikeArt.php';

require_once __DIR__ . '/../../footer.php';
?>
</body>

</html>