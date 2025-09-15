<?php 
    require_once __DIR__.'/../service.php';
    if(isset($_GET['action'])== true) {
        $action = $_GET['action'];
        if($action == 'connexion'){
            $nom = $_POST['nom'];
            $mat = $_POST['matricule'];
            $data  = $etudiant->connexion($nom,$mat);
            $data2 = $professeur->connexion($nom,$mat);
            if($data != "") {
                header('Location:../dashboard.php?route=liste');
                $_SESSION['profil'] = array(
                    'type'=> 'etudiant',
                    'message'=>$data);
                $_SESSION['info'] = "Bienvenue $nom";


            } else if($data2 != "") {
                header('Location:../dashboard.php?route=note');
                $_SESSION['profil'] = array(
                    'type'=>'enseignat',
                    'message'=>$data2);
                $_SESSION['info'] = "Bienvenue $nom";


            } else if($nom == 'admin' && $mat == 'admin') {
                $message = array('nom'=>'admin');
                header('Location:../dashboard.php?route=classe');
                $_SESSION['profil'] = array(
                    'type'=>'admin',
                    'message'=>$message
                );
                $_SESSION['info'] = "Bienvenue $nom";


            } else {
                header('Location:../login.php');
                $_SESSION['info'] = "Matricule incorrect";
            }
        }
    }

?>