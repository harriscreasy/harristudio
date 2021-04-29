let passhow = document.querySelector(".password-show");


     function updateClass(input){
          if (input.value != ""){
             
               passhow.className = "show-none";
          } else {
               
               passhow.className = "none-show";
          }
     }

     let password_hide = document.querySelector("#password");
     let toggle_show = document.querySelector(".lordicon");
     
     
     function showHide(){
         if(password_hide.type === 'password'){
             password_hide.setAttribute('type', 'text');
             
         }else {
                 password_hide.setAttribute('type', 'password');
         }
     }
     
     
     toggle_show.addEventListener("click", showHide);
     
     