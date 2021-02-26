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
        AND (isset($_POST['pseudoMemb'])) AND !empty($_POST['pseudoMemb'])
        AND (isset($_POST['passMemb'])) AND !empty($_POST['passMemb'])
)
        {

            $erreur = false;
            

            $pseudoMemb = ctrlSaisies($_POST['pseudoMemb']);
            $pseudoMembInput = $pseudoMemb;
            //$monStatutMM->get_1Pseudo($pseudoMemb);
            $pseudoMemb = $monStatutMM->get_1Pseudo($pseudoMemb);
            //$monStatutMM->get_1Pseudo($pseudoMemb);
            //$pseudoMembBase = 3;
            $passMemb = ctrlSaisies($_POST['passMemb']);
            $passMembBase = 3;
            $query = (array)$monStatutMM->get_1Membre($pseudoMemb);

            //$souvenirMemb = ctrlSaisies($_POST['souvenirMemb']);
            //$idStat = 1;
           
           /* if ($souvenirMemb == 'off'){ //Se souvenir du membre
                $souvenirMemb = 0;
            }
            else{
                $souvenirMemb = 1;
            }*/

// VÉRIFICATIONS MOT DE PASSE ET PSEUDO CORRECTS

            if($pseudoMemb == $pseudoMembInput) { //Est-ce que le pseudo existe ?
                $pseudoExist = 1; //Le pseudo existe
                $errPseudo = "";
            }
            else {
                $pseudoExist = 0; //Le pseudo n'existe pas
                $errPseudo = "Ce pseudo n'existe pas.";
            }


            if($passMemb == $passMembBase){ //Est-ce que le mot de passe est le bon ?
                $passwordCorrect = 1; //Mot de passe correct
                $passMemb = password_hash($_POST['passMemb'], PASSWORD_DEFAULT);
                $errPass = "";
            }
            else{
                $passwordCorrect = 0; //Mot de passe incorrect
                $errPass = "Le mot de passe est incorrect.";
            }

            if(isset($_GET['id']))
            {
            // id dans l'url
            $id = $_GET['id'];
            }
            else
            {
            // pas de id dans l'url
            }

            if(($pseudoMemb!="") AND ($passMemb!="")/*AND ($souvenirMemb!="")*/ AND ($pseudoExist == 1) AND ($passwordCorrect == 1)){
                
                //$monStatutMM->get_1Pseudo($pseudoMemb);
                header("Location: ../../index.php");
            }
            else{
                echo "Erreur : ".$errPass." ".$errPseudo." Retour : ".$pseudoMemb." Saisie : ".$pseudoMembInput;
                
            }       

        } 
        else {
            //$erreur = true;
            $errSaisies =  "Veuillez saisir votre identifiant et votre mot de passe.";
                echo "Erreur : ".$errSaisies;
            //header("Location: ./connectMembreSite.php?id=".$errSaisies);
        }   // End of else erreur saisies
        
    
    }   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

    // Init variables form
    include __DIR__ . '/initMembre.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?
    // Modif : récup id à modifier
    if (isset($_GET['id']) and $_GET['id']) {

        $numMemb = ctrlSaisies(($_GET['id']));

        $query = (array)$monStatutMM->get_1Membre($numMemb);

        if ($query) {
            echo"test si c'est égal";
            $pseudoMemb = $query['pseudoMemb'];
            $passMemb = $query['passMemb'];
        }   // Fin if ($query)
    }   // Fin if (isset($_GET['id'])...)
?>

    <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <fieldset>
            <legend class="legend1">| Connexion |</legend>

            <!--input type="hidden" id="id" name="id" value="<//?= $_GET['id']; ?>" /-->

            <div>
                <p>Pseudo (*)</p>
                <div class="control-group">
                    <label class="control-label" for="pseudoMemb"></label>
                    <input type="text" placeholder="Pseudo" name="pseudoMemb" id="pseudoMemb" size="80" maxlength="80"
                        value="<?= $pseudoMemb; ?>" />
                </div>
                <img src="../assets/icons/soulignagedroit.svg">
            </div>
            <div>
                <p>Mot de passe (*)</p>
                <div class="control-group">
                    <label class="control-label" for="passMemb"></label>
                    <input type="password" placeholder="Mot de passe" name="passMemb" id="passMemb" size="80"
                        maxlength="80" value="<?= $passMemb; ?>" />
                </div>
            </div>
            <br>
            <div class="control-group">             <!--BOUTONS INITIALISER ET VALIDER-->
                <div class="controls">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Valider"
                        style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 1px grey; border-radius:5px;"
                        name="Submit" />
                    <br>
                </div>
            </div>
        </fieldset>
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

?>
</body>

</html>