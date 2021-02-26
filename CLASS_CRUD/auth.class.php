<?php

require_once __DIR__ . '../../CONNECT/database.php';
/** Gèrer l'authentification des membres.
 * AUTH
 */
class AUTH
{

    private $membre;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        require_once 'membre.class.php';
        $this->membre = new MEMBRE();
    }

    /**
     * is_connected permet de vérifier si le membre est connecté
     *
     * @return bool true : est connecté | false : n'est pas connecté
     */
    public function is_connected(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return !empty($_SESSION['logged']);
    }
    
    /**
     * is_admin permet de verifier si le membre est administrateur
     *
     * @return bool true : est administrateur | false : n'est pas administrateur
     */
    public function is_admin(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($this->is_connected()) {
            $result = $this->membre->get_1Membre($this->get_connected_id());
            if ($result) {
                if ($result->idStat == 9) return true;
            }
        }
        return false;
    }

    /**
     * get_connected_id permet de récupérer l'id du membre connecté
     *
     * @return void
     */
    public function get_connected_id()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['logged'];
    }
    
    /**
     * login permet de connecter un membre
     *
     * @param  string $pseudoMemb
     * @param  string $password
     * @return bool true : la connexion a réussi | false : la connexion a échouée
     */
    public function login(string $pseudoMemb, string $password): bool //fonction qui retourne une valeur vraie ou fausse.
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $result = $this->membre->get_AllMembresByPseudo($pseudoMemb); // Récupérer la valeur du numéro de membre et du mot de passe qui correspondent au pseudo. 
        if ($result) { //si un utilisateur correspond bien au pseudo dans la base de donnée
            if (password_verify($password, $result[0]->passMemb)) { //si le mot de passe est le bon.
                $_SESSION['logged'] = $result[0]->numMemb;
                return true;
            }
            else { //si le mot passe est le mauvais
                echo "Mauvais mot de passe.";
            }
        }
        return false;
    }
    
    /**
     * logout permet la deconnexion du membre
     *
     * @return void
     */
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['logged']);
    }
}
