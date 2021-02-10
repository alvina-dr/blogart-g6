<?php
// CRUD ANGLE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class ANGLE
{
	function get_1Angle($numAngl)
	{
		global $db;
		$query = 'SELECT * FROM ANGLE WHERE numAngl = :numAngl;';
		$result = $db->prepare($query);
		$result->bindParam(':numAngl', $numAngl);
		$result->execute();
		return ($result->fetch());
	}

	function get_1AngleByLangue($numAngl)
	{
		global $db;
		$query = 'SELECT * FROM ANGLE AN INNER JOIN LANGUE LA ON AN.numLang = LA.numLang WHERE numAngl = ?;';
		$result = $db->prepare($query);
		$result->execute([$numAngl]);
		return ($result->fetch());
	}

    function get_AllAngle()
    {
        global $db;
        $query = 'SELECT * FROM ANGLE;';
        $result = $db->query($query);
        $allStatuts = $result->fetchAll();
        return ($allStatuts);
    }

	function get_AllAnglesByLangue()
	{
		global $db;
		$query = 'SELECT * FROM ANGLE INNER JOIN LANGUE ON numLang.id = numLang.id;';
		$result = $db->query($query);
		$allStatuts = $result->fetchAll();
		return ($allStatuts);
	}

	function create($numAngl, $libAngl, $numLang)
	{
		global $db;
		try {
			//   $db = new PDO ('mysql:host=localhost;dbname=blogart21;charset=utf8mb4','root','');
			$db->beginTransaction();
			$exec = "INSERT INTO ANGLE (numAngl, libAngl, numLang) VALUES (:numAngl, :libAngl, :numLang)";
			$result = $db->prepare($exec);
			$result->bindParam(':numAngl', $numAngl);
			$result->bindParam(':libAngl', $libAngl);
			$result->bindParam(':numLang', $numLang);
			$result->execute();
			$db->commit();
			$result->closeCursor();
		} catch (PDOException $erreur) {
			die('Erreur insert ANGLE : ' . $erreur->getMessage());
			$db->rollBack();
			$result->closeCursor();
		}
	}

	function update(string $numAngl, string $libAngl, string $numLang)
	{
		global $db;
		try {
			$db->beginTransaction();
			$exec = "UPDATE ANGLE SET libAngl=:libAngl, numLang=:numLang WHERE :numAngl= ?;";
            $result = $db->prepare($exec);
            $result->bindParam(':numAngl', $numAngl);
			$result->bindParam(':libAngl', $libAngl);
			$result->bindParam(':numLang', $numLang);
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

// 	// Ctrl FK sur THEMATIQUE, ANGLE, MOTCLE avec del
// 	function delete($numLang)
// 	{
// 		global $db;
// 		try {
// 			$db->beginTransaction();
// 			$query = "DELETE FROM LANGUE WHERE numLang = :numLang;";
// 			$request = $db->prepare($query);
// 			$request->bindParam(':numLang', $numLang);
// 			$request->execute();
// 			$db->commit();
// 			$request->closeCursor();
// 		} catch (PDOException $erreur) {
// 			die('Erreur delete LANGUE : ' . $erreur->getMessage());
// 			$db->rollBack();
// 			$request->closeCursor();
// 		}
// 	}
}	// End of class