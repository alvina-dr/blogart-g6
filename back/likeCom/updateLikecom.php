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
    require_once __DIR__ . '/../../util/delAccents.php';
    require_once __DIR__ . '/../../CLASS_CRUD/likeCom.class.php';
    include __DIR__ . '/initLikeCom.php';

    
    global $db;
    $monLikeCom= new LIKECOM;
    // insertion classe STATUT

    $erreur = false;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Opérateur ternaire
        $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';
        //Submit = "";
        if ((isset($_POST["Submit"])) AND ($Submit === "Initialiser")) {

            $sameId1 = $_POST['id1'];
            $sameId2 = $_POST['id2'];
            $sameId3 = $_POST['id3'];
            header("Location: ./updateLikecom.php?id1=".$sameId1."&id2=".$sameId2."&id3=".$sameId3);
        }
        // Mode création
        if (((isset($_POST['id1'])) AND !empty($_POST['id1']))
        AND ((isset($_POST['id2'])) AND !empty($_POST['id2']))
        AND ((isset($_POST['id3'])) AND !empty($_POST['id3']))
        AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {
            // Saisies valides
            $erreur = false;
            $numMemb = ctrlSaisies(($_POST['id1']));
            $numArt = ctrlSaisies(($_POST['id2']));
            $numSeqCom = ctrlSaisies(($_POST['id3']));
            $valLikeC = ctrlSaisies($_POST['likeC']);
            $likeC = ($valLikeC == "on") ? 1 : 0;
;
            $monLikeCom->update($numMemb, $numSeqCom, $numArt, $likeC);

            header("Location: ./likeCom.php");

        }   // Fin if
        else {
            $erreur = true;
            $errSaisies = "Erreur, la saisie est obligatoire !";
        }
            
    }

    
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Like Commentaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Like Commentaire</h1>
    <h2>Modification d'un like ommentaire</h2>
    <?
    global $db;
     if (isset($_GET['id1']) and $_GET['id1'] AND isset($_GET['id2']) and $_GET['id2' ]AND isset($_GET['id3']) and $_GET['id3']) {

        
        $numMemb = ctrlSaisies(($_GET['id1']));
        $numArt = ctrlSaisies(($_GET['id2']));
        $numSeqCom = ctrlSaisies(($_GET['id3']));

        
        $query = (array)$monLikeCom->get_1LikeCom($numMemb, $numArt, $numSeqCom);

        if ($query) {
            $likeC = $query['likeC'];
            $idMemb =  ctrlSaisies(($_GET['id1']));
            $idArt =  ctrlSaisies(($_GET['id2']));
            $idSeqCom =  ctrlSaisies(($_GET['id3']));
            
        }   // Fin if ($query)
    }   // Fin if (isset($_GET['id'])...)
?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

        <fieldset>
            <legend class="legend1">Formulaire Like Commentaire...</legend>

            <input type="hidden" id="id1" name="id1" value="<?= isset($_GET['id1']) ? $_GET['id1'] : '' ?>" />
            <input type="hidden" id="id2" name="id2" value="<?= isset($_GET['id2']) ? $_GET['id2'] : '' ?>" />
            <input type="hidden" id="id3" name="id3" value="<?= isset($_GET['id3']) ? $_GET['id3'] : '' ?>" />
            
            <div class="control-group">
            <div class="control-group">
                <label class="control-label" for="numMemb"><b>Quel Membre :&nbsp;</b></label>
                <input type="hidden" id="id1" name="id1" value="<?= isset($_GET['id1']) ? $_GET['id1'] : '' ?>" />
                <select size="1" name="idMemb" id="idMemb" class="form-control form-control-create" tabindex="30" >
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
                    <option value="<?= ($ListNumMemb); ?>" <?= ((isset($idMemb) && $idMemb == $ListNumMemb) ?  "selected=\"selected\"" : null); ?>>
                        <?= $ListPseudoMemb; ?>
                    </option>
                    <?
                    }
                }   
?>
                </select>

                <br><br>
                <label class="control-label" for="numArt"><b>Quel Article :&nbsp;</b></label>
                <input type="hidden" id="id2" name="id2" value="<?= isset($_GET['id2']) ? $_GET['id2'] : '' ?>" />
                <select size="1" name="idArt" id="idArt" class="form-control form-control-create" tabindex="30" >
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
                    <option value="<?= ($ListNumArt); ?>" <?= ((isset($idArt) && $idArt == $ListNumArt) ?  "selected=\"selected\"" : null); ?>>
                        <?= $ListLibTitrArt; ?>
                    </option>
                    <?
                    } 
                }
?>
                </select>

                <br><br>
                <div class="control-group">
                <label class="control-label" for="numSeqCom"><b>Quel Commentaire :&nbsp;</b></label>
                <input type="hidden" id="id3" name="id3" value="<?= isset($_GET['id3']) ? $_GET['id3'] : '' ?>" />
                <select size="1" name="idSeqCom" id="idSeqCom" class="form-control form-control-create" tabindex="30" >
                    <option value="-1">--- Selectionner un Commentaire ---</option>

                    <?
                global $db;
                $numSeqCom = "";
                $numArt = "";
                $libCom = "";

                $queryText = 'SELECT * FROM COMMENT ORDER BY libCom;';
                $result = $db->query($queryText);
                if ($result) {
                    while ($tuple = $result->fetch()) {
                        $ListNumSeqCom = $tuple["numSeqCom"]["numArt"];
                        $ListlibCom = $tuple["libCom"];
?>
                    <option value="<?= ($ListNumSeqCom); ?>"<?= ((isset($idSeqCom) && $idSeqCom == $ListNumSeqCom) ?  "selected=\"selected\"" : null); ?>>
                        <?= $ListlibCom; ?>
                    </option>
                    <?
                    }
                }   
?>
                </select>

                
                <br><br>
                <label class="control-label" for=""><b> Voulez vous liker ce Commentaire? :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label><br>
                
                <input type="checkbox" name="likeC" id="likeC" <?=  ($likeC == 1)  ? 'checked="checked" "value="on" ' : 'value="on"' ?> />



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
                    <input class="imputFields" type="submit" value="Annuler" name="Submit" />
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input class="imputFields" type="submit" value="Valider" name="Submit" />
                    <br>
                </div>
            </div>
        </fieldset>
    </form>
    <?
require_once __DIR__ . '/footerLikeCom.php';

require_once __DIR__ . '/../../back/footer.php';
?>
</body>

</html>