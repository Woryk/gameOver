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

<body>
    <!-- NAVBAR -->
    <?php include('./includes/navbar.php'); ?>

    <div id="banner"></div>

    <!-- Content  -->
    <div class="container-fluid">

        <div class="jumbotron">
            <div class="row">
                <!-- avatar -->
                <div class="col-2">
                    <img class="img-fluid" id="avatar2" src="<?php if($avatar != "") { echo "uploads/{$avatar}"; } else { echo "./images/defaultAvatar.png"; } ?>" >
                </div>
                <!-- informations -->
                <div class="col-10">
                    <h1><i class="fas fa-user"></i><b> <?php echo $pseudo; ?></b></h1>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 15%">Sexe</th>
                                <td><?php echo $gender; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Age</th>
                                <td>
                                <?php 
                                    if($age) { echo $age . ' ans'; }
                                    else { echo '<i>Age non sp&eacute;cifi&eacute;</i>'; } 
                                ?> 
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Niveau d'&eacute;tudes</th>
                                <td>
                                <?php 
                                    if ($education_level == 'D') { echo 'Doctorat';}
                                    if ($education_level == 'M') { echo 'Master';}
                                    if ($education_level == 'L') { echo 'Licence';}
                                    if ($education_level == 'Bac') { echo 'Bac';}
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Status</th>
                                <td>
                                <?php 
                                    if($amateur == 'False') {
                                        if($gender == 'M') { echo 'Joueur professionnel'; }
                                        else { echo 'Joueuse professionnelle'; }
                                    }
                                    else {
                                        if($gender == 'M') { echo 'Joueur amateur'; }
                                        else { echo 'Joueuse amateur'; }
                                    } 
                                ?> 
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Score global</th>
                                <td><?php echo $globalScore; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Score social</th>
                                <td><?php echo $socialScore; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- jumbotron end-->

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-jeux" role="tab" aria-controls="nav-home"
                    aria-selected="true">Jeux <span class="badge badge-primary"><?php echo $nbJeu; ?></span></a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-astuces" role="tab" aria-controls="nav-profile"
                    aria-selected="false">Astuces <span class="badge badge-primary"><?php echo $nbAstuces; ?></span></a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <!-- JEUX POSSEDES -->
            <div class="tab-pane fade show active" id="nav-jeux" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="card-list">
                    <div class="row">

                    <?php include('./includes/getGamesProfile.php'); ?>

                    </div>
                </div>
            </div>
            <!-- ASTUCES GRATUITES -->
            <div class="tab-pane fade" id="nav-astuces" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="card-list">
                    
                <?php include('./includes/getTricksProfile.php'); ?>

                </div>
            </div>
        </div>
    </div>
    <!-- Content end-->

</body>

</html>