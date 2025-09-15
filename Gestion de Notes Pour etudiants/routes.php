<?php 
    $folder = "views/";
    $routes = array(
        "classe" => $folder . "classe.php",
        "classement" => $folder . "classement_eleve.php",
        "enseignant" => $folder . "enseignant.php",
        "liste" => $folder . "liste_eleve.php",
        "matiere" => $folder . "matiere.php",
        "note" => $folder . "notes_eleves.php"
    );

    $route = null;
    if(isset($_GET['route']) == true) {
        if(array_key_exists($_GET['route'],$routes) == true) {
            $route = $routes[$_GET['route']];
        }
    }
?>