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

	function create($numArt, $libAngl, $numLang)
	{
		global $db;
		try {
			//   $db = new PDO ('mysql:host=localhost;dbname=blogart21;charset=utf8mb4','root','');
			$db->beginTransaction();
			$exec = "INSERT INTO ARTICLE (numArt, libAngl, numLang) VALUES (:numArt, :libAngl, :numLang)";
			$result = $db->prepare($exec);
			$result->bindParam(':numArt', $numArt);
			$result->bindParam(':libAngl', $libAngl);
			$result->bindParam(':numLang', $numLang);
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
			$exec = "UPDATE ARTICLE SET libAngl=:libAngl, numLang=:numLang WHERE :numAngl= numAngl;";
            $result = $db->prepare($exec);
            $result->bindParam(':numAngl', $numAngl);
			$result->bindParam(':libAngl', $libAngl);
			$result->bindParam(':numLang', $numLang);
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
}	// End of class