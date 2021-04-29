<?php 

    session_start();
    session_destroy(); // La session est détruite lors du clique du bouton deconnexion
    header('Location:../index.php'); // L'utilisateur est redirigé vers l'accueil


?>