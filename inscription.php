<?php 
    session_start();
    if($_SESSION['pseudo']) {
        header('Location: connexionSuccess.php');
    }
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

<body class="sign-up">

    <div class="container">
        <div class="py-5 text-center">
            <a href="index.php" style="text-decoration: none; color: inherit;">
                <img src="./images/gameOver.svg" width="50" height="50" alt=""> gameOver
            </a>
            <br />
            <br />
            <h2>Inscription</h2>
        </div>
        <?php if($_SESSION['messageErreurInscription']) : ?>
        <div class="alert alert-danger" role="alert" style="text-align: left;">
            <?php 
            // Affichage du message d'erreur
            echo $_SESSION['messageErreurInscription']; 
            // Une fois affiché on le détruit
            unset($_SESSION['messageErreurInscription']);            
             ?>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12 order-md-1">
                <form class="needs-validation" action="./includes/register.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="username">Pseudo
                            <span class="text-muted">*</span>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" id="username" placeholder="Username" required="" name="pseudo" >
                            <div class="invalid-feedback" style="width: 100%;">
                                Your username is required.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="age">Age
                                <span class="text-muted">(Optionnel)</span>
                            </label>
                            <input type="age" class="form-control" id="age" placeholder="20" name="age">
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
                            <label for="sexeh">Sexe
                                <span class="text-muted">*</span>
                            </label>
                            <div class="custom-control custom-radio">
                                <input id="sexeh" name="sexe" type="radio" class="custom-control-input" checked="" required="" value="M">
                                <label class="custom-control-label" for="sexeh" >Homme</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="sexef" name="sexe" type="radio" class="custom-control-input" required="" value="F">
                                <label class="custom-control-label" for="sexef" >Femme</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="statusAma">Status
                                <span class="text-muted">*</span>
                            </label>
                            <div class="custom-control custom-radio">
                                <input id="statusAma" name="status" type="radio" class="custom-control-input" checked="" required="" value="True">
                                <label class="custom-control-label" for="statusAma" >Joueur amateur</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="statusPro" name="status" type="radio" class="custom-control-input" required="" value="False">
                                <label class="custom-control-label" for="statusPro" >Joueur pro.</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nivEtud">Niveau d'&eacute;tudes
                                <span class="text-muted">*</span>
                            </label>
                            <div class="custom-control custom-radio">
                                <input id="bac" name="education_level" type="radio" class="custom-control-input" checked="" required="" value="Bac">
                                <label class="custom-control-label" for="bac" >Bac</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="licence" name="education_level" type="radio" class="custom-control-input" required="" value="L">
                                <label class="custom-control-label" for="licence" >Licence</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="master" name="education_level" type="radio" class="custom-control-input" required="" value="M">
                                <label class="custom-control-label" for="master" >Master</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="doctorat" name="education_level" type="radio" class="custom-control-input" required="" value="D">
                                <label class="custom-control-label" for="doctorat">Doctorat</label>
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">

                    <div class="mb-3">
                        <label for="email">Email
                            <span class="text-muted">*</span>
                        </label>
                        <input type="email" class="form-control" id="email" placeholder="moi@exemple.com" required="" name="email" >
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>


                    <button class="btn btn-primary btn-lg btn-block" type="submit">S'inscrire</button>
                </form>
            </div>
        </div>

        <p class="mt-5 mb-3 text-muted text-center">Projet BDD2 - gameOver 2018</p>
        <br />
    </div>

</body>

</html>