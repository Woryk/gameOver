<?php

session_start();
  ini_set('default_charset',"windows-1252");
  include("parametres.php");
  $id = oci_connect($user,$pass,$db);
  
  $stid = oci_parse($id, "SELECT * FROM CLASSEMENT WHERE rownum <=20");
    
  
    // Execution
    oci_execute($stid);
		
	while (($checkMate = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != False){
       echo "ouech ";
       $gros = $checkMate['PSEUDO'];
       echo $gros;
       echo  $checkMate['SOCIAL_SCORE'];
       echo  $checkMate['GLOBAL_SCORE'];
       
       
    }

?>

