<?php 
//On démarre une session
session_start();

//Lien vers la base de données
require_once 'config.php';

    //Si il n'y a pas de session valide on dirige vers la page de connexion
    if(!isset($_SESSION['userid'])){ 
        header("Location: index-connexion.php");
    }else{
        //si la valeur "post" envoiyer par le navigateur et accessible et lisible alors on continue
        if (isset($_POST["post"])){ 
            $postid = (int)$_POST["post"];

        //
            /*
                je convertie ma valeur en interger pour faire en sorte
                1. d'eviter les injection sql
                2. de garantir que l'utilisateur a bien a mis un ID a place de string
                
                si l'utilisateur avait mis une chaine de charactere, il seras tranformer en 1
            */
        }else{
            exit;
        }
        //Pour le texte htmlspecialchars
        // C'est l'équivalent avec int pour éviter les injections
        //On récupére l'user id de la Session
        $userid = (int) $_SESSION['userid'];

        //Pour éviter les erreurs de syntaxe

      
        
        //Vérification pour pas que l'utilisateur like la même publication.
        $check_like = $bdd->prepare("SELECT * FROM `like` WHERE userid = ? AND postid = ?"); 
        //La variable check_like contient la requête SQL
        // Qui selectionne tout de Like dans les champs userid et postid
        //C'est à dire le numéro d'id de l'user 
        // et le numéro d'id du post liké
        $check_like->execute([$userid, $postid]); 
        // On execute la requête en changeant les ? par les valeurs récupérées.
        //envoie la requete avec les données securise, en changeant les "?" avec les valeur dans l'ordre du tableau

//verifie si un l'utilisateur a deja liker la publication, 
//si il y a plus de 0 ligne retourne, sa veux forcement dire q'il a deja liker

// Si check_like qui contient la requête SQL qui permet de vérifier si l'utilisateur a déjà liké 
// est égal à 0 celà veut dire que l'utilisateur n'a pas liké cette publication.
//Retourne le nombre de lignes affectées par le dernier appel à la fonction PDOStatement::execute() 
        if ($check_like->rowCount() == 0){ 
            
            // On prépare la requête SQL dans la table like 
            // En insérant le numéro d'userid et le numéro du post.
            $liker = $bdd->prepare("INSERT INTO `like`(userid, postid) VALUES(?, ?)");
            // On exécute la requête SQL 
            $liker->execute(array($userid, $postid));
            // Le statut JSON devient alors "liked" puisque qu'on insère dans la table like
            echo json_encode(["likestatus" => "liked", "likeid" => $postid]);
        }else{

            // Sinon on supprime le champ dans la table like 
            // avec le numéro userid et postid 
            // Car l'utilisateur aura déjà liké cette publication donc il voudra la supprimer
            // On utilise donc DELETE pour supprimer le champ
            $liker = $bdd->prepare("DELETE FROM `like` WHERE userid = ? AND postid = ?");
            $liker->execute(array($userid, $postid));
            // Le statut JSON passe alors à notlike pour le numéro de post adequat.
            echo json_encode(["likestatus" => "notliked", "likeid" => $postid]);
        }
        
    }
?>