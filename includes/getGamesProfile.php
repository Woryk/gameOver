<?php
    // ===========================================================================
    // getGamesProfile
    // PERMET L'AFFICHAGE DE LA LISTE DES JEUX POSSEDES SUR LA PAGE DE PROFIL
    // ===========================================================================

	session_start();
	ini_set('default_charset',"windows-1252");
	include("parametres.php");
	$id = oci_connect($user,$pass,$db);
		
	
	$stid = oci_parse($id, "SELECT GAME_NAME FROM ACQUISITION WHERE pseudo LIKE :pseudo");
	// Binding pour pouvoir insérer le contenu de la variable dans la requête (ORACLE)
	oci_bind_by_name($stid, ":pseudo", $_SESSION['pseudo']);
	// Execution
	oci_execute($stid);

	// Declaration du tableau
	$gameList = array();
	$key = 0;
	// Remplissage de la liste de jeux
	while (($list = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) != false) {
		$gameList[$key] = $list['GAME_NAME'];
		$key++;
	}

	// Stockage du nombre de jeux
	$nbJeu = count($gameList);
	
	$gameInfo = array();
	for ($i = 0; $i< $nbJeu; $i++) {

		// -- INFORMATIONS JEU

		// Recuperation du nom du jeu
		$name = $gameList[$i];
		// On récupère les informations du jeu correspondant
		$stid = oci_parse($id, "SELECT * FROM GAME INNER JOIN EXISTS_FOR ON NAME = GAME_NAME WHERE name LIKE :name");
		// Binding pour pouvoir insérer le contenu de la variable dans la requête (ORACLE)
		oci_bind_by_name($stid, ":name", $name);
		// Execution
		oci_execute($stid);

		// Récupération du résultat
		$gameInfos = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
		
		$name = $gameInfos['NAME'];
		$editor = $gameInfos['EDITOR_NAME'];
		$genre = $gameInfos['GENRE'];
		$platform = $gameInfos['PF_NAME'];
		if (trim($gameInfos['OFF_LINE']) == "True"){
			$off_line = "Hors ligne";
		} else if (trim($gameInfos['OFF_LINE']) == "False"){
			$off_line = "En ligne";
		}
		if (trim($gameInfos['MULTIPLAYER']) == "True"){
			$multi = "Multijoueur";
		} else if (trim($gameInfos['MULTIPLAYER']) == "False"){
			$multi = "Solo";
		}
		$dateReleased = $gameInfos['RELEASED'];
		$nbLevels = $gameInfos['NB_LEVELS'];

		// -- DATE ACQUISITION JEU

		// On récupère également la date d'acquisition du jeu
		$stid = oci_parse($id, "SELECT ACQUISITION_DATE FROM ACQUISITION INNER JOIN GAME ON ACQUISITION.GAME_NAME = GAME.NAME WHERE ACQUISITION.PSEUDO = :pseudo AND ACQUISITION.GAME_NAME = :gameName");
		// Binding pour pouvoir insérer le contenu de la variable dans la requête (ORACLE)
		oci_bind_by_name($stid, ":pseudo", $_SESSION['pseudo']);
		oci_bind_by_name($stid, ":gameName", $name);
		// Execution
		oci_execute($stid);

		// Récupération du résultat
		$gameInfos = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
		$acquDate = $gameInfos['ACQUISITION_DATE'];

		// -- AFFICHAGE DE LA VIGNETTE DU JEU

		echo "<div class='card' style='width: 18rem;'>";
		echo "<div class='card-body'>";
		echo "<h5 class='card-title'>".$name."</h5>";
		echo "<p class='card-text'>";
		echo "<b> Editeur </b> : ".$editor."<br />";
		echo "<b> Genre </b> : ".$genre."<br />";
		echo $off_line." / ";
		echo $multi."<br />";
		echo "<b> Date de sortie </b> : ".$dateReleased."<br />";
		echo "<b> Nombre de niveaux </b> : ".$nbLevels."<br />";
		echo "<span class='badge badge-".strtolower(str_replace(' ', '', $platform))."'>".$platform."</span>";
		echo "</p>";
		echo "</div>";
		echo "<div class='card-footer'>Ajout&eacute; le ".$acquDate."</div>";
		echo "</div>";

	}

  ?>