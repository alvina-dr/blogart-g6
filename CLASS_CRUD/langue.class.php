<?php
// CRUD LANGUE (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class LANGUE
{
	function get_1Langue($numLang)
	{
		global $db;
		$query = 'SELECT * FROM LANGUE WHERE numLang = :numLang;';
		$result = $db->prepare($query);
		$result->bindParam(':numLang', $numLang);
		$result->execute();
		return ($result->fetch());
	}

	function get_1LangueByPays($numLang)
	{
		global $db;
		$query = 'SELECT * FROM LANGUE LA INNER JOIN PAYS PA ON LA.numPays = PA.numPays WHERE numLang = ?;';
		$result = $db->prepare($query);
		$result->execute([$numLang]);
		return ($result->fetch());
	}

	function get_AllLangues()
	{
		global $db;
		$query = 'SELECT * FROM LANGUE INNER JOIN PAYS;';
		$result = $db->query($query);
		$allStatuts = $result->fetchAll();
		return ($allStatuts);
	}

	function get_AllLanguesByPays()
	{
		global $db;
		$query = 'SELECT * FROM LANGUE INNER JOIN PAYS ON numPays.id = numPays.id;';
		$result = $db->query($query);
		$allStatuts = $result->fetchAll();
		return ($allStatuts);
	}

	function create($numLang, $lib1Lang, $lib2Lang, $numPays)
	{
		global $db;
		try {
			//   $db = new PDO ('mysql:host=localhost;dbname=blogart21;charset=utf8mb4','root','');
			$db->beginTransaction();
			$exec = "INSERT INTO LANGUE (numLang, lib1Lang, lib2Lang, numPays) VALUES (:numLang, :lib1Lang, :lib2Lang, :numPays)";
			$result = $db->prepare($exec);
			$result->bindParam(':numLang', $numLang);
			$result->bindParam(':lib1Lang', $lib1Lang);
			$result->bindParam(':lib2Lang', $lib2Lang);
			$result->bindParam(':numPays', $numPays);
			$result->execute();
			$db->commit();
			$result->closeCursor();
		} catch (PDOException $erreur) {
			die('Erreur insert LANGUE : ' . $erreur->getMessage());
			$db->rollBack();
			$result->closeCursor();
		}
	}

	function update(string $numLang, string $lib1Lang, string $lib2Lang, string $numPays)
	{
		global $db;
		try {
			$db->beginTransaction();
			$exec = "UPDATE langue SET lib1Lang=:lib1Lang, lib2Lang=:lib2Lang, numPays=:numPays WHERE numLang=:numLang";
			$result = $db->prepare($exec);
			$result->bindParam(':numLang', $numLang);
			$result->bindParam(':lib1Lang', $lib1Lang);
			$result->bindParam(':lib2Lang', $lib2Lang);
			$result->bindParam(':numPays', $numPays);
			$result->execute();
			$db->commit();
			$result->closeCursor();
		} catch (PDOException $erreur) {
			die($erreur);
			//die('Erreur update LANGUE : ' . $erreur->getMessage());
			$db->rollBack();
			$result->closeCursor();
		}
	}

	// Ctrl FK sur THEMATIQUE, ANGLE, MOTCLE avec del
	function delete($numLang)
	{
		global $db;
		try {
			$db->beginTransaction();
			$query = "DELETE FROM LANGUE WHERE numLang = :numLang;";
			$request = $db->prepare($query);
			$request->bindParam(':numLang', $numLang);
			$request->execute();
			$db->commit();
			$request->closeCursor();
		} catch (PDOException $erreur) {
			die('Erreur delete LANGUE : ' . $erreur->getMessage());
			$db->rollBack();
			$request->closeCursor();
		}
	}
}	// End of class