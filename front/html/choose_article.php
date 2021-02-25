<?php

// Mode DEV
    require_once __DIR__ . '/../../util/utilErrOn.php';


    // controle des saisies du formulaire


    // insertion classe MEMBRE
    require_once __DIR__ . '/../../util/ctrlSaisies.php';
    require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';
    global $db;
    $monStatutMM = new ARTICLE;
?>
<!--------------------------------------------------------------------------------------------->
                                <!-- FIN PARTIE ESSENTIELLE -->
                                 <!-- DEBUT DES CONDITIONS -->
<!--------------------------------------------------------------------------------------------->
<?php
    echo "test 0";
if ($_SERVER["REQUEST_METHOD"] === "POST") { //obligatoire ? 
    echo "test 1";
// Opérateur ternaire
$Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';


if ((isset($_POST['Submit'])) AND ($Submit === 'Initialiser')) { //partie initialiser non utile ici ? 
  header("Location: ./chooseArticle.php");
  exit();
}   // End of if ((isset($_POST["submit"])) ...

if ((isset($_POST['id'])) AND !empty($_POST['id'])
    AND ((isset($_POST['libTitrArt'])) AND !empty($_POST['libTitrArt'])) //variable LibTitrArt
    AND (!empty($_POST['Submit']) AND ($Submit == "Submit"))) {


    echo "test 2";
      // Saisies valides
      $erreur = false;

      $numArt = ctrlSaisies($_POST['id']);
      $libTitrArt = ctrlSaisies(($_POST['libTitrArt']));
    $monArticle->get_SomeArt($numArt/*,$libTitrArt*/);
        header("Location: ./template_article.php");
  }   // Fin if ((isset($_POST['legendImg'])) ...
  else {
      $erreur = true;
      $errSaisies =  "Vous devez choisir un article !";
  }   // Fin else erreur saisies

}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

?>
<!--------------------------------------------------------------------------------------------->
                                <!-- DEBUT PARTIE HTML -->
<!--------------------------------------------------------------------------------------------->


<!-- DÉBUT Listbox COMMENT CHOISIR L'ARTICLE -->
<div class="control-group">
    <label class="control-label" for="LibNumArt"></label>
        <input type="hidden" id="idNumArt" name="idNumArt" value="<?= isset($_GET['numArt']) ? $_GET['numArt'] : '' ?>" />

        <select size="1" name="TypArt" id="TypsArt" required class="form-control form-control-create" title="Sélectionnez le nom de l'article !" >
           <option value="-1">Choisissez un article </option>
<?
    $numArt = "";
    $libTitrArt = "";

    $queryText = 'SELECT * FROM ARTICLE ORDER BY numArt;';
    $result = $db->query($queryText);
    if ($result) {
        while ($tuple = $result->fetch()) {
            $LibNumArt = $tuple["numArt"];
            $LibTitrArt = $tuple["libTitrArt"];
?>
            <option value="<?= $LibNumArt; ?>" >
                <?= $LibTitrArt; ?>
            </option>
<?
        } // End of while
    }   // if ($result)
?>
        </select>
</div>
<!-- FIN Listbox COMMENT CHOISIR L'ARTICLE -->
<div class="control-group">
            <div class="controls">
                <br><br>

                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Submit" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 1px grey; border-radius:5px;" name="Submit" />
                <br>
            </div>
        </div>