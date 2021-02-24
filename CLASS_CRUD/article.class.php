<?php
// CRUD ANGLE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class ARTICLE
{
	function get_1Art($numArt)
	{
		global $db;
		$query = 'SELECT * FROM ARTICLE WHERE numArt = :numAngl;';
		$result = $db->prepare($query);
		$result->bindParam(':numArt', $numAngl);
		$result->execute();
		return ($result->fetch());
	}

    function get_AllArt()
    {
        global $db;
        $query = 'SELECT * FROM ARTICLE;';
        $result = $db->query($query);
        $allStatuts = $result->fetchAll();
        return ($allStatuts);
    }

	function create($libTitrArt, $libChapoArt, $libAccrochArt, $parag1Art, $libSsTitr1Art, $parag2Art, $libSsTitr2Art, $parag3Art, $numAngl, $numThem)
	{
		global $db;
		try {
			$db->beginTransaction();
			$exec = "INSERT INTO ARTICLE ( libTitrArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, numAngl, numThem) VALUES (:libTitrArt, :libChapoArt, :libAccrochArt, :parag1Art, :libSsTitr1Art, :parag2Art, :libSsTitr2Art, :parag3Art, :numAngl, :numThem)";
			$result = $db->prepare($exec);
			$result->bindParam(':libTitrArt', $libTitrArt);
			$result->bindParam(':libChapoArt', $libChapoArt);
			$result->bindParam(':libAccrochArt', $libAccrochArt);
			$result->bindParam(':parag1Art', $parag1Art);
			$result->bindParam(':libSsTitr1Art', $libSsTitr1Art);
			$result->bindParam(':parag2Art', $parag2Art);
			$result->bindParam(':libSsTitr2Art', $libSsTitr2Art);
			$result->bindParam(':parag3Art', $parag3Art);
			// $result->bindParam(':urlPhotArt', $urlPhotArt);
			$result->bindParam(':numAngl', $numAngl);
			$result->bindParam(':numThem', $numThem);
			$result->execute();
			$db->commit();
			$result->closeCursor();
		} catch (PDOException $erreur) {
			die('Erreur insert ARTICLE : ' . $erreur->getMessage());
			$db->rollBack();
			$result->closeCursor();
		}
	}

	function update(string $numAngl, string $libAngl, string $numLang)
    {
        global $db;
        try {
            $db->beginTransaction();
            $exec = "UPDATE ARTICLE SET libTitrArt=:libTitrArt, libChapoArt=:libChapoArt, libAccrochArt=:libAccrochArt, parag1art=:parag1art, libSsTitr1art=:libSsTitr1art, parag2Art=:parag2Art, LibSsTitr2Art=:LibSsTitr2Art, parag3Art=:parag3Art, libConclArt=:libConclArt, numAngl=:numAngl, numThem=:numThem WHERE :numArt= numArt;";
            $result = $db->prepare($exec);
            $result->bindParam(':libTitrArt', $libTitrArt);
            $result->bindParam(':libChapoArt', $libChapoArt);
            $result->bindParam(':libAccrochArt', $libAccrochArt);
            $result->bindParam(':parag1Art', $parag1Art);
            $result->bindParam(':libSsTitr1Art', $libSsTitr1Art);
            $result->bindParam(':parag2Art', $parag2Art);
            $result->bindParam(':LibSsTitr2Art', $libSsTitr2Art);
            $result->bindParam(':parag3Art', $parag3Art);
            $result->bindParam(':libConclArt', $libConclArt);
            $result->bindParam(':numAngl', $numAngl);
            $result->bindParam(':numThem', $numThem);
            $result->execute();
            $db->commit();
            $result->closeCursor();
        } catch (PDOException $erreur) {
            die($erreur);
            die('Erreur update ARTICLE : ' . $erreur->getMessage());
            $db->rollBack();
            $result->closeCursor();
        }
    }

// Ctrl FK sur THEMATIQUE, ARTICLE, MOTCLE avec del
 	function delete($numAngl)
 	{
 		global $db;
 		try {
 			$db->beginTransaction();
 			$query = "DELETE FROM ARTICLE WHERE numAngl = :numAngl;";
 			$request = $db->prepare($query);
 			$request->bindParam(':numAngl', $numAngl);
 			$request->execute();
 			$db->commit();
 			$request->closeCursor();
 		} catch (PDOException $erreur) {
 			die('Erreur delete ARTICLE : ' . $erreur->getMessage());
 			$db->rollBack();
 			$request->closeCursor();
 		}
 	}
}// End of class