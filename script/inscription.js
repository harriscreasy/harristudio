
function getPassword(){

    let chars = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN%¨*£/.?!è'"
  
    let passwordLength = 8;
    let password = "";

for (let i=0; i<passwordLength; i++){
    let randomChars = Math.floor(Math.random() * chars.length);
    password += chars.substring(randomChars,randomChars+1);
}
document.querySelector("#password").value = password;
}
let btn_password = document.querySelector("#btn-password-gen");
btn_password.addEventListener("click", getPassword);




let password_hide = document.querySelector("#password");
let toggle_show = document.querySelector(".lordicon");
let password_retype_hide = document.querySelector("#password_retype");

function showHide(){
    if(password_hide.type === 'password' && password_retype_hide.type === 'password'){
        password_hide.setAttribute('type', 'text');
        password_retype_hide.setAttribute('type', 'text');
    }else {
            password_hide.setAttribute('type', 'password');
            password_retype_hide.setAttribute('type', 'password');
    }
}
toggle_show.addEventListener("click", showHide);


