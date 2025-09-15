<?php 
    if(isset($_SESSION['info']) == true) {
        $info = $_SESSION['info'];
        echo "<script>";
        echo " alert('".$info."')";
        echo "</script>";


        unset($_SESSION['info']);
    }
?>