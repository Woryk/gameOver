<?php
  // ===========================================================================
  // searchTrick
  // TRAITEMENT DU FORMULAIRE DE RECHERCHE D'ASTUCE
  // ===========================================================================

// On verifie qu'une recherche a été lancée
if(isset($_POST['submit'])) {
	session_start();
	ini_set('default_charset',"windows-1252");
	include("parametres.php");
	$idConnect = oci_connect($user,$pass,$db);
	$numTrick = 0;
	$tabResult = array();
  
	$nomJeu = htmlentities($_POST['nomJeu']); // jamais null
	$numLevel = htmlentities($_POST['niveau']); // peut etre vide
	$gratuite = htmlentities($_POST['gratuite']); // True, False ou NULL
	
	$requeteid = "SELECT * FROM TRICK WHERE GAME_NAME LIKE '". $nomJeu. "' ";
	
	if(strcmp($numLevel,"") !== 0){
		$requeteid = $requeteid . "AND game_level LIKE :numLevel" ;
	}
	
	$stid = oci_parse($idConnect, $requeteid);
		if(strcmp($numLevel,"") !== 0){
		oci_bind_by_name($stid,":numLevel", $numLevel);
	}

    // Execution
    oci_execute($stid);
	while (($check = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) != false) {
		$tabResult[$numTrick] = array();
		$autor = $check['PSEUDO'];
		$idTrick = $check['ID'];
		$trick_text= "NULL";
		$requeteV = "SELECT count(pseudo) AS NBVOTE FROM VOTES WHERE id LIKE :idTrick";
		$stid0 = oci_parse($idConnect, $requeteV);
		
		oci_bind_by_name($stid0, ":idTrick", $idTrick);
		// Execution
		oci_execute($stid0);
		
		$checkV = oci_fetch_array($stid0, OCI_ASSOC+OCI_RETURN_NULLS);
		
		if ((strcmp($gratuite,"True") == 0) || (strcmp($gratuite,"NULL") == 0)) { // Si l'astuce est gratuite ou non precise
			
			$requeteG = "SELECT trick_text FROM FREE_TRICK WHERE id LIKE :idTrick";
			$stid1 = oci_parse($idConnect, $requeteG);
			oci_bind_by_name($stid1, ":idTrick", $idTrick);
			// Execution
			oci_execute($stid1);
			
			while (($checkG = oci_fetch_array($stid1, OCI_BOTH+OCI_RETURN_NULLS)) != false) {
				$trick_text = $checkG['TRICK_TEXT'];
				$gratuiteTexte = "Gratuite";
			}
		
		}
		
		if ((strcmp($gratuite,"False") == 0) || (strcmp($gratuite,"NULL") == 0)) { // Si l'astuce est payante ou non precise
			
			$requeteP = "SELECT deal FROM NOT_FREE WHERE id LIKE :idTrick";
			$stid2 = oci_parse($idConnect, $requeteP);
			oci_bind_by_name($stid2, ":idTrick", $idTrick);
			// Execution
			oci_execute($stid2);
			
			while (($checkP = oci_fetch_array($stid2, OCI_BOTH+OCI_RETURN_NULLS)) != false) {
				$trick_text = $checkP['DEAL'];
				$gratuiteTexte = "Payante";
				
				$requeteMail = "SELECT email FROM GAMER WHERE PSEUDO LIKE :autor";
				// recuperation de l'adresse mail
				$stidM = oci_parse($idConnect, $requeteMail);
				oci_bind_by_name($stidM, ":autor", $autor);
				// Execution
				oci_execute($stidM);
				
				$checkM = oci_fetch_array($stidM, OCI_BOTH+OCI_RETURN_NULLS);
			}
		}
        $tabResult[$numTrick]['EMAIL'] = $checkM['EMAIL'];;
        $tabResult[$numTrick]['IDTRICK'] = $idTrick;
        $tabResult[$numTrick]['GAME_NAME'] = $check['GAME_NAME'];
        $tabResult[$numTrick]['GAME_LEVEL'] = $check['GAME_LEVEL'];
        $tabResult[$numTrick]['TRICK_TEXT'] = $trick_text;
        $tabResult[$numTrick]['NBVOTES'] = $nbVotes;
        $tabResult[$numTrick]['NOMJEU'] = $nomJeu;
        $tabResult[$numTrick]['GRATUITETEXTE'] = $gratuiteTexte;
        $tabResult[$numTrick]['AUTOR'] = $autor;

		$numTrick++;

	}
	// Libération de l'identifiant de requête lors de la fermeture de la connexion
	oci_free_statement($stid);
	if($stid1) { oci_free_statement($stid1);}
	if($stid2) { oci_free_statement($stid2);}
	oci_close($idConnect);
}

?>