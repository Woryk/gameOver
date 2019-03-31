<?php
  // ===========================================================================
  // deleteProfile
  // TRAITEMENT DES DONNEES DU FORMULAIRE DE SUPPRESSION DES INFOS. DU PROFIL
  // ===========================================================================
  session_start();
  ini_set('default_charset',"windows-1252");
  include("parametres.php");
  include("profile.php");
  $id = oci_connect($user,$pass,$db);

  // récupération de la valeur du champ à supprimmer
  $attribut = htmlentities($_POST['attribut']);

  // construction de la requête
  $requete = "UPDATE GAMER SET ". $attribut ." = NULL WHERE PSEUDO LIKE :pseudo ";

  // vérification de l'absence du pseudo
  $stid = oci_parse($id, $requete);
  // Binding pour pouvoir insérer le contenu de la variable dans la requête (ORACLE)
  oci_bind_by_name($stid, ":pseudo", $pseudo);

  // On prends en compte la suppression de l'avatar du dossier ./uploads
  if(($attribut == "avatar") && (is_file("../uploads/{$avatar}"))) {
      unlink("../uploads/{$avatar}");
  }


  // Execution
  if(oci_execute($stid)) {
    $_SESSION['messageSuccesSuppr'] = 'Vos donn&eacute;es personnelles ont &eacute;t&eacute;s modifi&eacute;es avec succ&egrave;s.<br />';
    header('Location: ../supprProfil.php');
  }
  else {
    $_SESSION['messageErreurSuppr'] = 'Une erreur est survenue lors de la modification de vos donn&eacute;es personnelles.<br />';
    header('Location: ../supprProfil.php');
  }

?>