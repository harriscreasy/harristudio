<!-- Cette page correspond à la page bibliothèque du site
Elle contient les cards qui contiennent les tuto pour les filtre 
Chaque card a un coeur qui peut être liké et la card va vers la page favoris.php et est stocké pour la session 
Chaque information de card vient de la bdd

-->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HarriStudio - La référence des filtres Snapchat</title>
   <!-- ------ LIEN FONT AWESOME ------- -->
    <script src="https://kit.fontawesome.com/93585804ff.js" crossorigin="anonymous"></script>
    <!-- ------ LIEN FEUILLE CSS ------- -->
    <link rel="stylesheet" href="../css/bibliotheque.css">
    <!-- ------ LIEN VERS LORD ICON ANIMÉ ------- -->
    <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>
</head>

<body>
   
<?php

// On démarre une session
 session_start();

// La page bibliothèque n'est pas accessible qu'avec un compte utilisateur
// L'utilisateur doit alors s'inscrire/se connecter pour y accéder
// S'il n'y a pas de session il est rédirigé vers la page de connexion
if(!isset($_SESSION['user'])){
   
    header("Location:../php-harris/connexion.php");
}

?>

 <!-- ----------- LOGO DU SITE  ----------- -->
    
 <div class="logo">  <!-- ----------- LOGO DU SITE  ----------- -->

 
<div class="grid-container">
<div class="div1"><a href="favoris.php"><lord-icon
    src="https://cdn.lordicon.com/rjzlnunf.json"
    trigger="loop-on-hover"
    colors="primary:#ffffff,secondary:#e83a30"
    style="width:80px;height:80px">
</lord-icon></a></div>
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



  
 




</div>

 <!-- --- ICONE D'ACCÈS AUX FAVORIS--- -->
    


<div class="containera">  <!-- ----------- DEBUT DU CONTAINER DES CARDS  ----------- -->


    <!-- ----------- CARD  ----------- -->
    
    <?php
   
    // On connecte la page à la base de données avec require
        require_once "../php-harris/config.php";

   //Je fais une requête SQL qui va permettre récupérer tout ce que contient la table POST
   // id, img, title, technologie, link
        $publication = $bdd->query("SELECT * from post");
        // FetchAll Retourne un tableau contenant toutes les lignes du jeu d'enregistrements 
        $publication = $publication->fetchAll();

        // On fait un foreach pour afficher toutes les publications 
        
       
        foreach($publication as $publication){
            $userid = (int) $_SESSION['userid']; // Contient l'id de l'utilisateur en cours dans la session
            $id = $publication["id"]; // Contient l'id de la carde
            $img = $publication["img"]; //Contient l'image de la carde
            $link = $publication["link"]; // Contient le lien vers le tuto
            $tech = $publication["technologie"]; // Contient les technologies utilisées
            $title = $publication["title"]; // Contient le titre de la carde

            //Je stocke dans $check_like la requête SQL qui va me permettre de savoir 
            // Si la publication est liké ou pas
            $check_like = $bdd->prepare("SELECT * FROM `like` WHERE userid = ? AND postid = ?");
            // J'execute la requete SQL avec comme argument ? l'id de l'user et l'id de la publication
            $check_like->execute([$userid, $id]);

            //Si rowCount me renvoit 0
            // C'est que cette publication n'est pas liké
            if ($check_like->rowCount() == 0){
                //Donc j'affiche ma card avec un coeur vert qui est par défaut
                // et qui veut dire que ma card n'est pas liké
            echo <<<END
            <div postid="$id" class="carda">
            <div class="contenta">
                <div class="imgArt"><a href="$link"><img src="$img" alt="Logo HTML"></a></div>
                <div class="contentaArt">
                    <h3>$title</h3>
                    <h4>$tech</h4>
                    <i class="fas fa-heart"></i>
                    
                </div>
            </div>
        </div>
END;
        }else{

    // Dans l'autre cas ou rowCount est autre que 0
    // Cela veut dire que ma publication est liké 
    // J'affiche du coup une card avec le coeur avec la classe liked CSS en rouge
    // Pour indiquer que cette publication est likée. 

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
    ?>



<!-- INSERT INTO `post`(`img`, `title`, `technologie`, `link`) VALUES ("../img/gigi.gif","Album Cover","Face Strech | Face Image","../tutoriel/album-cover/album-cover.html") -->



   


</div>





<script src="../script/bibliotheque.js"></script>

</body>

</html>