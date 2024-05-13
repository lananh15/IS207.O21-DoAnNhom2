let password=document.getElementById("password");
let eyeSlash = document.querySelector(".fa-eye-slash");
let eye = document.querySelector(".fa-eye");
function showHidePassword() {
    if (password.type == 'text'){
        password.type='password';
        eyeSlash.style.display = 'inline';
        eye.style.display='none';
    }
    else {  
        password.type='text';
        eyeSlash.style.display = 'none';
        eye.style.display = 'inline';
    }
}
password.addEventListener("focus",function(){
    if(password.type==='text'){
        eyeSlash.style.display = 'none';
        eye.style.display='inline';
    }
    else{
        eyeSlash.style.display = 'inline';
        eye.style.display='none';
    } 
})
password.addEventListener("blur",function(){
    if(password.value===""){
        eyeSlash.style.display = 'none';
        eye.style.display = 'none';
    }  
})

