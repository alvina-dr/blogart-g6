<?php
// CRUD THEMATIQUE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class THEMATIQUE
{
	function get_1Theme($numThem)
	{
		global $db;
		$query = 'SELECT * FROM THEMATIQUE WHERE numThem= :numThem;';
		$result = $db->prepare($query);
		$result->bindParam(':numThem', $numThem);
		$result->execute();
		return ($result->fetch());
	}
    function get_AllTheme()
    {
        global $db;
        $query = 'SELECT * FROM THEMATIQUE;';
        $result = $db->query($query);
        $allStatuts = $result->fetchAll();
        return ($allStatuts);
    }

	function create($numThem, $libThem, $numLang)
	{
		global $db;
		try {
			//   $db = new PDO ('mysql:host=localhost;dbname=blogart21;charset=utf8mb4','root','');
			$db->beginTransaction();
			$exec = "INSERT INTO THEMATIQUE (numThem, libThem, numLang) VALUES (:numThem, :libThem, :numLang)";
			$result = $db->prepare($exec);
			$result->bindParam(':numThem', $numThem);
			$result->bindParam(':libThem', $libThem);
			$result->bindParam(':numLang', $numLang);
			$result->execute();
			$db->commit();
			$result->closeCursor();
		} catch (PDOException $erreur) {
			die('Erreur insert THEMATIQUE : ' . $erreur->getMessage());
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
// }	// End of class