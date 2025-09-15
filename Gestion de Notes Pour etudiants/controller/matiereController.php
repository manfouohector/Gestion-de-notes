<?php 
    require_once __DIR__.'/../service.php';

  
     if(isset($_GET['action']) == true) {
        $action = $_GET['action'];
        if($action == 'create') {
            $nom = $_POST['nom'];
            $coef = $_POST['coef'];
            $matiere->create($nom,$coef);
            header('Location:../dashboard.php?route=matiere');
            $_SESSION['info'] = "Vous avez cree une matiere";
        } 
        if($action == 'delete') {
            $matiere->delete($_GET['id']);
            header('Location:../dashboard.php?route=matiere');
            $_SESSION['info'] = "Vous avez supprimer une matiere";
        } 
        if($action == "read") {
            header("Content-Type:application/json");
            $data = $matiere->readone($_GET['id']);
            echo json_encode($data);
        }
        if($action == 'update') {
            $nom = $_POST['nom'];
            $coef = $_POST['coef'];
            $id = $_GET['id'];
            $matiere->update($id,$nom,$coef);
            header('Location:../dashboard.php?route=matiere');
            $_SESSION['info'] = "Vous avez modifiee une matiere";
        }
     }