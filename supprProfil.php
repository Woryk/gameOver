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
    <script type="text/javascript" src="./js/moment.js"></script>
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
</head>

<body>
    <?php include('./includes/navbar.php') ?>

    <div id="banner"></div>

    <!-- Content  -->
    <div class="container-fluid">
        <h1><i class="fas fa-eraser"></i> Supprimer mes donn&eacute;es personnelles </h1>
        <br />
        <?php if($_SESSION['messageSuccesSuppr']) : ?>
        <div class="alert alert-success" role="alert" style="text-align: left;">
            <?php 
            // Affichage de la notification
            echo $_SESSION['messageSuccesSuppr']; 
            // Une fois affiché on le détruit
            unset($_SESSION['messageSuccesSuppr']);            
             ?>
        </div>
        <?php endif; ?>
        <?php if($_SESSION['messageErreurSuppr']) : ?>
        <div class="alert alert-danger" role="alert" style="text-align: left;">
            <?php 
            // Affichage du message d'erreur
            echo $_SESSION['messageErreurSuppr']; 
            // Une fois affiché on le détruit
            unset($_SESSION['messageErreurSuppr']);            
             ?>
        </div>
        <?php endif; ?>
        <p>S&eacute;lectionnez la donn&eacute;e que vous souhaitez supprimer de votre profil puis cliquez sur le bouton &quot;
            <b>Supprimer</b> &quot; ci-dessous :
        </p>
        <div class="row">
            <div class="col-md-12 order-md-1">
                <form class="needs-validation" action="./includes/deleteProfile.php" method="POST" >

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="avatar">
                                <b>Informations</b>
                                <span class="text-muted">*</span>
                            </label>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="avatar" class="custom-control-input" name="attribut" value="avatar" checked="" required="">
                                <label class="custom-control-label" for="avatar">Avatar</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="age" name="attribut" class="custom-control-input" name="attribut" value="age" required="">
                                <label class="custom-control-label" for="age">Age</label>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class='col-sm-3'>
                            <button class="btn btn-danger btn-lg btn-block" type="submit">Supprimer</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Content end-->

</body>

</html>