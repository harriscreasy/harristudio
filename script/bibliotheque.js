let liker = new XMLHttpRequest(); 
//instacie liker avec un nouvel object XMLhttprequest(); qui sert a envoiyer requete http et recevoir des données
let likerdata = new FormData(); //instacie likerdata avec un nouvel objecct de formulaire
let reponce; //declaration de la variable qui condendras la reponce json parser. (parser = evaluer/convertie en objet)

liker.onreadystatechange = function(){
    /*
    liker a une proprieter on readystatechange,
    ce qui permet que on peux lui assigner une valeur,
    on lui aussigne donc une fonction, qui, a chaque fois que
    liker.readyState changeras, ce qui a dans cette fonction seras executer
    */

    if (liker.readyState === XMLHttpRequest.DONE){
        /*
            XMLhttporequest offre des attribut accsesible et deja definie,

            le ready state comporte 5 niveau de status de requete:

            0 = XMLHttpRequest.UNSENT => qui veux dire que on a meme pas fais de liker.open() donc pas definie de method no de url cible
            1 = XMLHttpRequest.OPENED => veux dire que liker est ouverte, qu'il y a une method et un lien cible
            2 = XMLHttpRequest.LOADING => veux dire que la liker a envoiyer la requete (liker.send()) et que le server et toujour en trains de traiter cette derniere
            3 => XMLHttpRequest.HEADERS_RECEIVED => veux dire que la code d'erreur et les en-tete de la reponce sont accesible et peuve etre utilisé
            4 => XMLHttpRequest.DONZ => qui veux dire que la requete es terminé et que la reponce est recuperable
        */
        if (liker.status === 200){ //liker.status retoure le code d'erreur de la requete, 200 = OK
            reponse = JSON.parse(liker.responseText) //parse la reponce json en objet et stocke dans la variable reponce
            // responseText renvoie le texte reçu d'un serveur suite à l'envoi d'une requête.
            
            likedpost(
                reponse.likestatus,
                reponse.likeid
            ); //apelle la fonction likedpost, qui prendras en parametre
            /*
                reponce.likestatus => qui condiendras le status du like,
                reponce.likeid => contiendras l'id du post liker/de-liker
                'liked' si le post a eter liker
                'notliked' si le post a eter de-liker
            */
        }
    }
}

let likedpost = (poststatut, card_id) => {
    if (poststatut == "liked"){
        document.querySelector(`.carda[postid='${card_id}'] > .contenta > .contentaArt > .fa-heart`).classList.add("liked");
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Ton filtre a bien été ajouté en favoris !',
            showConfirmButton: false,
            timer: 1500
          })
    }else{
        document.querySelector(`.carda[postid='${card_id}'] > .contenta > .contentaArt > .fa-heart`).classList.remove("liked");
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Ton filtre a bien été retiré!',
            showConfirmButton: false,
            timer: 1500
          })
    }
}

// Une boucle 
document.querySelectorAll(".fa-heart").forEach(like => {
    like.addEventListener("click", likeel => {
        
       likerdata.set("post", likeel.currentTarget.parentNode.parentNode.parentNode.attributes.postid?.value || "ID non défini") //replace la valeur 'post' contenu dans le formulaire likerdata et si il y a une erreur
        liker.open("POST", "../php-harris/like-traitement.php"); //ouvre la requete http avec une method de requete et la cible
        liker.send(likerdata); //envoie la requete et met le XMLreadystate a 2
        
       
     
    })
  });