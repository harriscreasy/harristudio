<!-- Cette page sert au traitement de la page de connexion -->
<?php 

//On démarre la session
session_start();

// On appelle une fois config.php qui permet la connexion à la base de données
require_once 'config.php';

// Isset vérifie si les input email et password existent bien et sont lisibles
if(isset($_POST['email']) && isset($_POST['password'])){

// Je les sécurise puis les stockent dans des variables
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

// J'effectue ma requête SQL pour vérifier si l'utilisateur existe
$check_exist = $bdd->prepare('SELECT pseudo, email, password FROM user_harristudio WHERE email = ?');
$check_exist->execute(array($email));

//recupere les données retournées sous forme de tableau
$data = $check_exist->fetch(); 

//retoune le nombre de ligne retourné par la base de données
$row = $check_exist->rowCount(); 

// Row renvoi 1 c'est que l'utilisateur existe
// Je peux lancer la procédure de connexion
if($row == 1){

      // J'hache le mot de passe reçu de l'input de connexion
        $password = hash('sha256', $password); 
         // Je le compare à celui de la base de données
        if($data['password'] === $password){

            //Je prepare une requête pour récupérer l'userid qui est associé au mail
            $check_id = $bdd->prepare('SELECT id FROM user_harristudio WHERE email = ?'); 
            $check_id->execute(array($email)); 
            $userid = $check_id->fetch(); 

          
            $_SESSION["user"] = $data[0]; 
            // Enregistre le pseudo de l'utilisateur
            // $data Fetch, index[0] est le pseudo
            
            $_SESSION["userid"] = $userid[0];
            // Enregistre l'id de l'utilisateur
            // $userid Fetch, index[0] est l'id
            
            //Connexion réussie redirection index.php
            header('Location:../index.php');


              } else header('Location:index-connexion.php?login_err=password');
    
     } else header('Location:index-connexion.php?login_err=already');
// Affiche un message d'erreur à l'utilisateur 

} else header('Location:index-connexion.php'); // Sinon on renvoit vers l'index.php

?>