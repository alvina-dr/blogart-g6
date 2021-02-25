<?php
///////////////////////////////////////////////////////////////
//
//  CRUD MEMBRE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : deleteMembre.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';


    // controle des saisies du formulaire


    // insertion classe MEMBRE
    require_once __DIR__ . '/../../util/ctrlSaisies.php';
    require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
    global $db;
    $monStatutMM = new MEMBRE;


    // Gestion du $_SERVER["REQUEST_METHOD"] => En POST
    // ajout effectif du membre
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Opérateur ternaire
        $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

        if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

            header("Location: ./deleteMembre.php");
        }   // End of if ((isset($_POST["submit"])) ...

        // Mode création
        if ((!empty($_POST['Submit'])) AND ($Submit === "Valider")
        AND (isset($_POST['id'])) AND !empty($_POST['id'])
        AND (isset($_POST['prenomMemb'])) AND !empty($_POST['prenomMemb'])
        AND (isset($_POST['nomMemb'])) AND !empty($_POST['nomMemb'])
        AND (isset($_POST['pseudoMemb'])) AND !empty($_POST['pseudoMemb'])
        AND (isset($_POST['passMemb'])) AND !empty($_POST['passMemb'])
        AND (isset($_POST['passMemb2'])) AND !empty($_POST['passMemb2'])
        AND (isset($_POST['eMailMemb'])) AND !empty($_POST['eMailMemb'])
        AND (isset($_POST['eMailMemb2'])) AND !empty($_POST['eMailMemb2'])
        AND (isset($_POST['souvenirMemb'])) AND !empty($_POST['souvenirMemb'])
        AND (isset($_POST['accordMemb'])) AND ($_POST['accordMemb'] === "on")){
        
            $erreur = false;

            $numMemb = ctrlSaisies($_POST['id']);
            $prenomMemb = ctrlSaisies($_POST['prenomMemb']);
            $nomMemb = ctrlSaisies($_POST['nomMemb']);
            $pseudoMemb = ctrlSaisies($_POST['pseudoMemb']);
            $passMemb = ctrlSaisies($_POST['passMemb']);
            $passMemb2 = ctrlSaisies($_POST['passMemb2']);
            $eMailMemb = ctrlSaisies($_POST['eMailMemb']);
            $eMailMemb2 = ctrlSaisies($_POST['eMailMemb2']);
            $dtCreaMemb = date("Y-m-d h:i:s");
            $souvenirMemb = ctrlSaisies($_POST['souvenirMemb']);
            $idStat = 1;


        $monStatutMM->delete($numMemb, $prenomMemb, $nomMemb,$pseudoMemb,$passMemb,$eMailMemb,$dtCreaMemb, $souvenirMemb,$accordMemb, $idStat);
        header("Location: ./membre.php");
    } 

        else {
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire et vous devez obligatoirement accepter la sauvegarde de vos données!";
            header("Location: ./deleteMembre.php?id=".$errSaisies);
        }   // End of else erreur saisies
        
    
    }   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

    // Init variables form
    include __DIR__ . '/initMembre.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Statut</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Membre</h1>
    <h2>Ajout d'un membre</h2>
    <?
    // Modif : récup id à modifier
    if (isset($_GET['id']) and $_GET['id']) {

        $numMemb = ctrlSaisies(($_GET['id']));

        $query = (array)$monStatutMM->get_1Membre($numMemb);

        if ($query) {
            $prenomMemb = $query['prenomMemb'];
            $nomMemb = $query['nomMemb'];
            $pseudoMemb = $query['pseudoMemb'];
            $passMemb = $query['passMemb'];
            $eMailMemb = $query['eMailMemb'];
            $dtCreaMemb = $query['dtCreaMemb'];
            $souvenirMemb = $query['souvenirMemb'];
            $accordMemb = $query['accordMemb'];
            $idStat = $query['idStat'];
        }   // Fin if ($query)
    }   // Fin if (isset($_GET['id'])...)
?>

    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

      <fieldset>
        <legend class="legend1">Formulaire Membre...</legend>

<input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />
 
<div class="control-group">
            <label class="control-label" for="prenomMemb"><b>Prénom&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" disabled name="prenomMemb" id="prenomMemb" size="80" maxlength="80" value="<?= $prenomMemb; ?>" autofocus="autofocus" />
        </div>
        <div class="control-group">
            <label class="control-label" for="nomMemb"><b>Nom&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" disabled name="nomMemb" id="nomMemb" size="80" maxlength="80" value="<?= $nomMemb; ?>" />
        </div>
        <div class="control-group">
            <label class="control-label" for="pseudoMemb"><b>Pseudo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" disabled name="pseudoMemb" id="pseudoMemb" size="80" maxlength="80" value="<?= $pseudoMemb; ?>"  />
        </div>
        <div class="control-group">
            <label class="control-label" for="passMemb"><b>Mot de passe&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" disabled name="passMemb" id="passMemb" size="80" maxlength="80" value="<?= $passMemb; ?>" readOnly />
        </div>
        <div class="control-group">
            <label class="control-label" for="passMemb2"><b>Confirmation mot de passe&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" disabled name="passMemb2" id="passMemb2" size="80" maxlength="80" value="<?= $passMemb; ?>"  />
        </div>
        <div class="control-group">
            <label class="control-label" for="eMailMemb"><b>e-Mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" disabled name="eMailMemb" id="eMailMemb" size="80" maxlength="80" value="<?= $eMailMemb; ?>" />
        </div>
        <div class="control-group">
            <label class="control-label" for="eMailMemb2"><b>Confirmation e-Mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" disabled name="eMailMemb2" id="eMailMemb2" size="80" maxlength="80" value="<?= $eMailMemb; ?>" />
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="souvenirMemb"><b>Se souvenir de moi :</b></label>
            <div class="controls">
                <fieldset>
                    <input type="radio" disabled name="souvenirMemb"
                    <? if ($souvenirMemb == 1) echo 'checked="checked" ';?>
                    value = 'on'/>
                    &nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp;

                    <input type="radio" disabled name="souvenirMemb"
                    <? if ($souvenirMemb == 0) echo 'checked="checked" ';?>
                    value = 'off'/>
                    &nbsp;&nbsp;Non&nbsp;&nbsp;&nbsp;&nbsp;

                </fieldset>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="accordMemb"><b>J'accepte que mes données soient conservées :</b></label>
            <div class="controls">
               <fieldset>
               <input type="radio" disabled name="accordMembe"
                    <?if ($accordMemb == 1) echo 'checked="checked" ';?>
                    value = 'on' readOnly/>
                    &nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp;

                    <input type="radio" disabled name="accordMemb"
                    <?if ($accordMemb == 0) echo 'checked="checked" ';?> 
                    value = 'off' disabled/>
                    &nbsp;&nbsp;Non&nbsp;&nbsp;&nbsp;&nbsp;

               </fieldset>
            </div>
        </div>

        <br>
        <div class="control-group">
            <div class="controls">
                <br><br>
                <input type="submit" value="Supprimer" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 1px grey; border-radius:5px;" name="Submit" />
                <br>
            </div>
        </div>
      </fieldset>
    </form>
    
<?php

if (isset($_GET['id']) AND !empty($_GET['id'])) {
    $errSaisies = ($_GET['id']);
    echo $errSaisies;
}
if (isset($_GET['err1']) AND !empty($_GET['err1'])){
    $errPass = $_GET['err1'];
    echo $errPass.'</br>';
}
if (isset($_GET['err2']) AND !empty($_GET['err2'])){
    $errMail1 = $_GET['err2'];
    echo $errMail1.'</br>';
}
if (isset($_GET['err3']) AND !empty($_GET['err3'])){
    $errMail2 = $_GET['err3'];
    echo $errMail2.'</br>';
} 

require_once __DIR__ . '/footerMembre.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>