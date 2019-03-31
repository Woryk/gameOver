<?php
    // ===========================================================================
    // gameOwnedList
    // PERMET D'AFFICHER LA LISTE DES JEUX POSSEDES
    // [UTILISE POUR LA CREATION D'UNE ASTUCE]
    // ===========================================================================

    ini_set('default_charset',"windows-1252");
    include("parametres.php");
    include('profile.php');
    $id = oci_connect($user,$pass,$db);

    // ================================
    // ON RECUPERE LA LISTE DES JEUX  

    // Requête pour obtenir la liste de jeux dont il existe une session pour ce joueur
    $stid = oci_parse($id, "SELECT DISTINCT GAME_NAME FROM GAME_SESSION WHERE PSEUDO LIKE :pseudo");
      // Binding
    oci_bind_by_name($stid, ":pseudo", $pseudo);
    // Execution
    oci_execute($stid);

    // ================================
    // CREATION DE LA LISTE  

    echo "<select id='game' class='form-control' name='nomJeu' >\n";
    while ($jeuSession = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        // Pour chaque jeu on va verifier le lvl max passe par le joueur
        $stid2 = oci_parse($id, "SELECT LEVEL_END FROM (SELECT * FROM GAME_SESSION WHERE GAME_NAME LIKE :jeu ORDER BY LEVEL_END DESC) WHERE ROWNUM = 1 AND PSEUDO = :pseudo");
        // Binding
        oci_bind_by_name($stid2, ":pseudo", $pseudo);
        oci_bind_by_name($stid2, ":jeu", $jeuSession['GAME_NAME']);
        // Execution
        oci_execute($stid2);

        // Recuperation des resultats de la requête
        $resMaxLvl = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS);
        echo "<option value='".$jeuSession['GAME_NAME']."' >" . $jeuSession['GAME_NAME'] . " ( Niveau max. : " . $resMaxLvl['LEVEL_END'] . " ) </option>\n";
    }
    echo "</select>\n"; 

?>