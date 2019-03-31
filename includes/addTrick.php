<?php
  // ===========================================================================
  // addTrick
  // TRAITEMENT DU FORMULAIRE DE CREATION D'ASTUCE
  // ===========================================================================

	session_start();
	ini_set('default_charset',"windows-1252");
	include("parametres.php");
	include('profile.php');
	$id = oci_connect($user,$pass,$db);
  
	$nomJeu = htmlentities($_POST['nomJeu']);
	$niveau = htmlentities($_POST['niveau']);
	$gratuite = htmlentities($_POST['gratuite']);
	$texte = htmlentities($_POST['texte']);
	$deal = htmlentities($_POST['natureDeal']);

	echo $niveau;
	// ================================
	// ON VERIFIE QUE LE JOUEUR A ACQUIS LE JEU

	$stid = oci_parse($id, "SELECT PSEUDO FROM ACQUISITION WHERE GAME_NAME LIKE :nomJeu AND pseudo LIKE :pseudo");
	// Binding pour pouvoir insérer le contenu de la variable dans la requête (ORACLE)
	oci_bind_by_name($stid, ":nomJeu", $nomJeu);
	oci_bind_by_name($stid, ":pseudo", $_SESSION['pseudo']);
	// Execution
	oci_execute($stid);

	$check = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);

	// ================================
	// SI C'EST LE CAS ON PASSE A LA SUITE DU PROGRAMME

	if ($check['PSEUDO'] == $pseudo){
		
		// ================================
		// ON VERIFIE QUE LE JOUEUR A ATTEINT LE NIVEAU DE L'ASTUCE

		$stid = oci_parse($id, "SELECT PSEUDO FROM GAME_SESSION WHERE GAME_NAME LIKE :nomJeu AND pseudo LIKE :pseudo AND level_end >= :niveau");
		// Binding 
		oci_bind_by_name($stid, ":nomJeu", $nomJeu);
		oci_bind_by_name($stid, ":pseudo", $_SESSION['pseudo']);
		oci_bind_by_name($stid, ":niveau", $niveau);
		// Execution
		oci_execute($stid);
		
		$check = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
		echo strcmp($pseudo,$check['PSEUDO']) ;
		// ================================
		// SI C'EST LE CAS ON PASSE A LA SUITE DU PROGRAMME

			if ($check['PSEUDO'] == $pseudo){

				// On compte le nombre d'astuces existantes pour lui donner un id
				$stid = oci_parse($id, "SELECT ID FROM TRICK");
				// Execution
				oci_execute($stid);

				// Traitement du résultat
				$numId = 1;
				while(($check = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
					$numId++;
				}

				// ================================
				// CREATION DE L'ASTUCE (TABLE TRICK)

				$stid = oci_parse($id, "INSERT INTO TRICK (id, game_name, game_level, pseudo) VALUES 
				(:id, :nomJeu, :niveau, :pseudo)");

				oci_bind_by_name($stid, ":id", $numId);
				oci_bind_by_name($stid, ":nomJeu", $nomJeu);
				oci_bind_by_name($stid, ":pseudo", $_SESSION['pseudo']);
				oci_bind_by_name($stid, ":niveau", $niveau);
				// Execution
				oci_execute($stid);
			
				// ================================
				// CREATION DE L'ASTUCE

				// ASTUCE PAYANTE
				if (strcmp($gratuite,"False")== 0){
					$stid = oci_parse($id, "INSERT INTO NOT_FREE (id, deal) VALUES 
					(:id, :texte)");
					// Biding
					oci_bind_by_name($stid, ":id", $numId);
					oci_bind_by_name($stid, ":texte", $deal);
					// Execution
					if(oci_execute($stid)) {
						$_SESSION['messageSuccesCreerAstuce'] = "L'astuce payante sur le jeu &laquo; ".$nomJeu." &raquo; a &eacute;t&eacute; cr&eacute;e avec succ&egrave;s !";
						header('Location: ../creerAstuce.php');
					  }
					else {
						$_SESSION['messageErreurCreerAstuce'] = "Une erreur est survenue lors de la cr&eacute;ation de l'astuce.<br />";
						header('Location: ../creerAstuce.php');
					}
					exit;

				}
				// ASTUCE GRATUITE
				if (strcmp($gratuite,"True")== 0){
					// ON VERIFIE QUE LE CHAMP DE TEXTE N'EST PAS VIDE
					if($texte == "") {
						$_SESSION['messageErreurCreerAstuce'] = "Veuillez entrer le contenu de l'astuce !<br />";
						header('Location: ../creerAstuce.php');	
						exit;					
					}
					
					// SI IL N'EST PAS VIDE ON CREE L'ASTUCE
					$stid = oci_parse($id, "INSERT INTO FREE_TRICK (id, trick_text) VALUES 
					(:id, :texte)");
					// Biding
					oci_bind_by_name($stid, ":id", $numId);
					oci_bind_by_name($stid, ":texte", $texte);
					// Execution
					if(oci_execute($stid)) {
						$_SESSION['messageSuccesCreerAstuce'] = "L'astuce gratuite sur le jeu &laquo; ".$nomJeu." &raquo; a &eacute;t&eacute; cr&eacute;e avec succ&egrave;s !";
						header('Location: ../creerAstuce.php');
					  }
					else {
						$_SESSION['messageErreurCreerAstuce'] = "Une erreur est survenue lors de la cr&eacute;ation de l'astuce.<br />";
						header('Location: ../creerAstuce.php');
					}
					exit;
				}
			}
		// ERREUR 2
		$_SESSION['messageErreurCreerAstuce'] = "Vous n'avez pas atteint le niveau de l'astuce !";
		header('Location: ../creerAstuce.php');
		exit;
	}
	// ERREUR 1
	$_SESSION['messageErreurCreerAstuce'] = "Vous ne possedez pas ce jeu !";
	header('Location: ../creerAstuce.php');
	echo "Vous ne possedez pas ce jeu !";
	exit;

  ?>