<?php
// CRUD MOT CLE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class MEMBRE
{
	function get_1Membre($numMemb)
	{
		global $db;
		$query = 'SELECT * FROM MEMBRE WHERE numMemb = :numMemb;';
		$result = $db->prepare($query);
		$result->bindParam(':numMemb', $numMemb);
		$result->execute();
		return ($result->fetch());
	}

	// function get_1MotCleByLangue($numMemb)
	// {
	// 	global $db;
	// 	$query = 'SELECT * FROM MOTCLE MO INNER JOIN LANGUE LA ON MO.numLang = LA.numLang WHERE numMotCle = ?;';
	// 	$result = $db->prepare($query);
	// 	$result->execute([$numMemb]);
	// 	return ($result->fetch());
	// }

    function get_AllMembre()
    {
        global $db;
        $query = 'SELECT * FROM MEMBRE;';
        $result = $db->query($query);
        $allStatuts = $result->fetchAll();
        return ($allStatuts);
    }

	// function get_AllMotCleByLangue()
	// {
	// 	global $db;
	// 	$query = 'SELECT * FROM MOTCLE INNER JOIN LANGUE ON numLang.id = numLang.id;';
	// 	$result = $db->query($query);
	// 	$allStatuts = $result->fetchAll();
	// 	return ($allStatuts);
	// }

	function create($libMotCle, $numLang)
	{
		global $db;
		try {
			$db->beginTransaction();
			$exec = "INSERT INTO MOTCLE (libMotCle, numLang) VALUES (:libMotCle, :numLang)";
			$result = $db->prepare($exec);
			$result->bindParam(':libMotCle', $libMotCle);
			$result->bindParam(':numLang', $numLang);
			$result->execute();
			$db->commit();
			$result->closeCursor();
		} catch (PDOException $erreur) {
			die('Erreur insert MOTCLE : ' . $erreur->getMessage());
			$db->rollBack();
			$result->closeCursor();
		}
	}

	function update(string $numMotCle, string $libMotCle, string $numLang)
	{
		global $db;
		try {
			$db->beginTransaction();
			$exec = "UPDATE MOTCLE SET libMotCle=:libMotCle, numLang=:numLang WHERE :numMotCle= numMotCle;";
            $result = $db->prepare($exec);
            $result->bindParam(':numMotCle', $numMotCle);
			$result->bindParam(':libMotCle', $libMotCle);
			$result->bindParam(':numLang', $numLang);
			$result->execute();
			$db->commit();
			$result->closeCursor();
		} catch (PDOException $erreur) {
			die($erreur);
			die('Erreur update MOTCLE : ' . $erreur->getMessage());
			$db->rollBack();
			$result->closeCursor();
		}
	}

// Ctrl FK sur THEMATIQUE, ANGLE, MOTCLE avec del
 	function delete($numMotCle)
 	{
 		global $db;
 		try {
 			$db->beginTransaction();
 			$query = "DELETE FROM MOTCLE WHERE numMotCle = :numMotCle;";
 			$request = $db->prepare($query);
 			$request->bindParam(':numMotCle', $numMotCle);
 			$request->execute();
 			$db->commit();
 			$request->closeCursor();
 		} catch (PDOException $erreur) {
 			die('Erreur delete MOTCLE : ' . $erreur->getMessage());
 			$db->rollBack();
 			$request->closeCursor();
 		}
 	}
}	// End of class