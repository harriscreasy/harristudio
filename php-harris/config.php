<?php 



try{


    // $host = getenv("DB_HOST") ? getenv("DB_HOST") : ("localhost"); // Variable pour l'host
    // $namebd = getenv("DB_NAME") ? getenv("DB_NAME") : ("full_harris_studio"); // Nom de la base de données
    // $user = getenv("DB_USER") ? getenv("DB_USER") : ("root"); // Utilisateur 
    // $mdp = getenv("DB_MDP") ? getenv("DB_MDP") : ("root"); // Mot de passe

   
    $bdd = new PDO ('mysql:host=localhost;dbname=full_harris_studio;charset=utf8', 'root', 'root');
    // $bdd = new PDO("mysql:host=$host;dbname=$namebd;charset=utf8;", $user, $mdp);

} catch(PDOException $e){     // on ecoute un erreur qui pourais etre lancer par pdo(PDOexeption) en de probleme de connexion
    //executer ce bloc de code
    die('Erreur' .$e->getMessage()); // arrete de le script et affiche erreur et le message d'erreur; recupere le message d'erreur de la variable $e avec la method getMessage().
}



?>