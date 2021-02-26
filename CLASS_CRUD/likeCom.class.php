<?php
// CRUD ANGLE (ETUD)

require_once __DIR__ . '/../CONNECT/database.php';

class LIKECOM
{
	function get_1LikeCom($numMemb)
	{
		global $db;
		$query = 'SELECT * FROM LIKECOM WHERE numMemb = :numMemb;';
		$result = $db->prepare($query);
		$result->bindParam(':numMemb', $numMemb);
		$result->execute();
		return ($result->fetch());
	}

    function get_AllLikeCom()
    {
        global $db;
        $query = 'SELECT * FROM LIKECOM;';
        $result = $db->query($query);
        $allStatuts = $result->fetchAll();
        return ($allStatuts);
    }


	function create($numMemb, $numSeqCom, $numArt, $likeC)
	{
		global $db;
		try {
			//   $db = new PDO ('mysql:host=localhost;dbname=blogart21;charset=utf8mb4','root','');
			$db->beginTransaction();
			$exec = "INSERT INTO LIKECOM (numMemb, numSeqCom, numArt, likeC) VALUES (:numMemb, :numSeqCom, :numArt, :likeC)";
			$result = $db->prepare($exec);
			$result->bindParam(':numMemb', $numMemb);
			$result->bindParam(':numSeqCom', $numSeqCom);
			$result->bindParam(':numArt', $numArt);
            $result->bindParam(':likeC', $likeC);
			$result->execute();
			$db->commit();
			$result->closeCursor();
		} catch (PDOException $erreur) {
			die('Erreur insert LIKECOM : ' . $erreur->getMessage());
			$db->rollBack();
			$result->closeCursor();
		}
	}
	
	function update(string $numAngl, string $libAngl, string $numLang)
	{
		global $db;
		try {
			$db->beginTransaction();
			$exec = "UPDATE ANGLE SET numSeqCom=:numSeqCom, numArt=:numArt, likeC=:likeC WHERE :numMemb= numMemb;";
            $result = $db->prepare($exec);
            $result->bindParam(':numMemb', $numMemb);
			$result->bindParam(':numSeqCom', $numSeqCom);
			$result->bindParam(':numArt', $numArt);
			$result->bindParam(':likeC', $likeC);
			$result->execute();
			$db->commit();
			$result->closeCursor();
		} catch (PDOException $erreur) {
			die($erreur);
			die('Erreur update ANGLE : ' . $erreur->getMessage());
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
}	// End of class
