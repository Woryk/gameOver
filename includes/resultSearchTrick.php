<?php
  // ===========================================================================
  // resultSearchTrick
  // AFFICHAGE DES RESULTATS DE RECHERCHE D'ASTUCE
  // ===========================================================================

    echo "<h3> <i class='fas fa-list'></i> Resultats de la recherche ";
    $s = "";
    $count = 0;
    if($tabResult) {
        if(count($tabResult) > 1) { $s = "s"; }
        for ($i = 0; $i < count($tabResult); $i++) {
            if (strcmp($tabResult[$i]['TRICK_TEXT'],"NULL") !== 0){
            $count++;
            }
        }
        echo '<span class="badge badge-secondary">'.$count.' r&eacute;sultat'.$s.' trouv&eacute;'.$s.'</span>';
    }
    echo "</h3>";
    echo '<form class="needs-validation" action="" method="POST" >';
    echo "<div id='nav-astuces'>";
    echo "<div class='card-list'>";
    if($tabResult) {
        // Parcours du tableau de résultats de la recherche
        for ($i = 0; $i < count($tabResult); $i++) {
            if (strcmp($tabResult[$i]['TRICK_TEXT'],"NULL") !== 0){
            echo "<div class='card'>";
            echo "<div class='row'>";
            echo "<div class='col-sm px-0'>";
            echo "<div class='card-body'>";
            echo "<h4 class='card-title'>";
            echo $tabResult[$i]['NOMJEU'] . " - Niveau ". $tabResult[$i]['GAME_LEVEL'] ." ";
            if($tabResult[$i]['GRATUITETEXTE'] == "Gratuite") {
                echo "<span class='badge badge-pill badge-info'>Gratuite</span>";
            }
            else if ($tabResult[$i]['GRATUITETEXTE'] == "Payante") {
                echo "<span class='badge badge-pill badge-warning'>Payante</span>";
            }
            echo $tabResult[$i]['NBVOTES'];
            echo "</h4>";
            echo "<p class='card-text'>";
            if(($tabResult[$i]['GRATUITETEXTE'] == "Payante") && ($tabResult[$i]['TRICK_TEXT'] == 'exchange' )) {
                echo 'Astuce contre &eacute;change.<br /><b>Contact : <a href="mailto:'.$tabResult[$i]['EMAIL'].'">'.$tabResult[$i]['EMAIL'].'</a></b>';
            }
            else if (($tabResult[$i]['GRATUITETEXTE'] == "Payante") && ($tabResult[$i]['TRICK_TEXT'] == 'money')) {
                echo 'Astuce contre argent.<br /><b>Contact : <a href="mailto:'.$tabResult[$i]['EMAIL'].'">'.$tabResult[$i]['EMAIL'].'<a/></b>';
            }
            else {
                echo $tabResult[$i]['TRICK_TEXT'];
            }
            echo  "</p>";
            if($tabResult[$i]['GRATUITETEXTE'] == "Gratuite") {
                echo '<b class="text-primary">'.$tabResult[$i]['NBVOTES'].' votes</b>     ';
                echo '<button type="button" class="btn btn-outline-primary" type="submit" name="vote" value="'.$tabResult[$i]['IDTRICK'].'" > <i class="fas fa-thumbs-up"></i> +1</button>';
            }
            echo "</div>";
            echo "</div>";
            echo "<div class='col-sm col-sm-auto pl-0'>";
            echo "</div>";
            echo "</div>";
            echo "</div>";  
        }        
        }
    }
    if((isset($_POST['submit'])) && (count($tabResult) == 0)) {
        echo '<div class="alert alert-danger" role="alert" style="text-align: left;">';
        echo 'La recherche n\'a retourn&eacute;e aucun r&eacute;sultat.';
        echo '</div>';
    }
    echo "</div>";
    echo "</div>"; 
    echo '</form>';  
    
    // Une fois affiché on vide la table des résultats
    $tabResult = array();

?>