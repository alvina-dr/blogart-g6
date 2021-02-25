<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="/images/icons/favicon.ico" />

    <!--linker stylesheet-->
    <link type="text/css" rel="stylesheet" href="../../front/css/cookies.css">
    <link type="text/css" rel="stylesheet" href="../..front/css/base.css">
    <link type="text/css" rel="stylesheet" href="../../front/css/font.css">
    
</head>


<?php if($showcookie) { ?>
    <div id="d1" class="bordure_cookies" >
    <div class="bordure2_cookies">
        <h4>Ce site web utilise des cookies</h4>
    </div>
    <br>
    <div class="texte_cookies">
        <p class="pcookies">Nous utilisons des cookies pour vous offrir la meilleure expérience possible. 
            Cliquez sur accepter pour continuer à naviguer ou pour en savoir plus sur notre politique
             en matière de cookies <a class="ici" href="../../front/html/mentionslégales.php">ici</a>.  </p>
    </div>
    <div class="img_cookies">
        <img src="../../front/assets/images/cookies.png">
    </div>
    <div id="togg2" class="croix_cookies">
        <img src="../../front/assets/images/croix.png">
    </div>
    <button class="valider_cookies">
        <h2 class="cookie_blanc"><a href="../../front/html/accept_cookie.php">Accepter</a></h2>
    <button id="togg3" class="refuser_cookies">
        <h2 class="cookie_blanc2">Refuser</h2>
</div>
<script type="text/javascript" src="../../front/js/cookies.js"></script>
<?php } ?>