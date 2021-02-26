<?php
// CRUD ANGLE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class ARTICLE{
	function get_1Art($numArt){
		global $db;
		$query = 'SELECT * FROM ARTICLE WHERE numArt = :numArt;';
		$result = $db->prepare($query);
		$result->bindParam(':numArt', $numArt);
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
	function get_SomeArt()
    {
        global $db;
		$query = 'SELECT * FROM ARTICLE WHERE numArt = ?;';
        $result = $db->query($query);
        $allStatuts = $result->fetchAll();
        return ($allStatuts);
    }

	// function create($libTitrArt, $libChapoArt, $libAccrochArt, $parag1Art, $libSsTitr1Art, $parag2Art, $libSsTitr2Art, $parag3Art, $numAngl, $numThem)
	// {
	// 	global $db;
	// 	try {
	// 		$db->beginTransaction();
	// 		$exec = "INSERT INTO ARTICLE (libTitrArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, numAngl, numThem) VALUES (:libTitrArt, :libChapoArt, :libAccrochArt, :parag1Art, :libSsTitr1Art, :parag2Art, :libSsTitr2Art, :parag3Art, :numAngl, :numThem)";
	// 		$result = $db->prepare($exec);
	// 		$result->bindParam(':libTitrArt', $libTitrArt);
	// 		$result->bindParam(':libChapoArt', $libChapoArt);
	// 		$result->bindParam(':libAccrochArt', $libAccrochArt);
	// 		$result->bindParam(':parag1Art', $parag1Art);
	// 		$result->bindParam(':libSsTitr1Art', $libSsTitr1Art);
	// 		$result->bindParam(':parag2Art', $parag2Art);
	// 		$result->bindParam(':libSsTitr2Art', $libSsTitr2Art);
	// 		$result->bindParam(':parag3Art', $parag3Art);
	// 		// $result->bindParam(':urlPhotArt', $urlPhotArt);
	// 		$result->bindParam(':numAngl', $numAngl);
	// 		$result->bindParam(':numThem', $numThem);
	// 		$result->execute();
	// 		$db->commit();
	// 		$result->closeCursor();
	// 	} catch (PDOException $erreur) {
	// 		die('Erreur insert ARTICLE : ' . $erreur->getMessage());
	// 		$db->rollBack();
	// 		$result->closeCursor();
	// 	}
	// }
	/**
	 * create Permet d'ajouter un nouvel article en base de donnée
	 *
	 * @param  string $dtCreArt
	 * @param  string $libTitrArt
	 * @param  string $libChapoArt
	 * @param  string $libAccrochArt
	 * @param  string $parag1Art
	 * @param  string $libSsTitr1Art
	 * @param  string $parag2Art
	 * @param  string $libSsTitr2Art
	 * @param  string $parag3Art
	 * @param  string $libConclArt
	 * @param  string $urlPhotArt
	 * @param  string $numAngl
	 * @param  string $numThem
	 * @return void
	 */
	function create(
		string $libTitrArt,
		string $libChapoArt,
		string $libAccrochArt,
		string $parag1Art,
		string $libSsTitr1Art,
		string $parag2Art,
		string $libSsTitr2Art,
		string $parag3Art,
		string $libConclArt,
		string $urlPhotArt,
		string $numAngl,
		string $numThem
	) {
		global $db;
		require_once __DIR__ . '/getNextNumAngl.php';
		//$numAngl = getNextNumAngl($numLang);
		try {
			$db->beginTransaction();
			$query = $db->prepare(
				'INSERT INTO article ( libTitrArt, libChapoArt, libAccrochArt, parag1Art, 
				libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt, urlPhotArt, numAngl, numThem)
				VALUES (:libTitrArt, :libChapoArt, :libAccrochArt, :parag1Art, :libSsTitr1Art, 
				:parag2Art, :libSsTitr2Art, :parag3Art, :libConclArt, :urlPhotArt, :numAngl, :numThem)'
			);
			$query->execute([
				'libTitrArt' => $libTitrArt,
				'libChapoArt' => $libChapoArt,
				'libAccrochArt' => $libAccrochArt,
				'parag1Art' => $parag1Art,
				'libSsTitr1Art' => $libSsTitr1Art,
				'parag2Art' => $parag2Art,
				'libSsTitr2Art' => $libSsTitr2Art,
				'parag3Art' => $parag3Art,
				'libConclArt' => $libConclArt,
				'urlPhotArt' => $urlPhotArt,
				'numAngl' => $numAngl,
				'numThem' => $numThem
			]);
			$db->commit();
			$query->closeCursor();
		} catch (PDOException $e) {
			$db->rollBack();
			$query->closeCursor();
			die('Erreur insert ARTICLE : ' . $e->getMessage());
		}
	}

	function update($numArt, $libTitrArt, $libChapoArt, $libAccrochArt, $parag1Art, $libSsTitr1Art, $parag2Art, $LibSsTitr2Art, $parag3Art, $libConclArt, $numAngl, $numThem)
    {
        global $db;
        try {
            $db->beginTransaction();
            $exec = "UPDATE ARTICLE SET libTitrArt=:libTitrArt, libChapoArt=:libChapoArt, libAccrochArt=:libAccrochArt, parag1Art=:parag1Art, libSsTitr1Art=:libSsTitr1Art, parag2Art=:parag2Art, LibSsTitr2Art=:LibSsTitr2Art, parag3Art=:parag3Art, libConclArt=:libConclArt, numAngl=:numAngl, numThem=:numThem WHERE numArt= :numArt;";
            $result = $db->prepare($exec);
			$result->bindParam(':numArt', $numArt);
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