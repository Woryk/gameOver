<?php 
    session_start();
    include('./includes/profile.php');
    include('./includes/searchTrick.php');
    include('./includes/voter.php');
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
    <!-- NAVBAR -->
    <?php include('./includes/navbar.php'); ?>

    <div id="banner"></div>

    <!-- Content  -->
    <div class="container-fluid">
        <h1><i class="fas fa-search"></i> Chercher une astuce </h1>
    

        <div class="jumbotron">

				<form class="needs-validation" action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-9 mb-3">
                            <label for="game">Rechercher un jeu
                            <span class="text-muted">(Optionnel : Facilite la recherche d'un jeu dans la liste ci-dessous)</span>
                            </label>
                            <input class="form-control" id="searchGame" name="searchGame" placeholder="Entrez le nom d'un jeu" type="text" onkeyup="searchSel()" />
                            <br />
                        </div>
					<div class="col-md-3 mb-3">
                            <label for="age">Niveau
                                <span class="text-muted">(Optionnel)</span>
                            </label>
                            <input type="age" class="form-control" id="niveau" placeholder="20" name="niveau">
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 mb-3">
                            <label for="game">S&eacute;lectionnez un jeu
                            <span class="text-muted">*</span>
                            </label>
                            <?php include('./includes/gameList.php') ?>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="prix">Type
                                <span class="text-muted">*</span>
                            </label>
                            <div class="custom-control custom-radio">
                                <input id="prixN" name="gratuite" type="radio" class="custom-control-input" checked="" required="" value="NULL">
                                <label class="custom-control-label" for="prixN" >Non pr&eacute;cis&eacute;</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="prixP" name="gratuite" type="radio" class="custom-control-input" required="" value="False">
                                <label class="custom-control-label" for="prixP" >Payante</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="prixG" name="gratuite" type="radio" class="custom-control-input" required="" value="True">
                                <label class="custom-control-label" for="prixG" >Gratuite</label>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" >Rechercher</button>
                </form>          	
			
        </div> 
        
        <!-- Affichage -->
        <?php include('./includes/resultSearchTrick.php'); ?>  
    
    </div>


    <!-- Content end-->

</body>

</html>
