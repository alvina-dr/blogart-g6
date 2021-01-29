<?
	// CRUD LANGUE (ETUD)

	require_once __DIR__ . '../../CONNECT/database.php';

	class LANGUE{
		function get_1Langue($numLang){
			global $db;
			$query = 'SELECT * FROM STATUT WHERE numLang = :numLang;';
			$result->bindParam(':numLang', $numLang);
			$result = $db->prepare($query);
			$result->execute([$numLang]);
			return($result->fetch());

		}

		function get_1LangueByPays($numLang){
            global $db;
            $query = 'SELECT * FROM LANGUE LA INNER JOIN PAYS PA ON LA.numPays = PA.numPays WHERE numLang = ?;';
            $result = $db->prepare($query);
            $result->execute([$numLang]);
            return($result->fetch());
        }

		function get_AllLangues(){
			global $db;
			$query = 'SELECT * FROM LANGUE;';
			$result = $db->query($query);
			$allStatuts = $result->fetchAll();
			return($allStatuts);

		}

		function get_AllLanguesByPays(){
			global $db;
			$query = 'SELECT * FROM LANGUE INNER JOIN PAYS ON numPays.id = numPays.id;';
			$result = $db->query($query);
			$allStatuts = $result->fetchAll();
			return($allStatuts);

		}

		function create($numLang, $lib1Lang, $lib2Lang, $numPays){
			global $db;
			try {
		//   $db = new PDO ('mysql:host=localhost;dbname=blogart21;charset=utf8mb4','root','');
		  $db->beginTransaction();
		  $exec= "INSERT INTO LANGUE (numLang, lib1Lang, lib2Lang, numPays) VALUES (:numLang, :lib1Lang, :lib2Lang, :numPays)";
		  $result = $db->prepare($exec);
		  $result->bindParam(':numLang', $numLang);
		  $result->bindParam(':lib1Lang', $lib1Lang);
		  $result->bindParam(':lib2Lang', $lib2Lang);
		  $result->bindParam(':numPays', $numPays);
		  $result->execute();
					$db->commit();
					$result->closeCursor();
			}
			catch (PDOException $erreur) {
					die('Erreur insert LANGUE : ' . $erreur->getMessage());
					$db->rollBack();
					$request->closeCursor();
			}
		}

		function update($numLang, $lib1Lang, $lib2Lang, $numPays){

			try {
          $db->beginTransaction();



					$db->commit();
					$request->closeCursor();
			}
			catch (PDOException $e) {
					die('Erreur update LANGUE : ' . $e->getMessage());
					$db->rollBack();
					$request->closeCursor();
			}
		}

		// Ctrl FK sur THEMATIQUE, ANGLE, MOTCLE avec del
		function delete($numLang){

			try {
          $db->beginTransaction();



					$db->commit();
					$request->closeCursor();

			}
			catch (PDOException $e) {
					die('Erreur delete LANGUE : ' . $e->getMessage());
					$db->rollBack();
					$request->closeCursor();
			}
		}
	}	// End of class
