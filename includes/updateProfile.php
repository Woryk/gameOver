<?php
  // ===========================================================================
  // updateProfil
  // TRAITEMENT DES DONNEES DU FORMULAIRE DE MISE A JOUR DES INFOS. DU PROFIL
  // ===========================================================================

  session_start();
  ini_set('default_charset',"windows-1252");
  include("parametres.php");
  include('profile.php');
  $id = oci_connect($user,$pass,$db);
 
  // $avatar = htmlentities($_GET['avatar']);
  $email = htmlentities($_POST['email']);
  $amateur = htmlentities($_POST['status']);
  $gender = htmlentities($_POST['sexe']);
  $age = htmlentities($_POST['age']);
  $education_level = htmlentities($_POST['education_level']);


  // verification du format de l'avatar
  if($_FILES['avatar']['name'] != "" ) {
    $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
    $extension_upload = strtolower(  substr(  strrchr($_FILES['avatar']['name'], '.')  ,1)  );
    // Si les extensions sont valides on peut procéder à l'upload
    if ( in_array($extension_upload,$extensions_valides) ) {
      // on efface l'ancien fichier s'il existe
      if(is_file("../uploads/{$avatar}")) {
        unlink("../uploads/{$avatar}");
      }
      // puis on upload le nouveau fichier
      $emplacement = "../uploads/{$pseudo}.{$extension_upload}";
      $upload = move_uploaded_file($_FILES['avatar']['tmp_name'],$emplacement);
      // puis on définit la valeur du champ avatar dans la bdd
      $avatar =  "{$pseudo}.{$extension_upload}";
    }
    // Si l'extension est invalide on renvoie une erreur
    else {
      $_SESSION['messageErreurModif'] = "Le format de l'avatar est invalide ! ";;
      header('Location: ../editerProfil.php');
      exit;     
    }
  }
  
  // Verification que les champs ne soient pas vides
  $requete = "UPDATE GAMER SET ";
  if (strcmp($email,"")!== 0){
    $requete = $requete ." email = :email ,";
  }
  if (strcmp($amateur,"")!== 0){
    $requete = $requete ." amateur = :amateur ,";
  }
  if (strcmp($gender,"")!== 0){
    $requete = $requete ." gender = :gender ,";
  }
  if (strcmp($age,"")!== 0){
    $requete = $requete ." age = :age ,";
  }
  if (strcmp($education_level,"")!== 0){
    $requete = $requete ." education_level = :education_level ,";
  }
  $requete = $requete ." avatar = :avatar ";
  $requete = $requete . "WHERE PSEUDO LIKE :pseudo ";  
  
  // vérification de l'absence du pseudo
  $stid = oci_parse($id, $requete);
  
  // Binding pour pouvoir insérer le contenu de la variable dans la requête (ORACLE)
  oci_bind_by_name($stid, ":pseudo", $pseudo);
	oci_bind_by_name($stid, ":amateur", $amateur);
  oci_bind_by_name($stid, ":email", $email);
  oci_bind_by_name($stid, ":avatar", $avatar);
	oci_bind_by_name($stid, ":amateur", $amateur);
	oci_bind_by_name($stid, ":gender", $gender);
	oci_bind_by_name($stid, ":age", $age);
  oci_bind_by_name($stid, ":education_level", $education_level);
  
  // Execution
  if(oci_execute($stid)) {
    $_SESSION['messageSuccesModif'] = 'Vos donn&eacute;es personnelles ont &eacute;t&eacute;s modifi&eacute;es avec succ&egrave;s.<br />';
    header('Location: ../editerProfil.php');
  }
  else {
    $_SESSION['messageErreurModif'] = 'Une erreur est survenue lors de la modification de vos donn&eacute;es personnelles.<br />';
    header('Location: ../editerProfil.php');
  }

  
  
  ?>


