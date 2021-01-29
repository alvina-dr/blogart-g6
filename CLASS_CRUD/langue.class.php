<?
	// CRUD LANGUE (ETUD)

	require_once __DIR__ . '../../CONNECT/database.php';

	class LANGUE{
		function get_1Langue($numLang){
			global $db;

		}

		function get_1LangueByPays($numLang){
			global $db;

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

			try {
          $db->beginTransaction();



					$db->commit();
					$request->closeCursor();
			}
			catch (PDOException $e) {
					die('Erreur insert LANGUE : ' . $e->getMessage());
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
