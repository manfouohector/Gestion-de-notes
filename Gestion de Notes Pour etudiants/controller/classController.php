<?php 
    require_once __DIR__.'/../service.php';

  
     if(isset($_GET['action']) == true) {
        $action = $_GET['action'];
        if($action == 'create') {
            $nom = $_POST['nom'];
            $classe->create($nom);
            header('Location:../dashboard.php?route=classe');
            $_SESSION['info'] = "Vous avez cree une classe";
        } 
        if($action == 'delete') {
            $classe->delete($_GET['id']);
            header('Location:../dashboard.php?route=classe');
            $_SESSION['info'] = "Vous avez supprimer une classe";
        } 
        if($action == "read") {
            header("Content-Type:application/json");
            $data = $classe->readone($_GET['id']);
            echo json_encode($data);
        }
        if($action == 'update') {
            $nom = $_POST['nom'];
            $id = $_GET['id'];
            $classe->update($id,$nom);
            header('Location:../dashboard.php?route=classe');
            $_SESSION['info'] = "Vous avez modifie une classe";
        }
        if($action == 'affectation') {
            $id_classe = $_POST['id_classe'];
            $id_matiere = $_POST['id_matiere'];
            $enseigner->create($id_classe,$id_matiere);
            header('Location:../dashboard.php?route=classe');
        }
     }