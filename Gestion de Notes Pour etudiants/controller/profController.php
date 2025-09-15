<?php 
    require_once __DIR__.'/../service.php';

  
     if(isset($_GET['action']) == true) {
        $action = $_GET['action'];
        if($action == 'create') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $age = $_POST['age'];
            $sexe = $_POST['sexe'];
            $matricule = $_POST['matricule'];
            $p = $_FILES['photo'];
            $phot = $photo->upload_image($p);
            
            $professeur->create($nom,$prenom,$sexe,$matricule,$age,$phot);
            header('Location:../dashboard.php?route=enseignant');
            $_SESSION['info'] = "Vous avez ajoute un nouveau prof";
        } 
        if($action == 'delete') {
            $prof = $professeur->readone($_GET['id']);
            unlink("../image/".$prof['photo']);
            $professeur->delete($_GET['id']);
            header('Location:../dashboard.php?route=enseignant');
            $_SESSION['info'] = "Vous avez supprime un professeur";
        } 
        if($action == "read") {
            header("Content-Type:application/json");
            $data = $professeur->readone($_GET['id']);
            echo json_encode($data);
        }
        if($action == 'update') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $age = $_POST['age'];
            $sexe = $_POST['sexe'];
            $matricule = $_POST['matricule'];
            $id = $_GET['id'];

            $prof = $professeur->readone($_GET['id']);
            unlink("../image/".$prof['photo']);

            $p = $_FILES['photo'];
            $phot = $photo->upload_image($p);
            $professeur->update($id,$nom,$prenom,$sexe,$matricule,$age,$phot);
            header('Location:../dashboard.php?route=enseignant');
            $_SESSION['info'] = "Vous avez modifie un prof";
        }
        if($action == 'affectation') {
            $id_proffeseur = $_POST['id_proffeseur'];
            $id_matiere = $_POST['id_matiere'];
            $donner->create($id_proffeseur,$id_matiere);
            header('Location:../dashboard.php?route=enseignant');
        }
     }