<?php
    require_once __DIR__.'/../service.php';
    unset($_SESSION['profil']);
    $_SESSIOn['profil'] = "vous etes deconnectes";
    header('Location:../login.php');