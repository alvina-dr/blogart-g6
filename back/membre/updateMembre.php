<?
/////////////////////////////////////////////////////
//
//  CRUD MEMBRE (PDO) - Modifié - 8 Aout 2020
//
//  Script  : updateMembre.php
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

    // controle des saisies du formulaire
    require_once __DIR__ . '/../../util/ctrlSaisies.php';
    require_once __DIR__ . '/../../util/delAccents.php';
    require_once __DIR__ . '/../../util/dateChangeFormat.php';

    require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
    global $db;
    $monMembre = new MEMBRE();

    // Gestion des erreurs de saisie
    $erreur = false;
    $msgErrPseudo = "";
    $msgErrExistPseudo = "";
    $msgErrMail1 = "";
    $msgErrMail2 = "";
    $msgErrMailIdentiq = "";
    $msgErrPassIdentiq = "";
    $mailIdentiqF1 = 0;
    $passIdentiqF1 = 0;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Opérateur ternaire
        $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

        if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Initialiser")) {

            $sameId = $_POST['id'];
            header("Location: ./updateMembre.php?id=".$sameId);
        }   // End of if ((isset($_POST["submit"])) ...

        // Mode mise à jour
        if ((isset($_POST['id']) AND $_POST['id'] > 0)
            AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

            if (((isset($_POST['prenomMemb'])) AND !empty($_POST['prenomMemb']))
                AND ((isset($_POST['nomMemb'])) AND !empty($_POST['nomMemb']))
                AND ((isset($_POST['pass1Memb'])) AND !empty($_POST['pass1Memb']))
                // AND ((isset($_POST['pass2Memb'])) AND !empty($_POST['pass2Memb']))
                AND ((isset($_POST['eMail1Memb'])) AND !empty($_POST['eMail1Memb']))
                // AND ((isset($_POST['eMail2Memb'])) AND !empty($_POST['eMail2Memb']))
                AND ((isset($_POST['souvenirMemb'])) AND !empty($_POST['souvenirMemb']))
                AND ((isset($_POST['TypStat'])) AND !empty($_POST['TypStat']))) {


                // Saisies valides
                $erreur = false;

                $numMemb = ctrlSaisies($_POST['id']);
                $prenomMemb = ctrlSaisies($_POST['prenomMemb']);
                $nomMemb = ctrlSaisies($_POST['nomMemb']);

                $pass1Memb = ctrlSaisies($_POST['pass1Memb']);
                $pass2Memb = (isset($_POST['pass2Memb']) AND !empty($_POST['pass2Memb'])) ? ctrlSaisies($_POST['pass2Memb']) : '';

                $eMail1Memb = ctrlSaisies($_POST['eMail1Memb']);
                $eMail2Memb = (isset($_POST['eMail2Memb']) AND !empty($_POST['eMail2Memb'])) ? ctrlSaisies($_POST['eMail2Memb']) : '';

                $valSouvenirMemb = ctrlSaisies($_POST['souvenirMemb']);
                $souvenirMemb = ($valSouvenirMemb == "on") ? 1 : 0;
                $idStat = ctrlSaisies($_POST['TypStat']);

                // CTRL saisies
                // VALIDITÉ MAIL
                if ($eMail2Memb != '') {
                    # Modification MAIL
                    if (filter_var($eMail1Memb, FILTER_VALIDATE_EMAIL)) {
                        $mail1F1 = 1;    // TRUE
                        $msgErrMail1 = "";
                    } else {
                        $mail1F1 = 0;    // FALSE
                        $msgErrMail1 = "&nbsp;&nbsp;- Premier mail invalide<br>";
                    }
                    if (filter_var($eMail2Memb, FILTER_VALIDATE_EMAIL)) {
                        $mail2F1 = 1;    // TRUE
                        $msgErrMail2 = "";
                    } else {
                        $mail2F1 = 0;    // FALSE
                        $msgErrMail2 = "&nbsp;&nbsp;- Deuxième mail invalide<br>";
                    }
                    // MAIL IDENTIQUE
                    if ($mail1F1 == 1 AND $mail2F1 == 1) {
                        if ($eMail1Memb == $eMail2Memb) {
                            $mailIdentiqF1 = 1;
                            $msgErrMailIdentiq = "";
                        } else {
                            $mailIdentiqF1 = 0;
                            $msgErrMailIdentiq = "&nbsp;&nbsp;- Les 2 mails doivent être identiques<br>";
                        }
                    } else {
                        $mailIdentiqF1 = 0;
                        $msgErrMailIdentiq = "&nbsp;&nbsp;- Les 2 mails doivent être identiques<br>";
                    }
                } else {
                    // Mail non modifié
                    $mailIdentiqF1 = 1;
                    $msgErrMailIdentiq = "";
                }
                // TEST MODIF PASS
                if ($pass2Memb != '') {
                    # Modification PASS & CTRL PASS VALIDE
                    if ($pass1Memb == $pass2Memb) {
                        $passIdentiqF1 = 1;
                        $pass1Memb = password_hash($_POST['pass1Memb'], PASSWORD_DEFAULT, ['cost' => 15]);
                        $msgErrPassIdentiq = "";
                    } else {
                        $passIdentiqF1 = 0;
                        $msgErrPassIdentiq = "&nbsp;&nbsp;- Les 2 passwords doivent être identiques<br>";
                    }
                } else {
                    // PAss non modifié
                    $passIdentiqF1 = 1;
                    $msgErrPassIdentiq = "";
                    $pass1Memb = -1;  // On garde ancien pass
                }

                if ($prenomMemb != "" AND $nomMemb != "" AND $mailIdentiqF1 == 1 AND $passIdentiqF1 == 1) {

                    $monMembre->update($numMemb, $prenomMemb, $nomMemb, $pass1Memb, $eMail1Memb, $souvenirMemb, $idStat);

                    header("Location: ./membre.php");
                } else {
                    $erreur = true;
                    $errSaisies = "Insert impossible, incohérence données saisies :<br>" . $msgErrMail1 . $msgErrMail2 . $msgErrMailIdentiq . $msgErrPassIdentiq;
                }

            }   // Fin if ((isset($_POST['prenomMemb'])) ...
            else {
                $erreur = true;
                $errSaisies =  "Erreur, la saisie est obligatoire !";
            }   // Fin else Saisies invalides

       }   // Fin TP mise à jour

    }   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
    // Init variables form
    include __DIR__ . '/initMembre.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Membre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .error {
            padding: 2px;
            border: solid 0px black;
            color: red;
            font-style: italic;
            border-radius: 5px;
        }
    </style>
    <script>
        function myFunction(myInputPass) {
            var x = document.getElementById(myInputPass);
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
        }
    </script>
</head>
<body>
    <h1>Admin - Gestion du CRUD Membre</h1>
    <h2>Modification d'un membre</h2>
<?
    // Format date en FR
    $from = 'Y-m-d H:i:s';
    $to = 'd/m/Y H:i:s';

    if (isset($_GET['id']) and $_GET['id'] > 0) {

        $id = ctrlSaisies(($_GET['id']));

        $query = (array)$monMembre->get_1Membre($id);

        if ($query) {

            $id = $query['numMemb'];
            $prenomMemb = $query['prenomMemb'];
            $nomMemb = $query['nomMemb'];
            $pseudoMemb = $query['pseudoMemb'];
            $pass1Memb = $query['passMemb'];
            $eMail1Memb = $query['eMailMemb'];
            $souvenirMemb = $query['souvenirMemb'];
            $accordMemb = $query['accordMemb'];
            $dtCreaMemb = $query['dtCreaMemb'];
            // date dtCreaMemb => FR
            $dtCreaMemb = dateChangeFormat($dtCreaMemb, $from, $to);
            $idStat = $query['idStat'];

        }   // Fin if ($query)

    }   // Fin if (isset($_GET['id'])...)

?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Membre...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="prenomMemb"><b>Prénom<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="prenomMemb" id="prenomMemb" size="80" maxlength="80" value="<?= $prenomMemb; ?>" autocomplete="on" autofocus="autofocus" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="nomMemb"><b>Nom<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="nomMemb" id="nomMemb" size="80" maxlength="80" value="<?= $nomMemb; ?>" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pseudoMemb"><b>Pseudonyme :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="pseudoMemb" id="pseudoMemb" size="80" maxlength="80" value="<?= $pseudoMemb; ?>" disabled />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pass1Memb"><b>Mot passe<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="pass1Memb" id="myInput1" size="80" maxlength="80" value="<?= $pass1Memb; ?>" autocomplete="on" />
            <br>
            <input type="checkbox" onclick="myFunction('myInput1')">
            &nbsp;&nbsp;
            <label><i>Afficher mot de passe</i></label>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pass2Memb"><b>Confirmez le mot passe<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="pass2Memb" id="myInput2" size="80" maxlength="80" value="<?= $pass2Memb; ?>" autocomplete="on" />
            <br>
            <input type="checkbox" onclick="myFunction('myInput2')">
            &nbsp;&nbsp;
            <label><i>Afficher mot de passe</i></label>
        </div>
        <small class="error">*Champ obligatoire si nouveau passe</small><br>
        <br>
        <div class="control-group">
            <label class="control-label" for="eMail1Memb"><b>eMail<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail1Memb" id="eMail1Memb" size="80" maxlength="80" value="<?= $eMail1Memb; ?>" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="eMail2Memb"><b>Confirmez l'eMail<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail2Memb" id="eMail2Memb" size="80" maxlength="80" value="<?= $eMail2Memb; ?>" autocomplete="on" />
        </div>
        <small class="error">*Champ obligatoire si nouveau eMail</small><br>

        <br><br>
        <div class="control-group">
            <label class="control-label" for="souvenirMemb"><b>Je veux pouvoir me reconnecter automatiquement :</b></label>
            <div class="controls">
               <fieldset>
                  <input type="radio" name="souvenirMemb"
                  <? if($souvenirMemb == 1) echo 'checked="checked"'; ?>
                  value="on" />&nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="souvenirMemb"
                  <? if($souvenirMemb == 0) echo 'checked="checked"'; ?>
                  value="off" />&nbsp;&nbsp;Non
               </fieldset>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="accordMemb"><b>J'ai accepté que mes données soient conservées :</b></label>
            <div class="controls">
               <fieldset>
                  <input type="radio" name="accordMemb"
                  <? if($accordMemb == 1) echo 'checked="checked"'; ?>
                  value="on" disabled />&nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="accordMemb"
                  <? if($accordMemb == 0) echo 'checked="checked"'; ?>
                  value="off" disabled />&nbsp;&nbsp;Non
               </fieldset>
            </div>
        </div>
        <br><br>

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox statut -->

        <div class="control-group">
            <label class="control-label" for="LibTypStat"><b>Statut :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idStat" name="idStat" value="<?= isset($_GET['idStat']) ? $_GET['idStat'] : '' ?>" />

                <select size="1" name="TypStat" id="TypStat" required class="form-control form-control-create" disabled >
                   <option value="-1">- - - Choisissez un statut - - -</option>
<?
            $queryText = 'SELECT * FROM STATUT ORDER BY libStat;';
            $result = $db->query($queryText);
            if ($result) {
                while ($tuple = $result->fetch()) {
                    $ListIdStat = $tuple["idStat"];
                    $ListNomStat = $tuple["libStat"];
?>
                    <option value="<?= ($ListIdStat); ?>" <?= ((isset($idStat) && $idStat == $ListIdStat) ? " selected=\"selected\"" : null); ?> >
                        <?= $ListNomStat; ?>
                    </option>
<?
                } // End of while
            }   // if ($result)
?>
                </select>
        </div>

    <!-- FIN Listbox statut -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
        <br>
        <div class="control-group">
            <label class="control-label" for="dtCreaMemb"><b>Date création :&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="dtCreaMemb" id="dtCreaMemb" value="<?= $dtCreaMemb; ?>" disabled />
        </div>
        <small>(Pour mémoire)</small><br>

        <div class="control-group">
            <div class="error">
<?
            if ($erreur) {
                echo ($errSaisies);
            }
            else {
                $errSaisies = "";
                echo ($errSaisies);
            }
?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Initialiser" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                <br>
            </div>
        </div>
      </fieldset>
    </form>
<?
require_once __DIR__ . '/footerMembre.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
