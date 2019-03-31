<?php
  // ===========================================================================
  // register
  // TRAITEMENT DES DONNEES DU FORMULAIRE D'INSCRIPTION
  // ===========================================================================

  session_start();
  ini_set('default_charset',"windows-1252");
  include("parametres.php");
  $id = oci_connect($user,$pass,$db);

  // ================================
  // RECUPERATION DES CHAMPS DU FORMULAIRE 

  $pseudo = htmlentities($_POST['pseudo']);
  $email = htmlentities($_POST['email']);
  $amateur = htmlentities($_POST['status']);
  $gender = htmlentities($_POST['sexe']);
  $age = htmlentities($_POST['age']);
  $education_level = htmlentities($_POST['education_level']);
  
  // ================================
  // VERIFICATIONS

  // vérification de la présence d'accents dans le pseudo
  if(!preg_match('#^[a-zA-Z0-9]*$#', $_POST['pseudo'])) {
    $_SESSION['messageErreurInscription'] = "Veuillez entrer un pseudo sans accents ni caract&egrave;res sp&eacute;ciaux.";;
    header('Location: ../inscription.php');
    exit;   
  }

  // vérification de l'absence du pseudo
  $stid = oci_parse($id, "SELECT pseudo FROM GAMER WHERE pseudo LIKE :pseudo");
  // Binding pour pouvoir insérer le contenu de la variable dans la requête (ORACLE)
  oci_bind_by_name($stid, ":pseudo", $pseudo);
  // Execution
  oci_execute($stid);
  $check = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
  if ($check['PSEUDO'] == $pseudo){
      $_SESSION['messageErreurInscription'] = "Le pseudo existe deja ! ";;
      header('Location: ../inscription.php');
      exit;
  }

  // verification du format de l'avatar
  
  if($_FILES['avatar']['name'] != "" ) {
    $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
    $extension_upload = strtolower(  substr(  strrchr($_FILES['avatar']['name'], '.')  ,1)  );
    // Si les extensions sont valides on peut procéder à l'upload
    if ( in_array($extension_upload,$extensions_valides) ) {
      // on upload le fichier
      $emplacement = "../uploads/{$pseudo}.{$extension_upload}";
      $upload = move_uploaded_file($_FILES['avatar']['tmp_name'],$emplacement);
      // puis on définit la valeur du champ avatar dans la bdd
      $avatar =  "{$pseudo}.{$extension_upload}";
    }
    // Si l'extension est invalide on renvoie une erreur
    else {
      $_SESSION['messageErreurInscription'] = "Le format de l'avatar est invalide ! ";;
      header('Location: ../inscription.php');
      exit;     
    }
  }



  // ================================
  // AJOUT DE LA LIGNE DANS LA TABLE GAMER

  $stid = oci_parse($id, "INSERT INTO GAMER (pseudo, avatar, email, amateur,gender,age,education_level,social_score,global_score) VALUES 
  (:pseudo, :avatar, :email, :amateur,:gender,:age,:education_level,0,0)");
  
  oci_bind_by_name($stid, ":pseudo", $pseudo);
  oci_bind_by_name($stid, ":avatar", $avatar);
  oci_bind_by_name($stid, ":email", $email);
  oci_bind_by_name($stid, ":amateur", $amateur);
  oci_bind_by_name($stid, ":gender", $gender);
  oci_bind_by_name($stid, ":age", $age);
  oci_bind_by_name($stid, ":education_level", $education_level);
  
  // Execution
  if(oci_execute($stid)) {
    $_SESSION['messageSuccesInscription'] = 'Votre compte &laquo; '.$pseudo.' &raquo; a &eacute;t&eacute; cr&eacute;e avec succ&egrave;s !<br /> Veuillez vous connecter.<br />';
    header('Location: ../connexion.php');
  }
  else {
    $_SESSION['messageErreurInscription'] = 'Une erreur est survenue lors de la modification de vos donn&eacute;es personnelles.<br />';
    header('Location: ../inscription.php');
  }

?>