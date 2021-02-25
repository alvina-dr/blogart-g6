<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="content" content="description">
    <title>B.Game | Hacktu</title>

    <link rel="icon" type="image/ico" href="../assets/icons/logo.ico"/>

    <!--linker stylesheet-->
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/font.css">
    <link rel="stylesheet" href="../css/hacktu.css">
    <link rel="stylesheet" type="text/css" href="../css/insolite.css">
</head>


<body>
    <?php
        require_once __DIR__ . '/header.php';
    ?>
    <?php
        require_once __DIR__ . '/liketag.php';
        require_once __DIR__ . '../../../back/article/viewArticleSite.php';
    ?>

<?php
       require_once __DIR__ . '../../../back/comment/createCommentSite.php';
       require_once __DIR__ . '../../../back/comment/viewCommentSite1.php';
       require_once __DIR__ . '/footer.php';
    ?>
</body>

</html>