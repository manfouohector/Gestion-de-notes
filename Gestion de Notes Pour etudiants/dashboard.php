<!DOCTYPE html>
<?php 
    require_once __DIR__.'/service.php';
    if(isset($_SESSION['profil']) == false) {
        $_SESSION['info'] = "Veuillez vous connectez!!!";
        header('Location:login.php');
    } 
?>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
        rel="stylesheet"integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" 
        crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Dashboard</title>
    </head>
    <body>
        <div class="conteneurDash">
            <aside id="dashaside">
                <div class="profil">
                    <img src="assets/images/logo.png" alt="logo" style="width: 60px; border-radius: 100%;"> <br>
                    <?php if($_SESSION['profil']['type'] == 'enseignant' || $_SESSION['profil']['type'] == 'etudiant') { ?>
                        <img src=<?= "image/".$_SESSION['profil']['message']['photo']?> alt="" style="width:100px;border-radius:50px" > <br>
                    <?php } else { ?>
                        <i class="fa-solid fa-user-circle user" id="iconadmin"></i> <br>
                    <?php } ?>
                    <span><?=  $_SESSION['profil']['message']['nom']?></span>
                </div>
                <hr>
                <nav>
                    <?php if($_SESSION['profil']['type'] == 'admin') { ?>
                    <a href="dashboard.php?route=classe" class="<?= $_GET['route'] == "classe" ? "active" : "" ?>">
                        <i class="fa-solid fa-book icon"></i>
                         <span class="Inverse">DASHBOARD</span>
                    </a> <br>
                    <a href="dashboard.php?route=enseignant" class="<?= $_GET['route'] == "enseignant" ? "active" : "" ?>">
                        <i class="fa-solid fa-person-chalkboard icon" ></i>
                        <span class="Inverse">ENSEIGNANTS </span>
                    </a> <br>
                    <a href="dashboard.php?route=matiere" class=<?= $_GET['route'] == "matiere" ?  "active" : "" ?>>
                        
                        <span class="Inverse">MATIERES</span>
                    </a>
                    <?php } ?>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" id="dashbtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <a href=""  class="<?= $_GET['route'] == "liste" || $_GET['route'] == "note" || $_GET['route'] == "classement" ? "active" : "" ?>">
                                <i class="fa-solid fa-user-pen icon"></i>
                                <span class="Inverse">ELEVES</span>
                            </a>
                        </button>

                        <ul class="dropdown-menu">
                            
                            <li>
                                <button class="dropdown-item" type="button">
                                    <a href="dashboard.php?route=liste">
                                        LISTES DES ELEVES
                                    </a>
                                </button>
                            </li>
                            
                            <li><button class="dropdown-item" type="button"><a href="dashboard.php?route=note">NOTES</a></button></li>

                            <li><button class="dropdown-item" type="button"><a href="dashboard.php?route=classement">CLASSEMENT GENERAL</a></button></li>
                        </ul>
                    </div> <br>
                    <?php if($_SESSION['admin']['type'] = 'admin') { ?>
                    <?php } ?>   
                </nav>
            </aside>



            <main>
                <header>
                    <i class="fa-solid fa-bars-staggered" id="dashbars2"></i>
                    <p><i class="fa-solid fa-bars-staggered" id="dashbars"></i></p>
                    <i class="fa-brands fa-searchengin" id="search"></i>
                    <div id="seachbars">
                        <i class="fa-brands fa-searchengin"></i>
                        <input type="search" placeholder="Effectuer une recherche">
                    </div>
                    <p><i class="fa-solid fa-right-from-bracket"></i><a href="controller/deconnexionController.php">LOG OUT</a></p>
                </header>

                <!-- DONNEES SERONT CHARGEES DYNAMIQUEMENT -->
                 <?php include($route) ?>
            </main>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" 
        crossorigin="anonymous"></script>
        <script src="assets/java/script.js"></script>
    </body>
</html>