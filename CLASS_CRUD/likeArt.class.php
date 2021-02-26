<?php
// CRUD LIKEART (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class LIKEART
{
	function get_1LikeArt($numMemb)
	{
		global $db;
		$query = 'SELECT * FROM LIKEART WHERE numMemb = :numMemb;';
		$result = $db->prepare($query);
		$result->bindParam(':numMemb', $numMemb);
		$result->execute();
		return ($result->fetch());
	}

    function get_AllLikeArt()
    {
        global $db;
        $query = 'SELECT * FROM LIKEART;';
        $result = $db->query($query);
        $allStatuts = $result->fetchAll();
        return ($allStatuts);
    }


	function create($numMemb, $numArt, $likeA)
	{
		global $db;
		try {
			//   $db = new PDO ('mysql:host=localhost;dbname=blogart21;charset=utf8mb4','root','');
			$db->beginTransaction();
			$exec = "INSERT INTO LIKEART (numMemb, numArt, likeA) VALUES (:numMemb, :numArt, :likeA)";
			$result = $db->prepare($exec);
			$result->bindParam(':numMemb', $numMemb);
			$result->bindParam(':numArt', $numArt);
			$result->bindParam(':likeA', $likeA);
			$result->execute();
			$db->commit();
			$result->closeCursor();
		} catch (PDOException $erreur) {
			die('Erreur insert LIKEART : ' . $erreur->getMessage());
			$db->rollBack();
			$result->closeCursor();
		}
	}

	function update(string $numAngl, string $libAngl, string $numLang)
	{
		global $db;
		try {
			$db->beginTransaction();
			$exec = "UPDATE ANGLE SET numArt=:numArt, likeA=:likeA WHERE :numMemb= numMemb;";
            $result = $db->prepare($exec);
			$result->bindParam(':numArt', $numArt);
			$result->bindParam(':likeA', $likeA);
			$result->bindParam(':numMemb', $numMemb);
			$result->execute();
			$db->commit();
			$result->closeCursor();
		} catch (PDOException $erreur) {
			die($erreur);
			die('Erreur update LIKEART : ' . $erreur->getMessage());
			$db->rollBack();
			$result->closeCursor();
		}
	}
}
    
	
{
// Ctrl FK sur THEMATIQUE, ANGLE, MOTCLE avec del
 	function delete($numAngl)
 	{
 		global $db;
 		try {
 			$db->beginTransaction();
 			$query = "DELETE FROM ANGLE WHERE numAngl = :numAngl;";
 			$request = $db->prepare($query);
 			$request->bindParam(':numAngl', $numAngl);
 			$request->execute();
 			$db->commit();
 			$request->closeCursor();
 		} catch (PDOException $erreur) {
 			die('Erreur delete ANGLE : ' . $erreur->getMessage());
 			$db->rollBack();
 			$request->closeCursor();
 		}
 	}
}
