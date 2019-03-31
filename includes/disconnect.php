<?php
    // ===========================================================================
    // disconnect
    // TRAITEMENT DE LA DECONNEXION
    // ===========================================================================

    // Initialisation de la session.
    session_start();

    // Détruit toutes les variables de session
    $_SESSION = array();

    // Finalement, on détruit la session.
    session_destroy();
    
    // On redirige vers la page de connexion
    header('Location: ../index.php');
?>