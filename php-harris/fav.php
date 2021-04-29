<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dev Cheat Code - Le site de référence pour faciliter la vie des développeurs.</title>
    <!-- ------ LIEN BOOTSTRAP ------- -->
    <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js" defer></script>
    <script src="https://kit.fontawesome.com/93585804ff.js" crossorigin="anonymous"></script>
    <!-- ------ LIEN FEUILLES CSS ------- -->
   
    <link rel="stylesheet" href="../css/bibliotheque.css">
</head>

<body>

<?php

//je demarre la session
 session_start(); 

 //Verification si il y a une session valide sinon, redirection vers la page de connexion
if(!isset($_SESSION['user'])){ 
   
    header("Location:connexion.php");

} else {

$username = $_SESSION['user'];
$userid = $_SESSION['userid']; //recuperation de l'id utilisateur stocker dans la variable session au login

}
?>
   

<div class="logo">  <!-- ----------- LOGO DU SITE  ----------- -->

 
<div class="grid-container">
<div class="div1"><a href="bibli.php">
<lord-icon
    src="https://cdn.lordicon.com/wxnxiano.json"
    trigger="hover"
    colors="primary:#ffffff,secondary:#e86830"
    style="width:80px;height:80px">
</lord-icon>
</a></div>
<div class="div2">  <a href="../index.php"><img src="../img/harriStudio.png" alt="Dev Cheat Code"></a><!-- ----------- LOGO DU SITE  ----------- --></div>
<div class="div3">  


    <?php

if(isset($_SESSION['user'])){

echo <<<lol
<div class="user">
<h1 style="color: white; text-align:center;">$username</h1>

</div>

<button style="text-align:center;"><a href="deconnexion.php">Deconnexion</a></button>
lol;
} else{
    echo '<a href="php-harris/index-connexion.php"><lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="loop-on-hover" colors="primary:#c76f16,secondary:#ffffff" style="width:70px;height:70px"> </lord-icon></a>';
}
?>

</div>
</div>

<div class="containera">  <!-- ----------- DEBUT DU CONTAINER DES CARDS  ----------- -->


    <!-- ----------- CARD STARTER PACK  ----------- -->
    
    <?php


        //definition de la variable qui comptera le nombre de posts trouvés et affichés
        $post_finded = 0;
        
        //Chargement du fichier de connexion à la base de données
        require_once "../php-harris/config.php"; 
        
        //utilise query() pour faire une requete directe 
        //query execute directement une requête SQL
        //$publication contient les éléments de la table post
        $publication = $bdd->query("SELECT * from post");
        // FetchAll Retourne un tableau contenant toutes les lignes du jeu d'enregistrements 

        $all_card = $publication->fetchAll();


        // print_r($all_card);
   //Le fetchAll retourne
   //  1 [0] => 1 [img] => ../img/gigi.gif [1] => ../img/gigi.gif [title] => clone [2] => clone [technologie] => face-stretch | face-image [3] => face-stretch | face-image [link] => ../tutoriel/clone/clone.html [4] => ../tutoriel/clone/clone.html )

        foreach($all_card as $card){
            $userid = (int) $_SESSION['userid']; // Contient l'id de l'utilisateur en cours dans la session
            $id = $card["id"]; // Contient l'id de la carde
            $img = $card["img"]; //Contient l'image de la carde
            $link = $card["link"]; // Contient le lien vers le tuto
            $tech = $card["technologie"]; // Contient les technologies utilisées
            $title = $card["title"]; // Contient le titre de la carde

// dans la variable check_like on séléctionne tout dans la table like 
            $check_like = $bdd->prepare("SELECT * FROM `like` WHERE userid = ? AND postid = ?");
// On execute
// Ma table like je crée une table like avec userid et postid et je crée des clés étrangères pour dire qu'user id fera référence à l'id de la table user_harristudio
// et postid fera reférence à l'id dans la table dans post

            $check_like->execute([$userid, $id]);
// PDOStatement Object ( [queryString] => SELECT * FROM `like` WHERE userid = ? AND postid = ? ) PDOStatement Object ( [queryString] => SELECT * FROM `like` WHERE userid = ? AND postid = ? ) 

    
            if ($check_like->rowCount() > 0){
                // On incrémente post_finded donc 
                //$post_finded qui est égal à 0 sera égal à 1 pour une publication
                $post_finded++;
            echo <<<END
            <div postid="$id" class="carda">
            <div class="contenta">
                <div class="imgArt"><a href="$link"><img src="$img" alt="Logo HTML"></a></div>
                <div class="contentaArt">
                    <h3>$title</h3>
                    <h4>$tech</h4>
                    <i class="fas fa-heart liked"></i>
                    
                </div>
            </div>
        </div>
END;

        } 

        }

        if ($post_finded == 0){
            echo '<h2 style="color:white;">Vous n\'avez aucun favoris </h2>';
                  //break; 
        }
    ?>



</div>

<script src="../script/bibliotheque.js"></script>

</body>

</html>