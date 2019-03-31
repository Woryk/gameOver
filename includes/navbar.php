<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">
      <img src="./images/gameOver.svg" width="50" height="50" alt="">
      gameOver
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item <?php if((basename($_SERVER['PHP_SELF'])) == "index.php") { echo "active";}?>">
        <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item <?php if((basename($_SERVER['PHP_SELF'])) == "chercherAstuce.php") { echo "active";}?>">
        <a class="nav-link" href="chercherAstuce.php"><i class="fas fa-search"></i> Astuces <span class="sr-only">(current)</span></a>
      </li>               
      <li class="nav-item dropdown">
        <a class="nav-link <?php if(((basename($_SERVER['PHP_SELF'])) == "classementGlobal.php" )||((basename($_SERVER['PHP_SELF'])) == "classementSocial.php" )) { echo "active";} ?> dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-trophy"></i>  Classement
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="classementGlobal.php"><i class="fas fa-globe"></i> Classement global</a>
          <a class="dropdown-item" href="classementSocial.php"><i class="fas fa-users"></i> Classement social</a>
        </div>
      </li>
    </ul>
  </div>
  <?php if(!$_SESSION['pseudo']) : ?>
  <!-- Si l'utilisateur n'est pas connecte -->
  <a class="nav-link" href="inscription.php">Inscription</a>
  <a href="connexion.php"><button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="far fa-user"></i> Connexion</button></a>
  
  <?php elseif($_SESSION['pseudo']) : ?>
  <!-- Si l'utilisateur est connecte -->
  <ul class="navbar-nav">
    <li id="user_label" class="nav-item dropdown">
      <label for="user-control-list-check" class="dropdown-toggle" data-toggle="dropdown" id="user_dropdown" >
        
      <img component="header/userpicture" src="<?php if($avatar != "") { echo "uploads/{$avatar}"; } else { echo "./images/defaultAvatar.png"; } ?>" >
      <span id="user-header-name" class="visible-xs-inline">Bienvenue, <?php echo $_SESSION['pseudo']; ?></span>

      </label>
      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="profil.php"><i class="fas fa-user"></i> Mon profil</a>
              <a class="dropdown-item" href="editerProfil.php"><i class="fas fa-cog"></i> Modifier infos</a>
              <a class="dropdown-item" href="supprProfil.php"><i class="fas fa-eraser"></i> Supprimer infos</a>
              <a class="dropdown-item" href="ajouterJeu.php"><i class="fas fa-gamepad"></i> Ajouter jeu</a>
              <a class="dropdown-item" href="creerAstuce.php"><i class="fas fa-pen-square"></i> Cr&eacute;er une astuce</a>
              <a class="dropdown-item" href="./includes/disconnect.php" style="color: #dc3545;"><i class="fas fa-sign-out-alt"></i> D&eacute;connexion </a>
      </div>
    </li>
  </ul>

  <?php endif; ?>

</nav><!-- navbar end -->