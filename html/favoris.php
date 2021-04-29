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
 session_start(); //je demarre la session

 //Verification si il y a une session valide sinon, redirection vers la page de connexion
if(!isset($_SESSION['user'])){ 
   
    header("Location:../php-harris/connexion.php");

}else{

$username = $_SESSION['user'];
$userid = $_SESSION['userid']; //recuperation de l'id utilisateur stocker dans la variable session au login

}
?>
   



 
<div class="grid-container">
<div class="div1"><a href="bibliotheque.php">
<lord-icon
    src="https://cdn.lordicon.com/wxnxiano.json"
    trigger="hover"
    colors="primary:#ffffff,secondary:#e86830"
    style="width:80px;height:80px">
</lord-icon>
</a></div>
<div class="div2">  <a href="index.php"><img src="../img/harriStudio.png" alt="Dev Cheat Code"></a><!-- ----------- LOGO DU SITE  ----------- --></div>
<div class="div3">  

<?php


if(!isset($_SESSION['user'])){
    echo '<a href="php-harris/index-connexion.php"><lord-icon src="https://cdn.lordicon.com/dxjqoygy.json" trigger="loop-on-hover"  colors="primary:#c76f16,secondary:#ffffff" style="width:70px;height:70px"> </lord-icon></a>';
}
?>


    <?php

if(isset($_SESSION['user'])){
$username = $_SESSION['user'];
$userid = $_SESSION['userid'];
echo <<<lol
<div class="user">
<h1 style="color: white; text-align:center;">$username</h1>

</div>

<button style="text-align:center;"><a href="php-harris/deconnexion.php">Deconnexion</a></button>
lol;
}


?>
</div>
</div>



  
 






 <!-- --- ICONE D'ACCÈS AUX FAVORIS--- -->
  

<div class="containera">  <!-- ----------- DEBUT DU CONTAINER DES CARDS  ----------- -->


    <!-- ----------- CARD STARTER PACK  ----------- -->
    
    <?php


        //definition de la variable qui comptera le nombre de posts trouvés et affichés
        $post_finded = 0;
        
        //chargement du fichier de connexion à la base de données
        require_once "../php-harris/config.php"; 
        
        //utilise query() pour faire une requete directe 
        //query execute directement une requête SQL
        //$publication contient tous les éléments de la table post
        $publication = $bdd->query("SELECT * FROM post"); 
        // dans la base de donnée quand il n'y a pas d'input de l'utilisateur 
        //stocke dans la variable $publication l'objet de reponce de pdo (PDO_STATEMENT)
        $publication = $publication->fetchAll(); 
        //fetchAll — Retourne un tableau contenant toutes les lignes du jeu d'enregistrements 
       
        //Foreach pour chaque publication
        foreach($publication as $publication){
            

            $id = $publication["id"];
            $img = $publication["img"];
            $link = $publication["link"];
            $tech = $publication["technologie"];
            $title = $publication["title"];

// dans la variable check_like on séléctionne tout dans la table like 
            $check_like = $bdd->prepare("SELECT * FROM `like` WHERE userid = ? AND postid = ?");
// On exectute
            $check_like->execute([$userid, $id]);


    // Si $check_like est supérieur à 0
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

        }else if ($check_like->rowCount() == 0){

            echo '';
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