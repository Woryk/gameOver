<?php 
    session_start();
    if($_SESSION['pseudo']) {
        header('Location: connexionSuccess.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" value="text/html; charset=utf-8">
    <!-- Bootstrap & FontAwesome & jQuery imports -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/fontawesome/fontawesome-all.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="./js/bootstrap.min.js"></script>
    <!---------------------
                                       _____                
                                      |  _  |               
            __ _  __ _ _ __ ___   ___| | | |_   _____ _ __ 
         / _` |/ _` | '_ ` _ \ / _ \| | | \ \ / / _ \ '__|
        | (_| | (_| | | | | | |  __/\ \_/ /\ V /  __/ |   
        \__, |\__,_|_| |_| |_|\___| \___/  \_/ \___|_|   
        __/ |                                           
        |___/                                             

        L2 Informatique - [Promotion 2017-2018]
        -->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body class="sign-in text-center">
        <form class="form-signin" action="./includes/connect.php" method="get" >
                <a href="index.php" style="text-decoration: none; color: inherit;">
                    <img src="./images/gameOver.svg" width="50" height="50" alt=""> gameOver
                </a>
                <br /></br />
                <h1 class="h3 mb-3 font-weight-normal">Connexion </h1>
                <?php if($_SESSION['messageSuccesInscription']) : ?>
                <div class="alert alert-success" role="alert" style="text-align: left;">
                    <?php 
                    // Affichage du message d'erreur
                    echo $_SESSION['messageSuccesInscription']; 
                    // Une fois affiché on le détruit
                    unset($_SESSION['messageSuccesInscription']);
                    ?>
                </div>
                <?php endif; ?>                
                <?php if($_SESSION['messageErreurConnexion']) : ?>
                <div class="alert alert-danger" role="alert" style="text-align: left;">
                    <?php 
                    // Affichage du message d'erreur
                    echo $_SESSION['messageErreurConnexion']; 
                    // Une fois affiché on le détruit
                    unset($_SESSION['messageErreurConnexion']);
                    ?>
                </div>
                <?php endif; ?>
                <label for="inputUsername" class="sr-only">Pseudo</label>
                <input type="username" id="inputUsername" class="form-control" placeholder="Pseudo" required="" autofocus="" name="pseudo">
                <br />
                <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
                <p class="mt-5 mb-3 text-muted">Projet BDD2 - gameOver 2018</p>
        </form>
</body>
</html>