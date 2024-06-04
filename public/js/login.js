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

let loginBtn = document.getElementById("login-btn");
async function sha256(message) {
    const msgBuffer = new TextEncoder().encode(message);                    
    const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
    return hashHex;
}
loginBtn.addEventListener("click", async function(event) {
    event.preventDefault();
        const formData = new FormData(document.querySelector("form"));
        formData.delete('password');

        // Hash the password and confirmation password, then add them to FormData
        const hashedPassword = await sha256(password.value);
        formData.append('password', hashedPassword);
        formData.append('login', 'LOGIN');

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'login.php';
        form.style.display = 'none';

        for (const [key, value] of formData.entries()) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = value;
            form.appendChild(input);
        }

        document.body.appendChild(form);
        form.submit();
    }
);

