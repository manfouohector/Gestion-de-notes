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
            $id_classe = $_POST['id_classe'];
            $p = $_FILES['photo'];
            $phot = $photo->upload_image($p);
            
            $etudiant->create($nom,$prenom,$sexe,$matricule,$age,$phot,$id_classe);
            $id_matiere = $enseigner->readMatieres($id_classe);
            $id1 = $etudiant->getlastid();
            $not = 0;
            foreach ($id_matiere as $i) {
                $note->create($id1['id_etudiant'],$i['id_matiere'],$not);
            }
            header('Location:../dashboard.php?route=liste');
            $_SESSION['info'] = "Vous avez ajoute un nouveau eleve";
        } 
        if($action == 'delete') {
            $prof = $etudiant->readone($_GET['id']);
            unlink("../image/".$prof['photo']);
            $etudiant->delete($_GET['id']);
            header('Location:../dashboard.php?route=liste');
            $_SESSION['info'] = "Vous avez supprime un eleve";
        } 
        if($action == "read") {
            header("Content-Type:application/json");
            $data = $etudiant->readone($_GET['id']);
            echo json_encode($data);
        }
        if($action == 'update') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $age = $_POST['age'];
            $sexe = $_POST['sexe'];
            $matricule = $_POST['matricule'];
            $id_classe = $_POST['id_classe'];
            $id = $_GET['id'];

            $prof = $etudiant->readone($_GET['id']);
            unlink("../image/".$prof['photo']);

            $p = $_FILES['photo'];
            $phot = $photo->upload_image($p);
            $etudiant->update($id,$nom,$prenom,$sexe,$matricule,$age,$phot,$id_classe);
            header('Location:../dashboard.php?route=liste');
            $_SESSION['info'] = "Vous avez modifie un eleve";
        }
     }