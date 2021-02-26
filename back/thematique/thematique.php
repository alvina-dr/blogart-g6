<?php
/////////////////////////////////////////////////////
//
//  CRUD THEMATIQUE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : thematique.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////
$pageTitle = 'Thématique';

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Insertion classe ANGLE
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
$thematiques = new THEMATIQUE();

// Appel méthode : tous les angles en BDD
$all = $thematiques->get_AllThematiques();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Gestion des thématiques</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="../../back/css/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .error {
            padding: 2px;
            border: solid 0px black;
            color: red;
            font-style: italic;
            border-radius: 5px;
        }
    </style>
</head>
<main class="container">
    <div class="d-flex flex-column">
        <h1>BLOGART21 Admin - Gestion du CRUD Thématique</h1>
        <img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
        <h2>Nouvelle Thématique : <a href="./createThematique.php"><i>Créer une Thématique</i></a></h2>
        <img class="soulignage2" src="../../front/assets/icons/soulignage.svg"> <!--BARRE--><br />
        <h2>Toutes les Thématiques</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Langue</th>
                    <th>Libellé</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all as $row) : ?>
                    <tr>
                        <td>
                            <h4> <?= $row->numThem ?> </h4>
                        </td>
                        <td> <?= $row->numLang ?> </td>
                        <td> <?= $row->libThem ?> </td>
                        <td><a href="./updateThematique.php?id=<?= $row->numThem ?>"><i>Modifier</i></a>
                            <br>
                        </td>
                        <td><a href="./deleteThematique.php?id=<?= $row->numThem ?>"><i>Supprimer</i></a>
                            <br>
                        </td>
                    </tr>
                <?php endforeach  ?>
            </tbody>
        </table>
    </div>
</main>
<?php require_once __DIR__ . '/../footer.php' ?>