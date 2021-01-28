<?
	// CRUD STATUT (ETUD)

	require_once __DIR__ . '../../CONNECT/database.php';

	class STATUT{
		function get_1Statut($idStat){
			global $db;

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
				$db = new PDO('mysql:host=localhost;dbname=BLOGART21', 'root', '');
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

      try {
          $db->beginTransaction();



					$db->commit();
					$request->closeCursor();
			}
			catch (PDOException $e) {
					die('Erreur update STATUT : ' . $e->getMessage());
					$db->rollBack();
					$request->closeCursor();
			}
		}

		function delete($idStat){

      try {
          $db->beginTransaction();



					$db->commit();
					$request->closeCursor();

			}
			catch (PDOException $e) {
					die('Erreur delete STATUT : ' . $e->getMessage());
					$db->rollBack();
					$request->closeCursor();
			}
		}

	}	// End of class
