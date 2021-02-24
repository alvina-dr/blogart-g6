<?php
///////////////////////////////////////////////////////////////
//
//  CRUD MEMBRE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : createMembre.php  (ETUD)   -   BLOGART21
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

            header("Location: ./updateMembre.php");
        }   // End of if ((isset($_POST["submit"])) ...

        // Mode création
        if ((!empty($_POST['Submit'])) AND ($Submit === "Valider")
        AND (isset($_POST['prenomMemb'])) AND !empty($_POST['prenomMemb'])
        AND (isset($_POST['nomMemb'])) AND !empty($_POST['nomMemb'])
        AND (isset($_POST['pseudoMemb'])) AND !empty($_POST['pseudoMemb'])
        AND (isset($_POST['passMemb'])) AND !empty($_POST['passMemb'])
        AND (isset($_POST['passMemb2'])) AND !empty($_POST['passMemb2'])
        AND (isset($_POST['eMailMemb'])) AND !empty($_POST['eMailMemb'])
        AND (isset($_POST['eMailMemb2'])) AND !empty($_POST['eMailMemb2'])
        AND (isset($_POST['souvenirMemb'])) AND !empty($_POST['souvenirMemb'])
        AND (isset($_POST['accordMemb'])) AND ($_POST['accordMemb'] === "on"))
        {

            $erreur = false;
            
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
           
            if ($souvenirMemb == 'off'){
                $souvenirMemb = 0;
            }
            else{
                $souvenirMemb = 1;
            }
            $accordMemb = ctrlSaisies($_POST['accordMemb']);
            if ($accordMemb == 'on'){
                $accordMemb = 1;
            }
            if (filter_var($eMailMemb, FILTER_VALIDATE_EMAIL) AND filter_var($eMailMemb2, FILTER_VALIDATE_EMAIL)) {
                if ($eMailMemb == $eMailMemb2){
                    $eMailOk = 1;
                }
                else{
                    $eMailOk = 0;
                    $errMail2 = "Les adresses mails entrées ne correspondent pas.";
                }
            }
            else {
                $errMail1 = "L'adresse mail entrée n'est pas valide"; 
            }

            if($passMemb == $passMemb2){
                $passwordOk = 1;
                $passMemb = password_hash($_POST['passMemb'], PASSWORD_DEFAULT);
            }
            else{
                $passwordOk = 0;
                $errPass = "Le mot de passe et la confirmation de mot de passe ne sont pas identiques";
            }
            if(($prenomMemb !="") AND ($nomMemb!="") AND ($pseudoMemb!="") AND ($idStat!="") AND ($dtCreaMemb!="") AND ($souvenirMemb!="") AND ($accordMemb!="") AND ($eMailOk == 1) AND ($passwordOk == 1)){
                
                $monStatutMM->update($prenomMemb, $nomMemb,$pseudoMemb,$passMemb,$eMailMemb,$dtCreaMemb, $souvenirMemb,$accordMemb, $idStat);
                header("Location: ./membre.php");
            }
            else{
                echo "&err1=".$errMail1."&err2=".$errMail2."&err3=".$errPass;
                
            }       

        } 
        else {
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire et vous devez obligatoirement accepter la sauvegarde de vos données!";
            header("Location: ./updateMembre.php?id=".$errSaisies);
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

        <div class="control-group">
            <label class="control-label" for="prenomMemb"><b>Prénom&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="prenomMemb" id="prenomMemb" size="80" maxlength="80" value="<?= $prenomMemb; ?>" autofocus="autofocus" />
        </div>
        <div class="control-group">
            <label class="control-label" for="nomMemb"><b>Nom&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="nomMemb" id="nomMemb" size="80" maxlength="80" value="<?= $nomMemb; ?>" />
        </div>
        <div class="control-group">
            <label class="control-label" for="pseudoMemb"><b>Pseudo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="pseudoMemb" id="pseudoMemb" size="80" maxlength="80" value="<?= $pseudoMemb; ?>"  />
        </div>
        <div class="control-group">
            <label class="control-label" for="passMemb"><b>Mot de passe&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="passMemb" id="passMemb" size="80" maxlength="80" value="<?= $passMemb; ?>" disabled="true" />
        </div>
        <div class="control-group">
            <label class="control-label" for="passMemb2"><b>Confirmation mot de passe&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="passMemb2" id="passMemb2" size="80" maxlength="80" value="<?= $passMemb; ?>" disabled="true" />
        </div>
        <div class="control-group">
            <label class="control-label" for="eMailMemb"><b>e-Mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="eMailMemb" id="eMailMemb" size="80" maxlength="80" value="<?= $eMailMemb; ?>" />
        </div>
        <div class="control-group">
            <label class="control-label" for="eMailMemb2"><b>Confirmation e-Mail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="eMailMemb2" id="eMailMemb2" size="80" maxlength="80" value="<?= $eMailMemb; ?>" />
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="souvenirMemb"><b>Se souvenir de moi :</b></label>
            <div class="controls">
               <fieldset>
                  <input type="radio" name="souvenirMemb"
                  <?= ($souvenirMemb == "on") ? 'checked="checked"' : ''
                  ?> value="on" />&nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="souvenirMemb"
                  <?= ($souvenirMemb == "off") ? 'checked="checked"' : ''
                  ?> value="off" checked="checked" />&nbsp;&nbsp;Non
               </fieldset>
            </div>
        </div>
      <br>
        <div class="control-group">
            <label class="control-label" for="accordMemb"><b>J'accepte que mes données soient conservées :</b></label>
            <div class="controls">
               <fieldset>
                  <input type="radio" name="accordMemb"
                  <?= ($accordMemb == "on") ? 'checked="checked"' : ''
                  ?> value="on" />&nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="accordMemb"
                  <?= ($accordMemb == "off") ? 'checked="checked"' : ''
                  ?> value="off" checked="checked" />&nbsp;&nbsp;Non
               </fieldset>
            </div>
        </div>
        <br>
        <div class="control-group">
            <div class="controls">
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Initialiser" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 1px grey; border-radius:5px;" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 1px grey; border-radius:5px;" name="Submit" />
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