<!DOCTYPE html>
<html lang="fr">

    <HEAD>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/ico" href="../assets/icons/logo.ico"/>
        <title>B.GAME | Inscription</title>

        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <!--linker stylesheet-->
        <link rel="stylesheet" type="text/css" href="../css/base.css">
        <link rel="stylesheet" type="text/css" href="../css/font.css">
        <link rel="stylesheet" type="text/css" href="../css/insolite.css">
        <link rel="stylesheet" type="text/css" href="../css/index.css">
        <link rel="stylesheet" type="text/css" href="../css/footer.css">
        <link rel="stylesheet" type="text/css" href="../css/inscription.css">
    </HEAD>

    <body>
    <?php
        require_once __DIR__ . '/header.php';
        ?>
        <div class="flex">
            <img src="../assets/icons/contact.svg">
            <div>
                <img class="h22" src="../assets/icons/bvn.png">
                <div class=h22>
                    <p>Nom</p>
                    <img src="../assets/icons/soulignagedroit.svg">
                </div>
                <div class=h22>
                    <p>Prénom</p>
                    <img src="../assets/icons/soulignagedroit.svg">
                </div>
                <div class=h22>
                    <p>Pseudo</p>
                    <img src="../assets/icons/soulignagedroit.svg">
                </div>
                <div class=h22>
                    <p>Adresse mail</p>
                    <img src="../assets/icons/soulignagedroit.svg">
                </div>
                <div class=h22>
                    <p>Confirmation adresse mail</p>
                    <img src="../assets/icons/soulignagedroit.svg">
                </div>
                <div class=h22>
                    <p>Mot de passe</p>
                    <img src="../assets/icons/soulignagedroit.svg">
                </div>
                <div class=h22>
                    <p>Confirmation mot de passe</p>
                    <img src="../assets/icons/soulignagedroit.svg">
                </div>
                <a><img class="h22 hwg" src="../assets/icons/hwg.png"></a>
            </div>
        </div>
        <?php
        require_once __DIR__ . '/footer.php';
    ?>
    </body>
</html>