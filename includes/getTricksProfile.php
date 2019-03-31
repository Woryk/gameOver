<?php
    // ===========================================================================
    // getTricksProfile
    // PERMET L'AFFICHAGE DE LA LISTE DES ASTUCES CREEES SUR LA PAGE DE PROFIL
    // ===========================================================================

	session_start();
	ini_set('default_charset',"windows-1252");
	include("parametres.php");
	$id = oci_connect($user,$pass,$db);
		
	
	// ================================
	// ASTUCES PAYANTES

	// Requête
	$stid = oci_parse($id, "SELECT * FROM TRICK INNER JOIN NOT_FREE ON TRICK.ID = NOT_FREE.ID WHERE PSEUDO = :pseudo");
	// Binding
	oci_bind_by_name($stid, ":pseudo", $pseudo);
	// Execution
	oci_execute($stid);

	// Traitement des données
	while (($resPayante = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) != false) {
		echo "<div class='card'>";
		echo "<div class='row'>";
		echo "<div class='col-sm px-0'>";
		echo "<div class='card-body'>";
		echo "<h4 class='card-title'>";
		echo $resPayante['GAME_NAME']." - Niveau ".$resPayante['GAME_LEVEL'];
		echo " <span class='badge badge-pill badge-warning'>Payante</span>";
		echo "</h4>";
		echo "<p class='card-text'>";
		echo $resPayante['DEAL'];
		echo  "</p>";
		echo "</div>";
		echo "</div>";
		echo "<div class='col-sm col-sm-auto pl-0'>";
		echo "<div style='font-size:4em;color: #bdbdbd;'>";
		echo "<i class='fas fa-angle-right'></i>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
	}

	// ================================
	// ASTUCES GRATUITES

	// Requête
	$stid = oci_parse($id, "SELECT * FROM TRICK INNER JOIN FREE_TRICK ON TRICK.ID = FREE_TRICK.ID WHERE PSEUDO = :pseudo");
	// Binding
	oci_bind_by_name($stid, ":pseudo", $pseudo);
	// Execution
	oci_execute($stid);

	// Traitement des données
	while (($resPayante = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) != false) {
		echo "<div class='card'>";
		echo "<div class='row'>";
		echo "<div class='col-sm px-0'>";
		echo "<div class='card-body'>";
		echo "<h4 class='card-title'>";
		echo $resPayante['GAME_NAME']." - Niveau ".$resPayante['GAME_LEVEL'];
		echo " <span class='badge badge-pill badge-info'>Gratuite</span>";
		echo "</h4>";
		echo "<p class='card-text'>";
		echo $resPayante['TRICK_TEXT'];
		echo  "</p>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
		echo "</div>";
	}

  ?>