<?php
//========================================//
//
//               login.php
//
//========================================//

// WRITE YOUR PHP LOGIC HERE
$page_title = 'Login';
$page_description = '';
$error = null;

// Insertion classe
require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
require_once __DIR__ . '/../../CLASS_CRUD/auth.class.php';
$membre = new MEMBRE();
$auth = new AUTH();

if ($auth->is_connected()) {
    header('Location: /../../index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['pseudoMemb']) && !empty($_POST['password'])) {
        $login = $auth->login($_POST['pseudoMemb'], $_POST['password']);
        if ($login) { //Si le pseudo et le mot de passe sont corrects
            header('Location: ../../index.php');
            echo "Connexion réussie";
        } else { //Si le pseudo et/ou le mot de passe est incorrect.
            $error = 'Identifiants incorrects !';
            echo $error;
        }
        unset($_POST['pseudoMemb'], $_POST['password']);
    }
}

?>

<div class='sign_container layout'>
    <div class='login'>
        <?php if ($error) : ?>
            <span id="error" style="display: none;"><?= $error ?></span>
        <?php endif ?>

        <h2>Connexion</h2>
        <div class="input_container">
            <form action="" method="POST">
                <div class="input-group">
                    <input class="input" name="pseudoMemb" type="pseudoMemb" placeholder="Pseudo" required />
                    <label>Pseudo</label>
                </div>
                <div class="input-group">
                    <input class="input" name="password" type="password" placeholder="Mot de passe" required />
                    <label>Mot de passe</label>
                    <a class="tips" href="">Mot de passe oublié ?</a>
                </div>
                <div class="input-group">
                    <button class="button button-submit" type="submit">Se connecter</button>
                    <p class="tips">Pas de compte ? <a href="../../front/html/inscription.php">Inscris-toi !</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
