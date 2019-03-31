<?php
    // ===========================================================================
    // profile
    // PERMET LA RECUPERATION DES INFORMATIONS DE L'UTILISATEUR
    // ===========================================================================

    ini_set('default_charset',"windows-1252");
    include("parametres.php");
    $id = oci_connect($user,$pass,$db);

    // -- RECUPERATION INFOS PROFIL

    // On cherche le mail associe au pseudo
    $stid = oci_parse($id, "SELECT * FROM GAMER WHERE pseudo LIKE :pseudo");
    // Binding pour pouvoir insérer le contenu de la variable dans la requête (ORACLE)
    oci_bind_by_name($stid, ":pseudo", $_SESSION['pseudo']);
    // Execution
    oci_execute($stid);

    // Récupération du résultat
    $check = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);

	// Stockage des résultats
	$pseudo = $check['PSEUDO'];
    $avatar = html_entity_decode($check['AVATAR']);
    $email = $check['EMAIL'];
    $amateur = trim($check['AMATEUR']);
    $gender = $check['GENDER'];
    $age = $check['AGE'];
    $education_level = trim($check['EDUCATION_LEVEL']);
	$globalScore = $check['GLOBAL_SCORE'];
    $socialScore = $check['SOCIAL_SCORE']; 
    
    // -- RECUPERATION NOMBRE DE JEUX POSSEDES

    $stid = oci_parse($id, "SELECT GAME_NAME FROM ACQUISITION WHERE pseudo LIKE :pseudo");
	// Binding pour pouvoir insérer le contenu de la variable dans la requête (ORACLE)
	oci_bind_by_name($stid, ":pseudo", $pseudo);
	// Execution
	oci_execute($stid);

	// Comptage du nombre de jeux possédés
    $nbJeu = 0;
	while (($list = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) != false) {
		$nbJeu++;
    }
    
    // -- RECUPERATION DU NOMBRE D'ASTUCES CREEES

	// Requête
	$stid = oci_parse($id, "SELECT ID FROM TRICK WHERE PSEUDO = :pseudo");
	// Binding
	oci_bind_by_name($stid, ":pseudo", $pseudo);
	// Execution
	oci_execute($stid);

	// Traitement des données
    $nbAstuces = 0;
    while (($resAstuces = oci_fetch_array($stid, OCI_BOTH+OCI_RETURN_NULLS)) != false) {
		$nbAstuces++;
    }

?>