<?php
if(isset($_POST['vote'])) {
	// CONNEXION ORACLE
    session_start();
    ini_set('default_charset',"windows-1252");
    include("parametres.php");
    $id = oci_connect($user,$pass,$db);
  
    $idTrick = htmlentities($_POST['vote']);
    
    $stid = oci_parse($id, "SELECT PSEUDO FROM VOTES WHERE pseudo LIKE :pseudo AND id LIKE :idTrick");
    // Binding pour pouvoir insérer le contenu de la variable dans la requête (ORACLE)
    oci_bind_by_name($stid, ":pseudo", $_SESSION['pseudo']);
    oci_bind_by_name($stid, ":idTrick", $idTrick);

    // Execution
    oci_execute($stid);
        
    while (($check = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != False){
        $_SESSION['messageErreurVote'] = "Vous avez deja votez pour ce jeu !";
        echo $_SESSION['messageErreurVote'];
    }
  
    $stid2 = oci_parse($id, "INSERT INTO VOTES (ID, PSEUDO) VALUES 
    (:idTrick, :pseudo)");
    
    oci_bind_by_name($stid2, ":pseudo", $_SESSION['pseudo']);
    oci_bind_by_name($stid2, ":idTrick", $idTrick);
    
    oci_execute($stid2);
}  
?>