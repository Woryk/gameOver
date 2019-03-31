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
E
        L2 Informatique - [Promotion 2017-2018]
        -->
    <link rel="stylesheet" href="./css/style.css">
    <script language="Javascript">
    function hideText()
    {

        document.getElementById("texte").style.display="none";
        document.getElementById("deal").style.display="block";    

    }

    function hideDeal()
    {
        document.getElementById("deal").style.display="none";
        document.getElementById("texte").style.display="block";

    }
    </script>
</head>

<body>
    <?php include('./includes/navbar.php') ?>

    <div id="banner"></div>

    <!-- Content  -->
    <div class="container-fluid">
        <h1><i class="fas fa-pen-square"></i> Cr&eacute;er une astuce </h1>
        <br />
        <?php if($_SESSION['messageSuccesCreerAstuce']) : ?>
        <div class="alert alert-success" role="alert" style="text-align: left;">
            <?php 
            // Affichage de la notification
            echo $_SESSION['messageSuccesCreerAstuce']; 
            // Une fois affiché on le détruit
            unset($_SESSION['messageSuccesCreerAstuce']);            
             ?>
        </div>
        <?php endif; ?>
        <?php if($_SESSION['messageErreurCreerAstuce']) : ?>
        <div class="alert alert-danger" role="alert" style="text-align: left;">
            <?php 
            // Affichage du message d'erreur
            echo $_SESSION['messageErreurCreerAstuce']; 
            // Une fois affiché on le détruit
            unset($_SESSION['messageErreurCreerAstuce']);            
             ?>
        </div>
        <?php endif; ?>        
        <div class="row">
            <div class="col-md-12 order-md-1">
                <form class="needs-validation" action="./includes/addTrick.php" method="POST" >
                    <div class="col-md-9 mb-3">
                        <div class="form-group">
                            <div class="row">
                                    <label class="control-label" for="date">
                                        <b>Jeu concern&eacute;</b>
                                        <span class="text-muted">*</span>
                                    </label>
                                    <?php include('./includes/gameOwnedList.php') ?>  
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="gamelevel">Niveau du jeu
                                <span class="text-muted">*</span>
                            </label>
                            <input type="text" class="form-control" id="gamelevel" placeholder="1,20,50" name="niveau" required="">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="gratuite">Type d'astuce
                                <span class="text-muted">*</span>
                            </label>
                            <div class="custom-control custom-radio">
                                <input id="gratuit" name="gratuite" type="radio" class="custom-control-input" required="" value="True" onClick="hideDeal()" checked="">
                                <label class="custom-control-label" for="gratuit">Astuce <span class="badge badge-pill badge-info">Gratuite</span></label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="payante" name="gratuite" type="radio" class="custom-control-input" required="" value="False" onClick="hideText()">
                                <label class="custom-control-label" for="payante">Astuce <span class="badge badge-pill badge-warning">Payante</span></label>
                            </div>
                            
                        </div>
                    </div>

                    <!-- astuce grauite -->
                    <div class="row" id="texte" style="display: block;" >
                        <div class="col-md-9 mb-3">
                            <label for="gratuite">Texte de l'astuce
                                <span class="text-muted">*</span>
                            </label>
                            <div class="form-group">
                                <textarea class="form-control" id="texte" name="texte" placeholder="Ecrivez ici le contenu de votre astuce." rows="10" ></textarea>
                            </div>   
                        </div>
                    </div>

                    <!-- astuce payante -->
                    <div class="row" id="deal" style="display: none;" >
                        <div class="col-md-3 mb-3">
                            <label for="gratuite">Nature du deal
                                <span class="text-muted">*</span>
                            </label>
                            <div class="custom-control custom-radio">
                                <input id="argent" name="natureDeal" type="radio" class="custom-control-input" checked="" value="money">
                                <label class="custom-control-label" for="argent" >Contre de l'argent</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="echange" name="natureDeal" type="radio" class="custom-control-input" value="exchange">
                                <label class="custom-control-label" for="echange" >Contre un echange</label>
                            </div>

                        </div>                    
                    </div>

                    <div class="row">
                        <div class='col-sm-3'>
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Cr&eacute;er l'astuce <i class="fas fa-angle-right"></i></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Content end-->

</body>

</html>