<?php

session_start();
  ini_set('default_charset',"windows-1252");
  include("parametres.php");
  $id = oci_connect($user,$pass,$db);

  $stid = oci_parse($id, "SELECT * FROM CLASSEMENT_SOCIAL WHERE rownum <=20");
    
  
    // Execution
    oci_execute($stid);
		
	while (($check = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != False){
        echo $check['PSEUDO'];
        echo $check['SOCIAL_SCORE'];
        echo $check['GLOBAL_SCORE'];
		}

?>

