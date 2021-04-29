<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harristudio - Le site de référence pour faciliter la vie des développeurs.</title>
    <script data-ad-client="ca-pub-3892280038431648" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
     <!-- ----------- LIEN POUR FONT AWESOME  ----------- -->
    <script src="https://kit.fontawesome.com/93585804ff.js" crossorigin="anonymous"></script>
    <!-- ----------- LIEN POUR LA FEUILLE CSS STYLE.CSS  ----------- -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="img/HS-removebg-preview.png" />

    <script src="https://apps.elfsight.com/p/platform.js" defer></script>

     <!-- ----------- LIEN POUR LA FEUILLE CSS STYLE.CSS  ----------- -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.0/gsap.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/ScrollTrigger.min.js" defer></script>
    <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js" defer></script>	 
    <script src="script/main.js" defer></script>
    <!-- ----------- FIN DU HEAD  ----------- -->
    
</head>

<body>
    <!-- ----------- DEBUT DU BODY  ----------- -->

    
    <div class="logo">  <!-- ----------- LOGO DU SITE  ----------- -->

 
    <div class="grid-container">
  <div class="div1"> </div>
  <div class="div2">  <a href="index.php"><img src="img/harriStudio.png" alt="Dev Cheat Code"></a><!-- ----------- LOGO DU SITE  ----------- --></div>
  <div class="div3">  

  <?php

session_start();

    if(!isset($_SESSION['user'])){
        echo '<a href="php-harris/index-connexion.php"><lord-icon class="lordicon" src="https://cdn.lordicon.com/dxjqoygy.json" trigger="loop-on-hover"  colors="primary:#c76f16,secondary:#ffffff"> </lord-icon></a>';
    }
?>


        <?php

if(isset($_SESSION['user'])){
    $username = $_SESSION['user'];
    $userid = $_SESSION['userid'];
    echo <<<line
<div class="user">
<h1 style="color: white; text-align:center;">$username</h1>

</div>

<button style="text-align:center;"><a href="php-harris/deconnexion.php">Deconnexion</a></button>
line;
}


?>
</div>
</div>

    </div>

    <div class="presentation">  <!-- ----------- PRESENTATION DU SITE  ----------- -->
        <h1>HarriStudio est le site de référence <br> pour la création de filtre Snapchat</h1>
    </div>

    <div class="containera">  <!-- ----------- DEBUT DU CONTAINER DES CARDS  ----------- -->


        <!-- ----------- CARD STARTER PACK  ----------- -->

        <div class="carda">
            <div class="contenta">
                <div class="imgArt"><a href="html/starterpack.html"><img src="img/starterpack.jpg" alt="Image Press Start"></a></div>
                <div class="contentaArt">
                    <h3>Starter Pack</h3>
                </div>
            </div>
        </div>


        <!-- ----------- CARD LANGUAGE  ----------- -->

        <div class="carda">
            <div class="contenta">
                <div class="imgArt"><a href="html/apprendre.html"><img src="img/langage-gif.gif" alt="Gif d'une personne en train de coder"></a></div>
                <div class="contentaArt">
                    <h3>Apprendre</h3>
                </div>
            </div>
        </div>



 <!-- ----------- CARD OUTILS  ----------- -->

 <div class="carda">
    <div class="contenta">
        <div class="imgArt"><a href="html/inspiration.html"><img src="img/outil-logo.png" alt="Photo d'un outil"></a></div>
        <div class="contentaArt">
            <h3>Outils</h3>
        </div>
    </div>


</div>


<div class="carda">
    <div class="contenta">
        <div class="imgArt"><a href="php-harris/bibli.php"><img src="img/librairy-logo.jpg" alt="Photo d'une bibliothèque"></a></div>
        <div class="contentaArt">
            <h3>Bibliothèques</h3>
        </div>
    </div>


</div>



   
    </div>  <!-- ----------- FIN CONTAINERA  ----------- -->   
    


    <div class="mes-creations">  <!-- ----------- PRESENTATION DU SITE  ----------- -->
        <h1>Mes dernières créations</h1>
    </div>

    <div class="containera">  <!-- ----------- DEBUT DU CONTAINER DES CARDS  ----------- -->


        <!-- ----------- CARD STARTER PACK  ----------- -->

        <div class="carda">
            <div class="contenta">
                <div class="imgArt"><a href="html/starterpack.html"><img src="img/gigi.gif" alt="Logo HTML"></a></div>
                <div class="contentaArt">
                    <h3>clone</h3>
                </div>
            </div>
        </div>


        <!-- ----------- CARD LANGUAGE  ----------- -->

        <div class="carda">
            <div class="contenta">
                <div class="imgArt"><a href="html/apprendre.html"><img src="img/gigi.gif" alt="Logo HTML"></a></div>
                <div class="contentaArt">
                    <h3>ovni</h3>
                </div>
            </div>
        </div>



 <!-- ----------- CARD OUTILS  ----------- -->

 <div class="carda">
    <div class="contenta">
        <div class="imgArt"><a href="/html/inspiration.html"><img src="img/gigi.gif" alt="Photo Pnl"></a></div>
        <div class="contentaArt">
            <h3>Chill Cat</h3>
        </div>
    </div>


</div>


<div class="carda">
    <div class="contenta">
        <div class="imgArt"><a href="/html/inspiration.html"><img src="img/gigi.gif" alt="Photo Pnl"></a></div>
        <div class="contentaArt">
            <h3>Client Fidèle</h3>
        </div>
    </div>


</div>



   
    </div>  <!-- ----------- FIN CONTAINERA  ----------- -->   


    
    <div class="elfsight-app-76d4e0dc-44c5-4c2e-9a9a-0082f9d2d149"></div>

   

</body>

</html>