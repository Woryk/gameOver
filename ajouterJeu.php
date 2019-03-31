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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"
    />
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
    <script>
        document.getElementById('searchGame').onkeyup = searchSel;
        function searchSel() 
            {
            var input = document.getElementById('searchGame').value.toLowerCase();
            
                len = input.length;
                output = document.getElementById('game').options;
            for(var i=0; i<output.length; i++)
                if (output[i].text.toLowerCase().indexOf(input) != -1 ){
                output[i].selected = true;
                    break;
                }
            if (input == '')
                output[0].selected = true;
            }       
    </script>
</head>

<body>
    <?php include('./includes/navbar.php') ?>

    <div id="banner"></div>

    <!-- Content  -->
    <div class="container-fluid">
        <h1><i class="fas fa-gamepad"></i> Ajouter un jeu</h1>
        <br />
        <?php if($_SESSION['messageSuccesAjouterJeu']) : ?>
        <div class="alert alert-success" role="alert" style="text-align: left;">
            <?php 
            // Affichage de la notification
            echo $_SESSION['messageSuccesAjouterJeu']; 
            // Une fois affiché on le détruit
            unset($_SESSION['messageSuccesAjouterJeu']);            
             ?>
        </div>
        <?php endif; ?>
        <?php if($_SESSION['messageErreurAjouterJeu']) : ?>
        <div class="alert alert-danger" role="alert" style="text-align: left;">
            <?php 
            // Affichage du message d'erreur
            echo $_SESSION['messageErreurAjouterJeu']; 
            // Une fois affiché on le détruit
            unset($_SESSION['messageErreurAjouterJeu']);            
             ?>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12 order-md-1">
                <form class="needs-validation" action="./includes/addGame.php" method="POST">

                    <div class="row">
                        <div class="col-md-9 mb-3">
                            <label for="game">Rechercher un jeu
                            <span class="text-muted">(Optionnel : Facilite la recherche d'un jeu dans la liste ci-dessous)</span>
                            </label>
                            <input class="form-control" id="searchGame" name="searchGame" placeholder="Entrez le nom d'un jeu" type="text" onkeyup="searchSel()" />
                            <br />
                            <label for="game">S&eacute;lectionnez un jeu
                                <span class="text-muted">*</span>
                            </label>
                            <?php include('./includes/gameList.php') ?>
                        </div>


                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <!-- Date input -->
                                <label class="control-label" for="date">Date d'achat
                                    <span class="text-muted">*</span>
                                </label>
                                <input class="form-control" id="date" placeholder="JJ/MM/AA" type="date" name="dateAchat">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class='col-sm-3'>
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Ajouter le jeu</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Content end-->

</body>

</html>
