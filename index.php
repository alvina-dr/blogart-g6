<!DOCTYPE html>
<html lang="fr">

<HEAD>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="front/assets/icons/logo.ico" />
    <title>B.Game | Beat the game</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!--linker stylesheet-->
    <link rel="stylesheet" type="text/css" href="/front/css/base.css">
    <link rel="stylesheet" type="text/css" href="/front/css/font.css">
    <link rel="stylesheet" type="text/css" href="/front/css/insolite.css">
    <link rel="stylesheet" type="text/css" href="/front/css/index.css">
    <link rel="stylesheet" type="text/css" href="/front/css/header.css">
    <link rel="stylesheet" type="text/css" href="/front/css/footer.css">

</HEAD>
<body>
    <?php
        require_once __DIR__ . '/front/html/header.php';
        ?>
    <?php
        require_once __DIR__ . '/front/html/showcookie.php';
        ?>
    <div class="title2">
        <div class="title">
            <h1>B.GAME</h1>
            <h2 class="padding_h2">Beat the game</h2>
            <img class="soulignage padding_soulignage" src="/front/assets/icons/soulignage.svg">
        </div>
    </div>

    <div class="move_mouse">
    <a><section id="section10" class="demo">
    <a href="#section2"><span></span></a></a>
    </section>
    </div>


    <!-- SECTION HACKTU - BGF -->
    <a id="section2"></a>
    <div class="acgameboy">
        <img class="actu" src="/front/assets/icons/hacktu.png">
        <img class="gameboy" src="/front/assets/icons/gameboy.svg">
    </div>
    <div class="h22">
        <h2>GeekFest, le festival Bordelais à ne pas manquer !</h2>
        <img class="soulignage4" src="/front/assets/icons/soulignage.svg">
    </div>
    <div class="p_landing">
        <p class="p_actu">
            Un festival de jeux-vidéo à Bordeaux, ça existe. Le Bordeaux Geek Festival ouvrira ses portes pour la
            septième année consécutive en mai prochain, avec son lot de nouveautés, de divertissement, et de
            compétitions. Alors que vous soyez néophytes ou habitués du BGF, on vous emmène faire le tour de ce pilier
            du gaming Bordelais.
        </p>
        <a class="btnplus" href="/front/html/hacktu.php"></a> <!-- BOUTON EN SAVOIR PLUS -->
    </div>


    <!-- SECTION ACTEURS CLÉS -->
<br>
<br>
<br>
<br>
    <img class="h22 acteurclef" src="/front/assets/icons/acteurcleff.png">
    <div class="column">
    <div class="p_landing h22">
        <div class="column">
            <div>
                <h2>3 dimensions du jeu vidéo à Bordeaux</h2>
                <img class="soulignage1" src="/front/assets/icons/soulignage.svg">
                <p class="h22 p_actu">
                    La culture du jeu vidéo évolue de manière exponentielle dans le monde entier. Qu’en est-il du jeu
                    vidéo à Bordeaux ? Cette ville est un des principaux acteurs français dans ce domaine regroupant
                    plusieurs entreprises tel que Glitchr, Asobo et Ubisoft. Découvrons les de plus près...
                </p>
            </div>
            <a class="btnplus" href="/front/html/actors.php"></a> <!-- BOUTON EN SAVOIR PLUS -->
        </div>
        <div class="column">
            <img class="immeuble" src="/front/assets/icons/immeuble.png">
        </div>
    </div>
    </div>


    <!-- SECTION INSOLITE ÉCOLE D'E-SPORT -->
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <div class="acgameboy">
        <img class="graduate_student" src="/front/assets/icons/graduateed_1.png"> <!-- ICON GRADUATE STUDENT -->
        <div class="column">
            <img class="imginsolite" src="/front/assets/images/insolite.png"> <!-- TITRE INSOLITE -->
            <div class="h22">
                <h2>Les écoles d'e-sport,<br>un miroir de riséd ?</h2>
                <img class="soulignage2" src="/front/assets/icons/soulignage.svg">
            </div>
            <a class="btnplus" href="/front/html/insolite.php"></a> <!-- BOUTON EN SAVOIR PLUS -->
        </div>

    </div>

<br>
<br>
<br>
<?php
        require_once __DIR__ . '/front/html/choose_article.php';
    ?>
<br>
<br>
<br>
<br>

    <img class="mouse_newsletter" src="/front/assets/icons/newsletter.png">
    <br>
    <br>
    <a href="#pageinscription"><img class="h22" src="/front/assets/icons/inscription_nl.png"></a><br>
    <a href="./connexion.php"><img class="h22" src="/front/assets/icons/connexion_nl.png"></a>
    <?php
        require_once __DIR__ . '/front/html/footer.php';
    ?>
	<script src="/front/js/typewriter.js"></script>
</body>

</html>