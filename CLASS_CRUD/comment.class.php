<?php
// CRUD COMMENT (ETUD)

require_once __DIR__ . '../../CONNECT/database.php';

class COMMENT
{
	function get_1Com($numSeqCom)
	{
		global $db;
		$query = 'SELECT * FROM COMMENT WHERE numSeqCom = :numSeqCom;';
		$result = $db->prepare($query);
		$result->bindParam(':numSeqCom', $numSeqCom);
		$result->execute();
		return ($result->fetch());
	}

    function get_AllCom()
    {
        global $db;
        $query = 'SELECT * FROM COMMENT';
        $result = $db->query($query);
        $allStatuts = $result->fetchAll();
        return ($allStatuts);
    }
	function get_SomeCom1() //fonction qui appelle tous les commentaires sans avertissement et étant sur l'article 1
    {
        global $db;
		$query = 'SELECT * FROM COMMENT WHERE affComOk = "1" AND numArt = "1"';
		//$query = 'SELECT * FROM COMMENT WHERE numArt = "1"';

        $result = $db->query($query);
        $allStatuts = $result->fetchAll();
        return ($allStatuts);
    }
	function get_SomeCom2() //fonction qui appelle tous les commentaires sans avertissement et étant sur l'article 1
    {
        global $db;
		$query = 'SELECT * FROM COMMENT WHERE affComOk = "1" AND numArt = "2"';
		//$query = 'SELECT * FROM COMMENT WHERE numArt = "1"';

        $result = $db->query($query);
        $allStatuts = $result->fetchAll();
        return ($allStatuts);
    }
	function get_SomeCom3() //fonction qui appelle tous les commentaires sans avertissement et étant sur l'article 1
    {
        global $db;
		$query = 'SELECT * FROM COMMENT WHERE affComOk = "1" AND numArt = "3"';
		//$query = 'SELECT * FROM COMMENT WHERE numArt = "1"';

        $result = $db->query($query);
        $allStatuts = $result->fetchAll();
        return ($allStatuts);
    }

	function create($numSeqCom, $numArt, $dtCreCom, $libCom, $numMemb){
		global $db;
		try {
			$db->beginTransaction();
			$requete = 'INSERT INTO COMMENT (numSeqCom, numArt, dtCreCom, libCom, numMemb) VALUES (?,?,?,?,?);';
			$result = $db->prepare($requete);
			$result->execute([$numSeqCom, $numArt, $dtCreCom, $libCom, $numMemb]);
			$db->commit();
			$result->closeCursor();
		}
		catch (PDOException $e) {
				die('Erreur ajout COMMENT : ' . $e->getMessage());
				$db->rollBack();
				$result->closeCursor();
		}
	}

	function update(string $numAngl, string $libAngl, string $numLang)
	{
		global $db;
		try {
			$db->beginTransaction();
			$exec = "UPDATE ANGLE SET libAngl=:libAngl, numLang=:numLang WHERE :numAngl= numAngl;";
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

// Ctrl FK sur THEMATIQUE, ANGLE, MOTCLE avec del
 	// function delete($numAngl)
 	// {
 	// 	global $db;
 	// 	try {
 	// 		$db->beginTransaction();
 	// 		$query = "DELETE FROM ANGLE WHERE numAngl = :numAngl;";
 	// 		$request = $db->prepare($query);
 	// 		$request->bindParam(':numAngl', $numAngl);
 	// 		$request->execute();
 	// 		$db->commit();
 	// 		$request->closeCursor();
 	// 	} catch (PDOException $erreur) {
 	// 		die('Erreur delete ANGLE : ' . $erreur->getMessage());
 	// 		$db->rollBack();
 	// 		$request->closeCursor();
 	// 	}
 	// }
}
// End of class