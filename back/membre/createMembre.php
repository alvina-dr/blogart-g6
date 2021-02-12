<?
///////////////////////////////////////////////////////////////
//
//  CRUD ANGLE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : createStatut.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

    // insertion classe STATUT
require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
global $db;
$monMembre = new MEMBRE;
// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

    // Gestion du $_SERVER["REQUEST_METHOD"] => En POST
    // ajout effectif du statut 

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

      // Opérateur ternaire
      $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

      if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

          header("Location: ./createMembre.php");
      }   // End of if ((isset($_POST["submit"])) ...

      
      if (((isset($_POST['prenomMemb'])) AND !empty($_POST['prenomMemb']))
            AND ((isset($_POST['nomMemb'])) AND !empty($_POST['nomMemb']))
            AND ((isset($_POST['pseudoMemb'])) AND !empty($_POST['pseudoMemb']))
            AND ((isset($_POST['passMemb'])) AND !empty($_POST['passMemb']))
            AND ((isset($_POST['eMailMemb'])) AND !empty($_POST['eMailMemb']))
            AND ((isset($_POST['dtCreaMemb'])) AND !empty($_POST['dtCreaMemb']))
            AND ((isset($_POST['souvenirMemb'])) AND !empty($_POST['souvenirMemb']))
            AND ((isset($_POST['accordMemb'])) AND !empty($_POST['accordMemb']))
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

            // Saisies valides
            $erreur = false;
                
            $numMemb = 0;
            $prenomMemb = ctrlSaisies(($_POST['prenomMemb']));
            $nomMemb = ctrlSaisies(($_POST['nomMemb']));
            $pseudoMemb = ctrlSaisies(($_POST['pseudoMemb']));
            $passMemb = ctrlSaisies(($_POST['passMemb']));
            $eMailMemb = ctrlSaisies(($_POST['eMailMemb']));
            $dtCreaMemb = ctrlSaisies(($_POST['dtCreaMemb']));
            $dtCreaMemb = ("Y-m-d-H-i-s");
            $valSouvenirMemb = ctrlSaisies($_POST['souvenirMemb']);
            $souvenirMemb = ($valSouvenirMemb == "on") ? 1 : 0;
            $valAccordMemb = ctrlSaisies($_POST['accordMemb']);
            $accordMemb = ($valAccordMemb == "on") ? 1 : 0;

            // if pseudo 6> 70 get exist pseudo 
            if ($pseudoMemb > 6 AND $pseudoMemb < 70){
                $pseudoMembV == 1
            } else {
                $pseudoMembV == 0
                $messageErreur1 = "Votre pseudo doit comprendre entre 6 et 70 caractères"       
            }
            
            // pseudo disponible
            $reqpseudo = $bdd->prepare("SELECT * FROM MEMBRE WHERE pseudoMemb = ?");
              $reqpseudo->execute(array($pseudoMemb));
              $pseudoexist = $reqpseudo->rowcount();
            if ($reqpseudo == 0 ){
                $pseudMembCheck == 1
            } else {
                $pseudMembCheck == 0
                $messageErreur2 = "Ce pseudo est déja pris"
            }
         
            // validité mail 1 et 2 
            if (filter_var($eMailMemb, FILTER_VALIDATE_EMAIL)){
                $emailCheckV == 1
            } else {
                $emailCheckV == 0
                $messageErreur3 = "Cette adresse mail n'est valable"
            }
            
            // mail égaux 
            if ($eMailMemb == $eMailMemb2){
                $eMailMembV == 1
            } else {
                $eMailMembV == 0
                $messageErreur4 = "Les adresses mail saisies doivent être identique"
            }
           
            // pass égaux 
            if ($passMemb == $passMemb2){
                $passMembV == 1
            } else {
                $passMembV == 0
                $messageErreur5 = "Les mots de passe saisis doivent être identique"
            }

            // accord RGPD 
            if ($accordMemb == 1){
                $accordMembV == 1
            } else {
                $accordMembV == 0
                $messageErreur6 = "Veuillez accepter les Conditionns Générales d'Utilisation"
            }


            //tout les booleens (tous a 1) -> pasword hash -> create 


            $monMembre->create($num, $libAngl, $numLang);

        }   // Fin if ((isset($_POST['legendImg'])) ...
        else {
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // Fin else erreur saisies

  }   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

    // Init variables form
    include __DIR__ . '/initMembre.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Angle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Membre</h1>
    <h2>Ajout d'un Membre </h2>

    <form method="post" action="./createMembre.php" enctype="multipart/form-data">

        <fieldset>
            <legend class="legend1">Formulaire Membre...</legend>
            <br>
            <div class="control-group">
                <label class="control-label" for="prenomMemb"><b>Prénom (*):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="text" name="prenomMemb" id="prenomMemb" size="70" maxlength="70" value="<?= $prenomMemb; ?>" autofocus="autofocus" />
            </div><br>
            <div class="control-group">
                <label class="control-label" for="nomMemb"><b>Nom (*):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label><br>
                <input type="text" name="nomMemb" id="nomMemb" size="70" maxlength="70" value="<?= $nomMemb; ?>" autofocus="autofocus" />
            </div><br>
            <div class="control-group">
                <label class="control-label" for="pseudoMemb"><b>Pseudo (*):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="text" name="pseudoMemb" id="pseudoMemb" size="70" maxlength="70" value="<?= $pseudoMemb; ?>" autofocus="autofocus" />
            </div>
            <br>
            <div class="control-group">
                <label class="control-label" for="eMailMemb"><b>Email (*):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label><br>
                <input type="text" name="eMailMemb" id="eMailMemb" size="70" maxlength="70" value="<?= $eMailMemb; ?>" autofocus="autofocus" />
            </div>
            <br>
            <div class="control-group">
                <label class="control-label" for="eMailMemb2"><b>Confirmer l'Email (*):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="text" name="eMailMemb2" id="eMailMemb2" size="70" maxlength="70" value="<?= $eMailMemb2; ?>" autofocus="autofocus" />
            </div>
            <br>
            <div class="control-group">
                <label class="control-label" for="passMemb"><b>Mot de passe (*):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="text" name="passMemb" id="passMemb" size="70" maxlength="70" value="<?= $passMemb; ?>" autofocus="autofocus" />
            </div>
            <br>
            <div class="control-group">
                <label class="control-label" for="passMemb2"><b>Confirmer le mot de passe (*):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="text" name="passMemb2" id="passMemb2" size="70" maxlength="70" value="<?= $passMemb; ?>" autofocus="autofocus" />
            </div>
            <br>
            <div class="control-group">
                <label class="control-label" for="souvenirMemb"><b>Se souvenir de moi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="checkbox" name="souvenirMemb" id="souvenirMemb" size="80" maxlength="30" value="<?= $souvenirMemb; ?>" autofocus="autofocus" />
            </div>
            <br>
            <div class="control-group">
                <label class="control-label" for="accordMemb"><b>Accepter les CGU&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="checkbox" name="accordMemb" id="accordMemb" size="80" maxlength="30" value="<?= $accordMemb; ?>" autofocus="autofocus" />
            </div>
            <br>
            <script src="https://www.google.com/recaptcha/api.js"></script>
            <script>
                function onSubmit(token) {
                    document.getElementById("demo-form").submit();
                }
            </script>
            <button class="g-recaptcha" data-sitekey="6LdB2lMaAAAAABJI0TSsep65vf-x8oT8g0E6ogcr" data-callback='onSubmit' data-action='submit'>Submit</button>
            <br><br>

            <b>Tout les champs contenant (*) sont obligatoires.</b>
            <div class="control-group">
                <div class="controls">
                    <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Initialiser" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" value="on" />
                    <br>
                </div>
            </div>
        </fieldset>
    </form>
    <?
require_once __DIR__ . '/footermembre.php';

require_once __DIR__ . '/footer.php';
?>
</body>

</html>