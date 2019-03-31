<?php
    // ===========================================================================
    // gameList
    // PERMET L'AFFICHAGE DE LA LISTE DES JEUX CONTENUS DANS LA BDD
    // [UTILISE POUR L'AJOUT D'UN JEU]
    // ===========================================================================

    ini_set('default_charset',"windows-1252");
    include("parametres.php");
    $id = oci_connect($user,$pass,$db);

    // Requête pour obtenir la liste de jeux
    $stid = oci_parse($id, "SELECT NAME, EDITOR_NAME, PF_NAME, RELEASED FROM GAME INNER JOIN EXISTS_FOR ON NAME = GAME_NAME");
    // Execution
    oci_execute($stid);

    // Traitement ligne par ligne
    echo "<select id='game' class='form-control' name='nomJeu' >\n";
    while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        echo "<option value='".$row['NAME']."' >" . $row['NAME'] . " (" . $row['EDITOR_NAME'] . ") [". $row['PF_NAME'] . "]  < " . $row['RELEASED'] . " > </option>\n";
    }
    echo "</select>\n";    
?>