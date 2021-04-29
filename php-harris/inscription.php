<!-- Cette page est le formulaire d'inscription 
Elle contient le switch qui se charge d'afficher les erreurs de l'utilisateur lors de l'inscription
Les données du formulaire sont envoyées à la page inscription_traitement -->


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harristudio</title>
    <!-- LIEN VERS LA PAGE CSS -->
    <script src="https://kit.fontawesome.com/93585804ff.js" crossorigin="anonymous"></script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
   
    <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js" defer></script>
    <link rel="stylesheet" href="../css/inscription.css">
</head>
<body>

<!-- CETTE PARTIE CONCERNE LES ERREURS DE L'UTILISATEUR -->

<?php 

if(isset($_GET['reg_err'])){

    $err = htmlspecialchars($_GET['reg_err']);

    //On utilise un switch pour référencer toutes les erreurs possibles
    // On met en paramètre du switch la variable $err 
    // Qui contient le _GET['reg_err'];

    switch($err){

        case 'success';

        header('Location:inscription-succes.php');

        ?>
        <?php
        break;

        case 'password';

        ?>

      <script>
  Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Les mots de passe ne sont pas identiques',
  footer: 'Utilisez notre générateur de mot de passe !'
})
      </script>
           
        <?php
        break;

        case 'email';

        ?>

      <script>
  Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Email est invalide',
  footer: '<a href>Why do I have this issue?</a>'
})
      </script>
          

        <?php
        break;


        // Dans le cas d'un email trop long
        case 'email_length';

        ?>
        
      
        <script>
        Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: "L'email est trop long",
  footer: '<a href>Why do I have this issue?</a>'
})
</script>
           

        <?php
        break;

        // Dans le cas d'un pseudo trop long
        case 'pseudo_length';

        ?>

       <script>
        Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: "Le pseudo est trop long",
  footer: '<a href>Why do I have this issue?</a>'
})
</script>

        <?php
        break;

        case 'already';

        ?>
  
  <script>
  Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: "Ce compte existe déjà !",
  footer: '<a href="index-connexion.php">Connectez-vous</a>'
})
</script>

        <?php
        break;


    }
}

?>

<!-- FIN DU SWITCH -->


<div class="logo"><a href="../index.php"><img src="../img/harriStudio.png" alt=""></a></div>
    
<div class="login-form">
<form action="inscription_traitement.php" method="POST">

<h1>Inscription</h1>

<div class="form-group">
<input type="text" name="pseudo" class="form-control" placeholder="pseudo" required="required" autocomplete="off">
</div>

<div class="form-group">
<input type="email" name="email" class="form-control" placeholder="email" required="required" autocomplete="off">
</div>

<div class="form-group" id="password-group">

<input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off"> 



<div class="generate-password">

<button id="btn-password-gen"><i class="fas fa-random"></i></button>
<lord-icon
    class="lordicon"
    src="https://cdn.lordicon.com/tyounuzx.json"
    trigger="click"
    colors="primary:#ffffff,secondary:#e86830"
    style="width:70px;height:70px">
</lord-icon>
</div>

<div class="form-group">
<input type="password" name="password_retype" id="password_retype" class="form-control" placeholder="Confirmez le mot de passe" required="required" autocomplete="off">
</div>

</div>


<div class="btn-inscription">
<button type="submit">Inscription</button>
</div>
</form>


<div class="btn-connexion">
<a href="#"><p class="already-sign">Déjà inscrit ?</p></a>
<a href="connexion.php"><button>Connexion</button></a>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="../script/inscription.js"></script>
</body>
</html>