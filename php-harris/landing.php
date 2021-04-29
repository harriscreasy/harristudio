<?php 

session_start();


// Si l'utilisateur n'est pas connecté 
// Il sera redirigé vers index.php
if(!isset($_SESSION['user'])){
    header('Location:index.php');
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<h1>Bonjour ! <?php echo $_SESSION['user'];?></h1>
<button ><a href="deconnexion.php">Deconnexion</a></button>


</body>
</html>