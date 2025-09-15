<?php  
    require_once __DIR__.'/service.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Login</title>
    </head>
    <body>
        <div class="loginConteneur">
            <form action="controller/connexionController.php?action=connexion" method="POST" id="loginForm">
                <h1 id="loginH1"><i class="fa-solid fa-house-user" id="loginHome"></i> CONNEXION</h1> <br>
                <div class="login">
                    <i class="fa-solid fa-user-large"></i>
                    <input type="text" placeholder="Entrer votre nom" name="nom" class="loginInput">
                </div> <br>
                <div class="login">
                    <i class="fa-solid fa-key"></i>
                    <input type="text" placeholder="Entrer votre matricule" name="matricule" class="loginInput">
                </div> <br>
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                   <a href="">CONNEXION</a> 
                </button>  <br>
                <span class="loginSpan">
                    vous n'avez pas de compte?
                    <a href="" class="loginA">
                        Inscrivez-vous
                    </a>
                </span>
                <div class="loginIcon">
                    <br>
                    <i class="fa-brands fa-facebook-f"></i> &nbsp;
                    <i class="fa-brands fa-instagram"></i> &nbsp;
                    <i class="fa-brands fa-twitter"></i> 
                </div>
            </form>
        </div>
    </body>
</html>