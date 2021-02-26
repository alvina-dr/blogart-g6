<?php
///////////////////////////////////////////////////////////////
//
//  CRUD THEMATIQUE (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : updateThematique.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////
$pageTitle = 'Thématique';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
$langue = new LANGUE();
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
$thematique = new THEMATIQUE();

// Init variables form
include __DIR__ . '/initThematique.php';
$error = null;


// Controle des saisies du formulaire
if (isset($_GET['id'])) {
    $result = $thematique->get_1Thematique($_GET['id']);
    $libThem = ctrlSaisies($result->libThem);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['submit']) && $_POST['submit'] === 'Submit' && !empty($_POST['libThem'])) {
            $numThem = $_GET['id'];
            $libThem = $_POST['libThem'];

            if (strlen($libThem) >= 3) {
                // Modification effective de la thématique
                $thematique->update($numThem, $libThem);

                header('Location: ./thematique.php');
            } else {
                $error = 'La longueur minimale d\'une thématique est de 3 caractères.';
            }
        } else if (!empty($_POST['submit']) && $_POST['submit'] === 'Initialiser') {
            header('Location: ./updateThematique.php?id=' . $_GET['id']);
        } else {
            $error = 'Merci de renseigner tous les champs du formulaire.';
        }
    }
}

$languages = $langue->get_AllLangues();
?>

<main class="container">
 <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Thématique</h1>
        <hr>

        <div class="row d-flex justify-content-center">
            <div class="col-8">
                <h2>Modification d'une thématique</h2>

                <?php if ($error) : ?>
                    <div class="alert alert-danger"><?= $error ?: '' ?></div>
                <?php endif ?>

                <form class="form" method="post" action="" enctype="multipart/form-data">

                    <fieldset>
                        <legend class="legend1">Formulaire Thématique...</legend>

                        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ?: '' ?>" />

                        <div class="control-group">
                            <label for="libThem"><b>Nom de la thématique :</b></label>
                            <input class="form-control" type="text" name="libThem" id="libThem" size="80" maxlength="80" value="<?= $libThem ?>" autofocus="autofocus" />
                        </div>

                        <!-- Listbox langue -->
    <br>
        <div class="control-group">
            <label class="control-label" for="LibTypLang"><b>Quelle langue :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idTypLang" name="idTypLang" value="<?= isset($_GET['numLang']) ? $_GET['numLang'] : '' ?>" />

                <select size="1" name="TypLang" id="TypLang" required class="form-control form-control-create" title="Sélectionnez la langue !" >
                   <option value="-1">Choisissez une langue </option>
<?
            $numLang = "";
            $lib1Lang = "";

            $queryText = 'SELECT * FROM LANGUE ORDER BY lib1Lang;';
            $result = $db->query($queryText);
            if ($result) {
                while ($tuple = $result->fetch()) {
                    $ListNumLang = $tuple["numLang"];
                    $ListLibLang = $tuple["lib1Lang"];
?>
                    <option value="<?= $ListNumLang; ?>" >
                        <?= $ListLibLang; ?>
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
                <input type="submit" value="Initialiser" class="imputFields" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" class="imputFields" name="Submit"/>
                <br>       
            </div>
        </div>
      </fieldset>
                </form>
            </div>
        </div>

        <?
require_once __DIR__ . '/footerThematique.php';

require_once __DIR__ . '/footer.php';
?>
    </div>
</main>