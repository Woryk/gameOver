<?php 
    session_start();
    if(!$_SESSION['pseudo']) {
        header('Location: connexion.php');
    }
    include('./includes/profile.php');
?>
<!DOCTYPE html>
<html>
<head>
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
        <div class="form-signin" >
                <a href="index.php" style="text-decoration: none; color: inherit;">
                    <img src="./images/gameOver.svg" width="50" height="50" alt=""> gameOver
                </a>
                <br /></br />
                <h1 class="h3 mb-3 font-weight-normal">Bienvenue !</h1>
                <img class="img-fluid" id="avatar2" src="<?php if($avatar != "") { echo "uploads/{$avatar}"; } else { echo "./images/defaultAvatar.png"; } ?>">
                <br />
                <h5><?php echo $_SESSION['pseudo']; ?></h5>
                <br />
                <a href="profil.php"><button class="btn btn-lg btn-secondary btn-block">Acc&eacute;der au profil</button></a>
                <br />
                <a href="./includes/disconnect.php"><button class="btn btn-lg btn-danger btn-block">D&eacute;connexion</button></a>
                <br />
                <a href="index.php"><button class="btn btn-lg btn-primary btn-block">Retour &agrave; la page d'accueil</button></a>

                <p class="mt-5 mb-3 text-muted">Projet BDD2 - gameOver 2018</p>
        </div>
</body>
</html>