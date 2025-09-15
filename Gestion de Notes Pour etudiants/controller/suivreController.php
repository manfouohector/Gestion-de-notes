<?php 
    require_once __DIR__.'/../service.php';

  
    if(isset($_GET['action']) == true) {
        $action = $_GET['action'];
        if($action == "read") {
            header("Content-Type:application/json");
            $data = $note->readone($_GET['id_matiere'],$_GET['id_etudiant']);
            echo json_encode($data);
        }
        if($action == 'update') {
            $id_etudiant = $_GET['id_etudiant'];
            $id_matiere = $_GET['id_matiere'];
            $not = $_POST['note'];
            $note->update($id_etudiant,$id_matiere,$not);
            header('Location:../dashboard.php?route=note');
            $_SESSION['info'] = "Vous avez modifie une note";
        }
    }