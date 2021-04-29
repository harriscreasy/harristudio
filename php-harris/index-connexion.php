<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Harristudio</title>
    <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="stylesheet" href="../css/index-connexion.css">
</head>
<body>


<div class="logo"><a href="../index.php"><img src="../img/harriStudio.png" alt=""></a></div>
    
<div class="login-form">


<!-- CETTE PARTIE CONCERNE LES ERREURS DE L'UTILISATEUR -->

<?php 


if(isset($_GET['login_err'])){

    $err = htmlspecialchars($_GET['login_err']);

    switch($err)
{
    case 'password';
    ?>
   
    <script>

 Swal.fire(
  'Mot de passe incorrect',
  'Veuillez réessayer',
  'error'
)
    </script>



    <?php
    break;


        case 'email';
    ?>

<script>
        Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Email incorrect',
  footer: '<a href>Réessayer</a>'
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
  text: "Ce compte n'existe pas",
  footer: '<a href="inscription.php">Inscrivez-vous</a>'
})
    </script>
<?php
break;
}

}

?>


<!-- FIN DU SWITCH -->

<form action="connexion.php" method="POST">
<!-- Envoie les données se faire traiter à connexion.php -->

<h2>Connexion</h2>

<div class="form-group">
<input type="email" id="email" onChange="updateClass(this);" name="email" class="form-control" placeholder="email" required="required" autocomplete="off">
</div>



<div class="form-group">
<input type="password" onChange="updateClass(this);" id="password" name="password" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
</div>

<div class="password-show">
<lord-icon
    class="lordicon"
    src="https://cdn.lordicon.com/tyounuzx.json"
    trigger="click"
    colors="primary:#ffffff,secondary:#e86830"
    style="width:70px;height:70px">
</lord-icon>

</div>


<div class="form-group-link">

<div class="connexion-link">
<button type="submit">Connexion</button>
</div>
</div>


</form>

<div class="inscription-link">
    <a href="inscription.php"><button>S'inscrire</button></a>
</div>

</div>

</div>

<script src="../script/index-connexion.js"></script>
</body>
</html>