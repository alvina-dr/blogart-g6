<?
	// CRUD STATUT (ETUD)

	require_once __DIR__ . '../../CONNECT/database.php';

	class STATUT{
		function get_1Statut($idStat){
			global $db;
			$query = 'SELECT * FROM STATUT WHERE idStat = :idStat;';
			$result = $db->prepare($query);
			$result->bindParam(':idStat', $idStat);
			$result->execute();
			return($result->fetch());

		}

		function get_AllStatuts(){
			global $db;
			$query = 'SELECT * FROM STATUT;';
			$result = $db->query($query);
			$allStatuts = $result->fetchAll();
			return($allStatuts);

		}

		function create($libStat){

			try {
				 $db = new PDO ('mysql:host=localhost;dbname=blogart21;charset=utf8mb4','root','');
		  $db->beginTransaction();
		  $exec= "INSERT INTO STATUT (idStat, libStat) VALUES (:idStat, :libStat)";
		  $result = $db->prepare($exec);
		  $result->bindParam(':idStat', $idStat);
		  $result->bindParam(':libStat', $libStat);
		  $result->execute();
			$db->commit();
			$result->closeCursor();
			}
			catch (PDOException $e) {
					die('Erreur insert STATUT : ' . $e->getMessage());
					$db->rollBack();
					$request->closeCursor();
			}
		}

		function update($idStat, $libStat){
			global $db;
      try {
		  $db->beginTransaction();
			$query='UPDATE STATUT SET libStat = :libStat WHERE idStat = :idStat;';
			$request = $db->prepare($query);
			$request->bindParam(':libStat', $libStat);
			$request->bindParam(':idStat', $idStat);
			$request->execute();
					$db->commit();
					$request->closeCursor();
			}
			catch (PDOException $erreur) {
					die('Erreur update STATUT : ' . $erreur->getMessage());
					$db->rollBack();
					$request->closeCursor();
			}
		}

		function delete($idStat){

      try {
		$db = new PDO ('mysql:host=localhost;dbname=blogart21;charset=utf8mb4','root','');
          $db->beginTransaction();
		  $query="DELETE FROM STATUT WHERE idStat = :idStat;";
		  $request = $db->prepare($query);
		  $request->bindParam(':idStat', $idStat);
		  $request->execute();
					$db->commit();
					$request->closeCursor();

			}
			catch (PDOException $erreur) {
					die('Erreur delete STATUT : ' . $erreur->getMessage());
					$db->rollBack();
					$request->closeCursor();
			}
		}

	}	// End of class
