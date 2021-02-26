<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/ico" href="../assets/icons/logo.ico" />
    <title>B.Game | Acteur clef</title>
    <!--linker stylesheet-->
    <link type="text/css" rel="stylesheet" href="../css/actors.css">
    <link type="text/css" rel="stylesheet" href="../css/base.css">
    <link type="text/css" rel="stylesheet" href="../css/font.css">
    
</head>

<body>
    

    <?php
        require_once __DIR__ . '/header.php';
    ?>
    <?php
        require_once __DIR__ . '/liketag.php';
    ?>


<!-- <div class="placeholder"></div> -->

    <div style="position:absolute;z-index:1;margin-left: 2%;margin-right: 2%;" class="marge">
        <img class="img_acteur" src="../assets/images/acteur.png">
        <div class="marge1">
            <h2>3 dimensions du jeu vidéo à Bordeaux</h2>
            <img class="padding_soulignage" src="../assets/images/barre_soulignage.png">
        </div>
        <div class="marge1">
            <p>La culture du jeu vidéo évolue de manière exponentielle dans le monde entier.
                Qu’en est-il du jeu vidéo à Bordeaux ?<br> Cette ville est un des principaux acteurs français
                dans ce domaine regroupant plusieurs entreprises tel que Glitchr, Asobo et Ubisoft.<br><br>
                Découvrons les de plus près...</p>
        </div>
    </div>
    <div>
        <img class="img_acteur2" src="../assets/images/image_acteur.png">

<!----------------------------------------------- début de l'effet ---------------------------------------------------->

<!-- <main>
	</main>

	vertex shader
	<script id="vertex-shader" type="x-shader/x-vertex">
	attribute vec2 a_position;
	attribute vec2 a_texCoord;
	varying vec2 v_texCoord;
	uniform vec2 u_resolution;
	varying vec2 v_resolution;

	void main() {
	   vec2 clipSpace = (a_position / u_resolution) * 2.0 - 1.0; // convert the rectangle from pixels to clipspace
	   gl_Position = vec4(clipSpace * vec2(1, -1), 0, 1);
	   v_texCoord = a_texCoord; // pass the texCoord to the fragment shader
	   v_resolution = u_resolution;
	}
	</script>

	 fragment shader
	<script id="fragment-shader" type="x-shader/x-fragment">
	precision mediump float;
	uniform sampler2D u_image;
	uniform vec2 u_mouse;
	varying vec2 v_resolution;
	varying vec2 v_texCoord;

	void main() {
		vec2 res = gl_FragCoord.xy / v_resolution;
		vec4 color = texture2D(u_image, v_texCoord);
	  gl_FragColor = color * vec4(u_mouse.y,res.y,u_mouse.x,1) ;
	}
	</script> -->

<!----------------------------------------- fin de l'effet --------------------------------------------------->
    </div>
    <div>
        <div class="marge">
            <h2>Les petites entreprises (Glitchr)</h2>
            <img class="padding_soulignage" src="../assets/images/barre_soulignage.png">
        </div>
        <div class="box1">
            <div>
                <p class="text_base" style="text-indent: 15px;"> Tout cookie a ses pépites de chocolats… Bordeaux aussi
                    en a !<br><br></p>
                    <p class="text_base" style="text-indent: 15px;">Il existe bel et bien d’incroyables trésors dissipés dans Bordeaux travaillant dans les jeux vidéo.
                    Parmi eux se trouve Glitchr :
                    Un petit studio illuminant la ville à travers son brillant regard vidéoludique sur ses jeux vidéos.
                </p>
            </div>
            <img class="img1_decal" src="../assets/images/manette.png">
            <img class="img1" src="../assets/images/vr.png">
        </div>
        <div>
            <p style="text-indent: 15px;">
                Vous pensiez qu’en France le marché du jeu vidéo était faible, vide de sens et d’ouverture ?
                Créé en 2014 par trois grands passionnés de jeux vidéo, Glitchr
                a su se dépasser et se montrer combattant face à ses concurrents ! Sa spécialité ? La réalité virtuelle
                !
                Le phénomène émergeant des jeux vidéo comme Sky Sanctuary VR, Géants Disparus VR
                ou même VR Performance invitant le joueur à entrer dans un univers en totale immersion.
                Glitchr a su se montrer visionnaire. Le studio flaire l’émancipation exponentielle de la réalité
                virtuelle en la convertissant en force pour les années à venir !
            </p>
        </div>
        <div>
            <p class="marge" style="text-indent: 15px;">
                Pour l’instant, le studio reste local. Il participe à la fierté bordelaise à travers les jeux vidéo. De
                part
                son
                engouement, il risque de devenir très bientôt connu à une autre échelle. Qu’en est-il des autres studios
                mondialement connus ?
            </p>
        </div>
    </div>
    <b><p><a href="https://www.glitchr-studio.com/fr/" class="interaction3" target="_blank">Pour en savoir plus sur Glitchr, cliquez ici !</a></b> </br> </br>
    <div>
        <div class="marge">
            <h2>Le studio bordelais (Asobo)</h2>
            <img class="padding_soulignage" src="../assets/images/barre_soulignage.png">
        </div>
        <div class="box1">
            <div>
                <p style="text-indent: 15px;padding-right: 10%;">
                    Asobo, ce nom vous dira peut-être quelque chose. Né en 2002, le studio de jeu vidéo bordelais fête
                    aujourd’hui
                    sa majorité avec un background déjà plutôt impressionnant.</p>
                <br><br>
                <p style="text-indent: 15px;padding-right: 10%;"> En effet, derrière ce nom se cache le studio qui a réalisé Microsoft
                    Flight Simulator et A plague
                    Tale :
                    Innocence, un jeu lauréat de six Pégases (équivalent des césars dans le jeu vidéo français) en 2020.
                    Alors
                    même
                    qu’il a une portée mondiale, le studio reste localisé en Gironde, là où il a grandi.
                    A Plague Tale : Innocence, de loin le jeu phare de Asobo raconte l’histoire de deux enfants, Amicia
                    et
                    son
                    petit
                    frère Hugo, survivant à la peste, à l’Inquisition française et aux rats pendant le XIVe siècle.</p>
                </p>
            </div>
            <img class="img2" src="../assets/images/img2.png">
        </div>
        <div>
            <p style="text-indent: 15px;">Sorti en Mai 2019 il permet d’explorer des paysages de Gironde et de Dordogne,
                forcément familiers pour
                les
                employés de l’entreprise.</p>
            <br>
        </div>
        <div>
            <p style="text-indent: 15px;">Asobo cache beaucoup de potentiel, et avec la préparation d’un futur jeu que
                les fans
                nomment pour
                l’instant
                “A
                Plague Tale 2” faute d’informations, le studio nous prépare encore de nombreuses surprises. La sortie
                est
                prévue
                pour 2022 et on l’attend avec impatience. Le studio est décidément un acteur central de l’industrie
                vidéoludique
                bordelaise. </p>
        </div>
    </div>
    <br>
    <br>
    <b><p><a href="https://www.asobostudio.com/fr" class="interaction3" target="_blank">Pour en savoir plus sur Asobo, cliquez ici !</a></b> </br> </br>
    <div>
        <div class="marge">
            <h2>Les studios internationaux (Ubisoft)</h2>
            <img class="padding_soulignage" src="../assets/images/barre_soulignage.png">
        </div>
        <div class="box1">
            <p style="text-indent: 15px;">Après Ubisoft Philippines et Ubisoft Stockholm, le célèbre studio de jeux<br>
                vidéo s’est
                implanté en 2017
                dans
                la ville de Bordeaux.</p>
        </div>
        <div class="box1">
            <div>
                <p style="text-indent: 15px;margin-right: 7%;"> Et oui, c’est bien du célèbre réalisateur d'Assassin's Creed, de Watch
                    Dog et de
                    Far
                    Cry dont il s’agit.
                    C’est une avancée intéressante pour la ville puisque l’entreprise exerce une forte influence sur le
                    monde
                    vidéoludique. Il n’est pas étonnant pourtant que le groupe ait choisi Bordeaux comme pied à terre.

                    Pourquoi ? Car Bordeaux est idéalement située pour commencer. À moins d’une heure en avion de la
                    plupart
                    des
                    capitales européennes, elle constitue un pôle économiquement et géographiquement phare du jeu vidéo
                    en
                    France ! Mais quel rôle a joué Ubisoft Bordeaux exactement ?</p>
            </div>
            <img class="img3" src="../assets/images/img3.png">
        </div>
        <div>
            <p style="text-indent: 15px;margin-top: 5%;">Et bien pour commencer le pôle girondin a participé à la création de
                Assassin’s Creed
                Valhalla, une
                licence
                mondialement connue faisant frissonner des millions de joueurs. Vous incarnerez un assassin doté de
                talents
                pendant l’ère vikings.
                Vous préférez le sport ? Et plus particulièrement la danse ? Just dance est fait pour vous ! Et vous
                savez
                quoi ? C’est Ubisoft de Bordeaux qui s’en est aussi occupé ! Quoi de mieux que de se dandiner le popotin
                sur
                vos musiques du moment entre amis ou en famille ?</p>
        </div>
        <div class="marge">
            <p style="text-indent: 15px;margin-bottom: -5%;">Comme on peut le voir il existe donc plusieurs niveaux d’activité dans
                l’industrie vidéoludique à
                Bordeaux.
                Ces différents acteurs sont aussi importants les uns que les autres puisqu’ils apportent tous une
                quantité
                de leur savoir faisant avancer le monde et sa culture. Grâce à Bordeaux, la dernière pièce du puzzle est
                placée, guidant la France vers dans les leaders de l’univers du jeu vidéo à l’échelle mondiale.</p>
        </div> </br> </br> </br>
    </div>
    <br>
    <br>
    <b><p><a href="https://www.ubisoft.com/fr-FR/studio/bordeaux.aspx" class="interaction3" target="_blank">Pour en savoir plus sur Ubisoft, cliquez ici !</a></b> </br> </br>

    <?php
        require_once __DIR__ . '../../../back/comment/createCommentSite.php';
        require_once __DIR__ . '../../../back/comment/viewCommentSite2.php';
        require_once __DIR__ . '/footer.php';
    ?>
	<script src="../js/acteurclef.js"></script>
</body>

</html>