<?
	// CRUD USER (ETUD)

	require_once __DIR__ . '../../CONNECT/database.php';

	class THEMATIQUE{
		
		function get_NbAllThematiqueByidLangue($id){
            global $db;
            $query = 'SELECT * FROM THEMATIQUE INNER JOIN LANGUE ON thematique.numLang = langue.numLang WHERE thematique.numLang = ?;';
            $result = $db->prepare($query);
            $result->execute([$id]);
            $allNbThematiqueById = $result->fetchAll();
			$allNbThematiqueByLangue = 0;
			foreach ($allNbThematiqueById as $row){
				$allNbThematiqueByLangue = $allNbThematiqueByLangue + 1;
			}
            return($allNbThematiqueByLangue);
        }
		
		function get_1ThemByLangue($id){
            global $db;
            $query = 'SELECT * FROM THEMATIQUE INNER JOIN LANGUE ON thematique.numLang = langue.numLang WHERE numThem = ?;';
            $result = $db->prepare($query);
            $result->execute([$id]);
            return($result->fetch());
		
        }

		function get_AllThem(){
            global $db;
            $query = 'SELECT numThem,libThem,lib2Lang FROM THEMATIQUE,langue WHERE thematique.numLang=langue.numLang ORDER BY numThem ASC ;';
            $result = $db->prepare($query);
            $result->execute();
            return($result->fetchAll());
			
        }
		function create($numThem, $libThem, $numLang){ 
            global $db;
            try {
				$db->beginTransaction();
                $query = 'INSERT INTO THEMATIQUE (numThem, libThem, numLang) VALUES (?, ?, ?);';
                $result = $db->prepare($query);
                $result->execute([$numThem, $libThem, $numLang]);
				$db->commit();
				$result->closeCursor();
	
				}
				catch (PDOException $e) {
						die('Erreur insert  THEMATIQUE : ' . $e->getMessage());
						$db->rollBack();
						$result->closeCursor();
				}
				
        }
		function update($numThem, $libThem, $numLang){ 
            global $db;
            try {
				$db->beginTransaction();
                $query = 'UPDATE THEMATIQUE SET libThem = ?, numLang = ? WHERE numThem = ?;';
                $result = $db->prepare($query);
                $result->execute([$libThem, $numLang, $numThem]);
				$db->commit();
				$result->closeCursor();
	
				}
				catch (PDOException $e) {
						die('Erreur insert Angle : ' . $e->getMessage());
						$db->rollBack();
						$result->closeCursor();
				}
				
        }

		function delete($numThem){ 
            global $db;
            try {
				$db->beginTransaction();
                $query = 'DELETE FROM THEMATIQUE WHERE numThem = ?;';
                $result = $db->prepare($query);
                $result->execute([$numThem]);
				$db->commit();
				$result->closeCursor();
	
				}
				catch (PDOException $e) {
						die('Erreur delete Angle : ' . $e->getMessage());
						$db->rollBack();
						$result->closeCursor();
				}
				
        }


		

	}	// End of class
