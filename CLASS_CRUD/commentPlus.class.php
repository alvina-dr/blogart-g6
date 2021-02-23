<?php
// CRUD COMMENT (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class COMMENTPLUS
{
	function get_1ComPlus($numSeqCom)
	{
		global $db;
		$query = 'SELECT * FROM COMMENTPLUS WHERE numSeqCom = :numSeqCom;';
		$result = $db->prepare($query);
		$result->bindParam(':numSeqCom', $numSeqCom);
		$result->execute();
		return ($result->fetch());
	}

    function get_AllComPlus()
    {
        global $db;
        $query = 'SELECT * FROM COMMENTPLUS';
        $result = $db->query($query);
        $allStatuts = $result->fetchAll();
        return ($allStatuts);
    }
}

	function create($numSeqCom, $numArt, $numSeqComR, $numArtR){
	
 		global $db;
 		try {
 			//   $db = new PDO ('mysql:host=localhost;dbname=blogart21;charset=utf8mb4','root','');
 			$db->beginTransaction();
 			$exec = "INSERT INTO COMMENTPLUS (numArt, numSeqCom, numArtR, numSeqComR) VALUES (:numArt, :numSeqCom, :numArtR, :numSeqComR)";
 			$result = $db->prepare($exec);
 			$result->bindParam(':numSeqCom', $numSeqCom);
			$result->bindParam(':numArtR', $numArtR);
 			$result->bindParam(':numSeqComR', $numSeqComR);
 			$result->execute();
 			$db->commit();
 			$result->closeCursor();
 		} catch (PDOException $erreur) {
 			die('Erreur insert COMMENTPLUS : ' . $erreur->getMessage());
			$db->rollBack();
 			$result->closeCursor();
 		}
	}

// 	function update(string $numAngl, string $libAngl, string $numLang)
// 	{
// 		global $db;
// 		try {
// 			$db->beginTransaction();
// 			$exec = "UPDATE ANGLE SET libAngl=:libAngl, numLang=:numLang WHERE :numAngl= numAngl;";
//             $result = $db->prepare($exec);
//             $result->bindParam(':numAngl', $numAngl);
// 			$result->bindParam(':libAngl', $libAngl);
// 			$result->bindParam(':numLang', $numLang);
// 			$result->execute();
// 			$db->commit();
// 			$result->closeCursor();
// 		} catch (PDOException $erreur) {
// 			die($erreur);
// 			die('Erreur update ANGLE : ' . $erreur->getMessage());
// 			$db->rollBack();
// 			$result->closeCursor();
// 		}
// 	}

// // Ctrl FK sur THEMATIQUE, ANGLE, MOTCLE avec del
//  	function delete($numAngl)
//  	{
//  		global $db;
//  		try {
//  			$db->beginTransaction();
//  			$query = "DELETE FROM ANGLE WHERE numAngl = :numAngl;";
//  			$request = $db->prepare($query);
//  			$request->bindParam(':numAngl', $numAngl);
//  			$request->execute();
//  			$db->commit();
//  			$request->closeCursor();
//  		} catch (PDOException $erreur) {
//  			die('Erreur delete ANGLE : ' . $erreur->getMessage());
//  			$db->rollBack();
//  			$request->closeCursor();
//  		}
//  	}
// }	
// End of class