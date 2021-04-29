<!-- Cette page s'occupe de traiter les données envoyés par le formulaire d'inscription -->

<?php

// Je connecte la BDD
require_once 'config.php';

// Je vérifie que les input du formulaire existe bien
if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_retype'])){

// Je stocke le contenu des input dans des variables
// Et les sécurisent
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password_retype = htmlspecialchars($_POST['password_retype']);


// Dans la variable $check je prepare une requête SQL qui me permet de vérifier
// dans ma base de données 
// L'EMAIL DE L'UTILISATEUR EXISTE T-IL DÉJÀ ?
// POUR VÉRIFIER SI IL EST DÉJÀ MEMBRE D'HARRISTUDIO AVEC SON MAIL 
$check_mail = $bdd->prepare('SELECT pseudo, email, password FROM user_harristudio WHERE email = ?');
// Le ? est un paramètre de position, je le remplacerai par la variable dans mon tableau en executant ma reqûete
$check_mail->execute(array($email));


$fetch_check_mail = $check_mail->fetch();

$row_check_mail = $check_mail->rowCount(); 

// Si Rowcount compte 0 lignes dans mon tableau fetch
// Mon utilisateur n'est pas inscrit
if($row_check_mail == 0){

    if(strlen($pseudo) <= 100){ //Le pseudo ne doit pas dépasser pas 100 caractères.
     
        if(strlen($email) <= 100){ //L'email ne doit pas dépasser pas 100 caractères.
            
                if($password == $password_retype){ //Le mot de passe = Confirmer son mot de passe

                    $password = hash('sha256', $password); //J'hache avec l'algorithme le mot de passe de l'utilisateur
                
                    $ip = $_SERVER['REMOTE_ADDR'];
                    // Récupère l'adresse IP du client

                    // Je lance la requête qui insera l'utilisateur dans ma base de données.
                    $insert_user = $bdd->prepare('INSERT INTO user_harristudio(pseudo, email, password, ip) VALUES(:pseudo, :email, :password, :ip)');
                    $insert_user->execute(array(
                   
                    // Le tableau associatif permet de pouvoir cibler exactement chaque élément
                    // à insérer dans ma base de données par mes variables sécurisées.

                        'pseudo' => $pseudo,
                        'email' => $email, 
                        'password' => $password,
                        'ip' => $ip 

                    ));

                    header('Location:inscription.php?reg_err=success');
                    // J'utilise des paramètres pour renvoyer à ma page inscription 
                    // la condition qui n'est pas respectée et donc le nom de l'erreur.
                    
                } else header('Location:inscription.php?reg_err=password');
                    
        } else header('Location:inscription.php?reg_err=email_length');

    } else header('Location:inscription.php?reg_err=pseudo_length');

} else header('Location:inscription.php?reg_err=already');

}


?>