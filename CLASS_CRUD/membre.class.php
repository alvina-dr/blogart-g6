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
	function get_1Pseudo($pseudoMemb)
	{
		global $db;
		//$pseudoMemb = "root";
		$query = 'SELECT pseudoMemb FROM MEMBRE WHERE pseudoMemb = $pseudoMemb;';
		$result = $db->prepare($query);
		$result->bindParam(':pseudoMemb', $pseudoMemb);
		$result->execute();
		//$pseudoMemb = $result->fetch();
		//echo " pseudo : ".$pseudoMemb;
		//return ($pseudoMemb);
		//echo $pseudoMemb;
		return (/*$result->fetch() AND */$pseudoMemb);
	}


function get_AllMembresByPseudo($pseudoMemb)
{
	global $db;
	$query = $db->prepare("SELECT * FROM membre WHERE pseudoMemb=:pseudoMemb");
	$query->execute([
		'pseudoMemb' => $pseudoMemb
	]);
	$result = $query->fetchAll(PDO::FETCH_OBJ);
	return $result;
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

	function create($prenomMemb, $nomMemb, $pseudoMemb, $passMemb, $eMailMemb, $dtCreaMemb, $souvenirMemb, $accordMemb,  $idStat)
	{
		global $db;
		try {
			$db->beginTransaction();
			$exec = "INSERT INTO MEMBRE (prenomMemb, nomMemb, pseudoMemb, passMemb, eMailMemb, dtCreaMemb, souvenirMemb, accordMemb,  idStat) VALUES (:prenomMemb, :nomMemb, :pseudoMemb, :passMemb, :eMailMemb, :dtCreaMemb, :souvenirMemb, :accordMemb, :idStat)";
			$result = $db->prepare($exec);
			$result->bindParam(':prenomMemb', $prenomMemb);
			$result->bindParam(':nomMemb', $nomMemb);
			$result->bindParam(':pseudoMemb', $pseudoMemb);
			$result->bindParam(':passMemb', $passMemb);
			$result->bindParam(':eMailMemb', $eMailMemb);
			$result->bindParam(':dtCreaMemb', $dtCreaMemb);
			$result->bindParam(':souvenirMemb', $souvenirMemb);
			$result->bindParam(':accordMemb', $accordMemb);
			$result->bindParam(':idStat', $idStat);
			$result->execute();
			$db->commit();
			$result->closeCursor();
		} catch (PDOException $erreur) {
			die('Erreur insert MEMBRE : ' . $erreur->getMessage());
			$db->rollBack();
			$result->closeCursor();
		}
	}

	function update($numMemb, $prenomMemb, $nomMemb, $passMemb, $eMailMemb, $souvenirMemb, $idStat){
		global $db;
		try {
   $db->beginTransaction();
   if ($passMemb == -1) {
	  # PASS non modifié
		$query = 'UPDATE MEMBRE SET prenomMemb=?, nomMemb=?, eMailMemb=?, souvenirMemb=?, idStat=? WHERE numMemb=?';
					$request1 = $db->prepare($query);
					$request1->execute([$prenomMemb, $nomMemb, $eMailMemb, $souvenirMemb, $idStat, $numMemb]);
					$db->commit();
					$request1->closeCursor();
	} else {
	  # PASS modifié
	  $query = 'UPDATE MEMBRE SET prenomMemb=?, nomMemb=?, passMemb=?, eMailMemb=?, souvenirMemb=?, idStat=? WHERE numMemb=?';
					$request2 = $db->prepare($query);
					$request2->execute([$prenomMemb, $nomMemb, $passMemb, $eMailMemb, $souvenirMemb, $idStat, $numMemb]);
					$db->commit();
					$request2->closeCursor();
	}
		}
		catch (PDOException $e) {
				$db->rollBack();
				if ($passMemb == -1) {
					$request1->closeCursor();
				} else {
				  $request2->closeCursor();
				}
				die('Erreur update MEMBRE : ' . $e->getMessage());
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