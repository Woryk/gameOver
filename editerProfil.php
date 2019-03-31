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
    <!-- navbar -->
    <?php include('./includes/navbar.php') ?>
    <!-- navbar end -->

    <div id="banner"></div>

    <!-- Content  -->
    <div class="container-fluid">
        <h1><i class="fas fa-cog"></i> Modifier mes donn&eacute;es personnelles</h1>
        <br />
        <?php if($_SESSION['messageSuccesModif']) : ?>
        <div class="alert alert-success" role="alert" style="text-align: left;">
            <?php 
            // Affichage de la notification
            echo $_SESSION['messageSuccesModif']; 
            // Une fois affiché on le détruit
            unset($_SESSION['messageSuccesModif']);            
             ?>
        </div>
        <?php endif; ?>
        <?php if($_SESSION['messageErreurModif']) : ?>
        <div class="alert alert-danger" role="alert" style="text-align: left;">
            <?php 
            // Affichage du message d'erreur
            echo $_SESSION['messageErreurModif']; 
            // Une fois affiché on le détruit
            unset($_SESSION['messageErreurModif']);            
             ?>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12 order-md-1">
                <form class="needs-validation" action="./includes/updateProfile.php" method="POST" enctype="multipart/form-data" >

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="age">Age
                                <span class="text-muted">(Optionnel)</span>
                            </label>
                            <input type="age" class="form-control" id="age" name="age" value="<?php if($age) { echo $age; } ?>" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="customFile">Avatar (format .jpg, .png ou .gif)
                                <span class="text-muted">(Optionnel)</span>
                            </label>
                            <div class="custom-file">
                                <input type="file" class="form-control-file" name="avatar">
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="sexef">Sexe
                                <span class="text-muted">*</span>
                            </label>
                            <div class="custom-control custom-radio">
                                <input id="sexeh" name="sexe" type="radio" class="custom-control-input" <?php if($gender == 'M') { echo 'checked=""'; } ?> required="" value="M">
                                <label class="custom-control-label" for="sexeh">Homme</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="sexef" name="sexe" type="radio" class="custom-control-input" required="" <?php if($gender == 'F') { echo 'checked=""'; } ?> value="F">
                                <label class="custom-control-label" for="sexef">Femme</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="statusAma">Status
                                <span class="text-muted">*</span>
                            </label>
                            <div class="custom-control custom-radio">
                                <input id="statusAma" name="status" type="radio" class="custom-control-input" <?php if($amateur == 'True') { echo 'checked=""'; } ?> required="" value="True">
                                <label class="custom-control-label" for="statusAma">Joueur amateur</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="statusPro" name="status" type="radio" class="custom-control-input" <?php if($amateur == 'False') { echo 'checked=""'; } ?> required="" value="False">
                                <label class="custom-control-label" for="statusPro">Joueur pro.</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nivEtud">Niveau d'&eacute;tudes
                                <span class="text-muted">*</span>
                            </label>
                            <div class="custom-control custom-radio">
                                <input id="bac" name="education_level" type="radio" class="custom-control-input" <?php if($education_level == 'Bac') { echo 'checked=""'; } ?> required="" value="Bac">
                                <label class="custom-control-label" for="bac" >Bac</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="licence" name="education_level" type="radio" class="custom-control-input" <?php if($education_level == 'L') { echo 'checked=""'; } ?> required="" value="L">
                                <label class="custom-control-label" for="licence" >Licence</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="master" name="education_level" type="radio" class="custom-control-input" <?php if($education_level == 'M') { echo 'checked=""'; } ?> required="" value="M">
                                <label class="custom-control-label" for="master" >Master</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="doctorat" name="education_level" type="radio" class="custom-control-input" <?php if($education_level == 'D') { echo 'checked=""'; } ?> required="" value="D">
                                <label class="custom-control-label" for="doctorat">Doctorat</label>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="mb-3">
                        <label for="email">Email
                            <span class="text-muted">*</span>
                        </label>
                        <input type="email" class="form-control" id="email" placeholder="moi@exemple.com" name="email" value="<?php echo $email; ?>" >
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="row">
                        <div class='col-sm-3'>
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Modifier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Content end-->

</body>

</html>