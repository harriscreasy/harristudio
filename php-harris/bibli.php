<?php

//On démarre une session
session_start();

//Lien vers la base de données
require_once 'config.php';

    // Session user est une super globale
    // Elle se déclare dans connexion.php
    // Je peux la récuperer ici

    if(!isset($_SESSION['user'])){ 
        header("Location: login_bibli.php");
// Si il n'y pas de session active je redirige l'utilisateur
    } else{

//bouton_like est le nom de l'input avec le coeur
//Si celui-ci est envoyé

        if (isset($_POST["bouton_like"])){ 

        //On stocke l'id du post 
        $postid = (int)$_POST["bouton_like"];
        

        //On récupére l'user id de la Session
        // et je le stocke dans cette variable
        $userid = (int)$_SESSION['userid'];
        
        //Vérification pour pas que l'utilisateur like la même publication.

        $check_like = $bdd->prepare("SELECT * FROM `like` WHERE userid = ? AND postid = ?"); 
        $check_like->execute([$userid, $postid]); 

        $row = $check_like->rowCount();
        
        if ($row == 0){ 

    //Si $check_like est égal à 0 c'est que l'utilisateur n'a pas liké la publication
    //Je peux donc préparer ma requete SQL qui va insérer son like

            // On prépare la requête SQL dans la table like 
            // En insérant le numéro d'userid et le numéro du post.
            $insert_like = $bdd->prepare("INSERT INTO `like`(userid, postid) VALUES(?, ?)");
            //Marqueur de position, les valeurs qui peuvent être sensibles. 
            //Il faut les controler je les remplaces par des valeurs sécurisées.
            // On exécute la requête SQL 
            $insert_like->execute(array($userid, $postid));
        
        } else {

            $delete_like = $bdd->prepare("DELETE FROM `like` WHERE userid = ? AND postid = ?");
            $delete_like->execute(array($userid, $postid));
            
        }
        
             }
           
                 }

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HarriStudio - La référence des filtres Snapchat</title>
   <!-- ------ LIEN FONT AWESOME ------- -->
    <script src="https://kit.fontawesome.com/93585804ff.js" crossorigin="anonymous"></script>

    <!-- ------ LIEN VERS LORD ICON ANIMÉ ------- -->
    <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>
    <!-- ------ LIEN FEUILLE CSS ------- -->
    <link rel="stylesheet" href="../css/bibliotheque.css">
</head>
<body>

 <!-- ----------- HEADER DU SITE  ----------- -->

 <div class="logo">  
 
<div class="grid-container">

<div class="div1"><a href="fav.php"><lord-icon
    src="https://cdn.lordicon.com/rjzlnunf.json"
    trigger="loop-on-hover"
    colors="primary:#ffffff,secondary:#e83a30"
    style="width:80px;height:80px">
</lord-icon></a></div>

<div class="div2">  <a href="../index.php"><img src="../img/harriStudio.png" alt="Dev Cheat Code"></a></div>

<div class="div3">  

<!-- Affiche le nom de l'utilisateur en haut à droite -->

    <?php

if(isset($_SESSION['user'])){

$username = $_SESSION['user'];


echo <<<line

<div class="user">
<h1 style="color: white; text-align:center;">$username</h1>
</div>

<button style="text-align:center;"><a href="deconnexion.php">Deconnexion</a></button>

line;

}else{
    echo '<a href="index-connexion.php"><lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="loop-on-hover" colors="primary:#c76f16,secondary:#ffffff" style="width:70px;height:70px"> </lord-icon></a>';
}

?>

</div>  <!-- ----------- FIN DIV 3  ----------- -->
</div>  <!-- ----------- FIN GRIDCONTAINER  ----------- -->
 <!-- ----------- FIN HEADER DU SITE  ----------- -->

<div class="containera">  <!-- ----------- DEBUT DU CONTAINER DES CARDS  ----------- -->
 
    <?php
   
   //Je fais une requête SQL qui va permettre récupérer tout ce que contient la table POST
   // id, img, title, technologie, link
    $userid = (int)$_SESSION['userid']; // Contient l'id de l'utilisateur en cours dans la session

    //Selectionne tous les éléments de la table POST
    $post_all = $bdd->query("SELECT * from post");   

    $all_card = $post_all->fetchAll();
    //renvoit un pdo statement un objet de retour 
        
   //Le fetchAll retourne
   // [0] => 1 [img] => ../img/gigi.gif [1] => ../img/gigi.gif [title] => clone [2] => clone [technologie] => face-stretch | face-image [3] => face-stretch | face-image [link] => ../tutoriel/clone/clone.html [4] => ../tutoriel/clone/clone.html )

// Je stocke chaque élément de mon tableau dans des variables
// Que je remplacerai dans mon HTML afin de remplacer les valeurs
// La structure de langage foreach fournit une façon simple de parcourir des tableaux. 
// J'utilise un foreach psk je veux récupérer chacune des données du tableau dans l'ordre.
//  Il va chercher le premier champ, le deuxième etc..

        foreach($all_card as $card){
    //Une boucle sur le tableau sur chaque élément 
           
            $id = $card["id"]; // Contient l'id de la carde
            $img = $card["img"]; //Contient l'image de la carde
            $link = $card["link"]; // Contient le lien vers le tuto
            $tech = $card["technologie"]; // Contient les technologies utilisées
            $title = $card["title"]; // Contient le titre de la carde

            //Je stocke dans $check_like la requête SQL qui va me permettre de savoir 
            // SI LA PUBLICATION EST LIKÉ PAR L'UTILISATEUR

            $check_like = $bdd->prepare("SELECT * FROM `like` WHERE userid = ? AND postid = ?");
            $check_like->execute([$userid, $id]);
            
            //Si rowCount me renvoit 0
            // C'est que cette publication n'est pas liké
            if ($check_like->rowCount() == 0){
                
                //Donc j'affiche ma card avec un coeur vert qui est par défaut
                // et qui veut dire que ma card n'est pas liké

            echo <<<END
            
            <div class="carda">
            <div class="contenta">
                <div class="imgArt"><a href="$link"><img src="$img" alt="Logo HTML"></a></div>
                <div class="contentaArt">
                    <h3>$title</h3>
                    <h4>$tech</h4>
                    <form method="POST">
                    <input name="bouton_like" value="$id" type="hidden">
                    <button type="submit" id="post"><i class="fas fa-heart"></i></button>
                   
                    </form>
                </div>
            </div>
        </div>
END;
        } else{

    // Dans l'autre cas ou rowCount est autre que 0
    // Cela veut dire que ma publication est liké 
    // J'affiche du coup une card avec le coeur avec la classe liked CSS en rouge
    // Pour indiquer que cette publication est likée. 

            echo <<<END
            <div class="carda">
            <div class="contenta">
                <div class="imgArt"><a href="$link"><img src="$img" alt="Logo HTML"></a></div>
                <div class="contentaArt">
                    <h3>$title</h3>
                    <h4>$tech</h4>
                    <form method="POST">
                    <input name="bouton_like" value="$id" type="hidden">
                    <button type="submit" id="post"><i class="fas fa-heart liked"></i></button>
                   
                    </form>
                    
                </div>
            </div>
        </div>
END;
        }
    }
    ?>

<!-- INSERT INTO `post``img`, `title`, `technologie`, `link` VALUES "../img/gigi.gif","Album Cover","Face Strech | Face Image","../tutoriel/album-cover/album-cover.html" -->

</div>

<script src="../script/bibli.js"></script> 

</body>

</html>