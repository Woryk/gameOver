<?php
    // ===========================================================================
    // connect
    // TRAITEMENT DE LA CONNEXION
    // ===========================================================================

    session_start();
    ini_set('default_charset',"UTF-8");
    include("parametres.php");
    include('profile.php');
    $connect = oci_connect($user,$pass,$db,'AL32UTF8');

    // On recupere le contenu de champs
    $pseudo = htmlentities($_GET["pseudo"]); 

    // On cherche le mail associe au pseudo
    $stid = oci_parse($connect, "SELECT pseudo FROM GAMER WHERE pseudo LIKE :pseudo");
    // Binding pour pouvoir insérer le contenu de la variable dans la requête (ORACLE)
    oci_bind_by_name($stid, ":pseudo", $pseudo);
    // Execution
    oci_execute($stid);

    // Récupération du résultat
    $check = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
    
    // On verifie que le mot de passe correspond à celui entré manuellement
    if ($check['PSEUDO'] == $pseudo){
        echo "Connexion réussie !<br />";
        $_SESSION['pseudo'] = $pseudo;
        header('Location: ../connexionSuccess.php');
        exit;
    }
    else {
        $_SESSION['messageErreurConnexion'] = 'Le pseudo que vous avez entr&eacute; est incorrect. Veuillez r&eacute;essayer.<br />';
        header('Location: ../connexion.php');
    }

?>