<?php

  session_start();
  ini_set('default_charset',"windows-1252");
  include("parametres.php");
  $id = oci_connect($user,$pass,$db);

  $stid = oci_parse($id, "SELECT * FROM CLASSEMENT_SOCIAL WHERE rownum <=20");
  
  // Execution
  oci_execute($stid);
  
  echo '<tbody>';
  $row = 1;
  while (($check = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != False) {
        echo '<tr>';
        echo '<th scope="row">'.$row.'</th>';
        echo '<td>'.$check['PSEUDO'].'</td>';
        echo '<td>'.$check['SOCIAL_SCORE'].'</td>';
        echo '<td>'.$check['GLOBAL_SCORE'].'</td>';
        echo '</tr>';
        $row++;
  }
  echo '</tbody>';

?>