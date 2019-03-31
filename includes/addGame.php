<?php
  // ===========================================================================
  // addGame
  // TRAITEMENT DU FORMULAIRE D'AJOUT D'UN JEU
  // ===========================================================================

  session_start();
  ini_set('default_charset',"windows-1252");
  include("parametres.php");
  include("profile.php");
  $id = oci_connect($user,$pass,$db);

  $nomJeu = htmlentities($_POST['nomJeu']);
  $date = $_POST['dateAchat'];
  $dateConvertie = date("d-M-Y", strtotime($date));

  // ================================
  // ON VERIFIE QUE L'UTILISATEUR NE POSSEDE PAS DEJA LE JEU 

  $stid = oci_parse($id, "SELECT PSEUDO FROM ACQUISITION WHERE GAME_NAME LIKE :gameName AND pseudo LIKE :pseudo");
  // Binding
  oci_bind_by_name($stid, ":gameName", $nomJeu);
  oci_bind_by_name($stid, ":pseudo", $_SESSION['pseudo']);
  // Execution
  oci_execute($stid);

  $check = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
  if ($check['PSEUDO'] == $pseudo) {
      $_SESSION['messageErreurAjouterJeu'] = "Vous possedez deja ce jeu !";
      header('Location: ../ajouterJeu.php');
      exit;
  }

  // ================================
  // ON VERFIE QUE LA DATE D'ACHAT N'EST PAS ANTERIEURE A LA DATE DE SORTIE  

  $stid = oci_parse($id, "SELECT RELEASED FROM GAME WHERE NAME LIKE :gameName");
  // Binding
  oci_bind_by_name($stid, ":gameName", $nomJeu);
  // Execution
  oci_execute($stid);
      
  $check = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
  if((strtotime($date) - strtotime($check['RELEASED'])) < 0)  {
      $_SESSION['messageErreurAjouterJeu'] = "La date n'est pas credible !<br/> DATE ACHAT : ".$dateConvertie."<br />DATE SORTIE  : ".$check['RELEASED']."<br /> ";
      header('Location: ../ajouterJeu.php');
      exit;
  }

  // ================================
  // LES DEUX VERIFICATIONS PRECEDENTES PASSEES ON AJOUTE LE JEU

  $stid = oci_parse($id, "INSERT INTO ACQUISITION (PSEUDO, GAME_NAME, ACQUISITION_DATE) VALUES 
  (:pseudo, :gameName, :dateAchat)");

  oci_bind_by_name($stid, ":pseudo", $_SESSION['pseudo']);
  oci_bind_by_name($stid, ":dateAchat", $dateConvertie);
  oci_bind_by_name($stid, ":gameName", $nomJeu);

  // Execution
  if(oci_execute($stid)) {
    $_SESSION['messageSuccesAjouterJeu'] = 'Le jeu &laquo; '.$nomJeu.' &raquo; a &eacute;t&eacute; ajout&eacute; &agrave; votre profil avec succ&egrave;s !<br />';
    header('Location: ../ajouterJeu.php');
  }
  else {
    $_SESSION['messageErreurAjouterJeu'] = 'Une erreur est survenue lors de l\'ajout du jeu '.$nomJeu.'.<br />';
    header('Location: ../ajouterJeu.php');
  }


?>