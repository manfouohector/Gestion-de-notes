<?php 
    session_start();
    require_once __DIR__.'/routes.php';
    require_once __DIR__.'/tools/photo.php'; 

    // =========================model======================
    require_once __DIR__.'/model/matiere.php';
    require_once __DIR__.'/model/note.php';
    require_once __DIR__.'/model/professeur.php';
    require_once __DIR__.'/model/etudiant.php';
    require_once __DIR__.'/model/enseigner.php';
    require_once __DIR__.'/model/donner.php';
    require_once __DIR__.'/model/classe.php';
    
    // =============message===========
    require_once __DIR__.'/views/message.php';

    // ============declaration=============
    $photo = new Photo();
    $matiere = new Matiere();
    $note = new Note();
    $professeur = new Prof();
    $etudiant = new Etudiant();
    $enseigner = new Enseigner();
    $donner = new Donner();
    $classe = new Classe();

?>