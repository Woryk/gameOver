<?php 
    session_start();
    if($_SESSION['pseudo']) {
        include('./includes/profile.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Bootstrap & jQuery imports -->
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/fontawesome/fontawesome-all.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="./js/bootstrap.min.js" ></script>
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
    <body>
      <!-- NAVBAR -->
      <?php include('./includes/navbar.php'); ?>

          <!-- Main page -->
          <header class="masthead text-center text-white">
                <div class="masthead-content">
                  <div class="container">
                    <h1 class="masthead-heading mb-0">Bienvenue sur gameOver</h1>
                    <h2 class="masthead-subheading mb-0">Le site d'entraide et de partage autour des jeux-vid&eacute;os</h2>
                    <?php if(!$_SESSION['pseudo']) : ?>
                    <a href="inscription.php" class="btn btn-primary btn-xl rounded-pill mt-5">Inscription</a>
                    <?php elseif($_SESSION['pseudo']) : ?>
                    <a href="profil.php" class="btn btn-primary btn-xl rounded-pill mt-5">Acc&eacute;der &agrave; mon profil</a>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="bg-circle-1 bg-circle"></div>
                <div class="bg-circle-2 bg-circle"></div>
                <div class="bg-circle-3 bg-circle"></div>
                <div class="bg-circle-4 bg-circle"></div>
          </header><!-- Main page end -->

    </body>
</html>