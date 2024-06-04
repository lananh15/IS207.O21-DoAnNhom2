let password = document.getElementById("newpassword");
let cfpassword = document.getElementById("confirmnewpassword");

// Prevent user type space
function validateInput(input){
    const inputValue = input.value.replace(/\s/g, '');
    input.value = inputValue;
    const valueLength = input.value.length;
    input.setSelectionRange(valueLength, valueLength);
}

// Show/Hide password function
let eyeSlash = document.querySelectorAll(".fa-eye-slash");
let eye = document.querySelectorAll(".fa-eye");
function showHidePassword() {
    if (password.type === 'text'){
        password.type='password';
        eyeSlash[0].style.display = 'inline';
        eye[0].style.display='none';
    }
    else {  
        password.type='text';
        eyeSlash[0].style.display = 'none';
        eye[0].style.display = 'inline';
    }
}
function showHideCFPassword(){
    if (cfpassword.type === 'text'){
        cfpassword.type='password';
        eyeSlash[1].style.display = 'inline';
        eye[1].style.display='none';
    }
    else {  
        cfpassword.type='text';
        eyeSlash[1].style.display = 'none';
        eye[1].style.display = 'inline';
    }
}
password.addEventListener("focus", function(){
    if(password.type === 'text') {
        eyeSlash[0].style.display = 'none';
        eye[0].style.display = 'inline';
    } 
    else {
        eyeSlash[0].style.display = 'inline';
        eye[0].style.display = 'none';
    }
});

password.addEventListener("blur", function(){
    if(password.value === "") {
        eyeSlash[0].style.display = 'none';
        eye[0].style.display = 'none';
    }
});

cfpassword.addEventListener("focus", function(){
    if(cfpassword.type === 'text') {
        eyeSlash[1].style.display = 'none';
        eye[1].style.display = 'inline';
    } 
    else {
        eyeSlash[1].style.display = 'inline';
        eye[1].style.display = 'none';
    }
});

cfpassword.addEventListener("blur", function(){
    if(cfpassword.value === "") {
        eyeSlash[1].style.display = 'none';
        eye[1].style.display = 'none';
    }
});

// Check error form
let cferror = document.getElementById("confirmpassword-error");
let submitBtn = document.getElementById("submitBtn");
let mailerror = document.getElementById("mail-error");
let password_error = document.getElementById("password-error");
let email = document.getElementById("email");

function isValidEmail(email) {
    var emailRegex = /([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i;
    return emailRegex.test(email);
}
function isValidPassword(password) {
    var usernameRegex=/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,18}$/;
    return usernameRegex.test(password);
}

function validatePassword(){
    const isPasswordValid = isValidPassword(password.value);
    if (!isPasswordValid){
        password_error.innerHTML = 
            '<i class="fa-solid fa-circle-exclamation"></i> Password must be 8-18 characters with letter, number and symbol';
        return false;
    }
    password_error.textContent = "";
}
function validateForm() {
    let isPasswordMatch = password.value === cfpassword.value;
    if (!isPasswordMatch) {
        cferror.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> The password is not matched';
        return false;
    } else {
        cfpassword.classList.remove('is-invalid');
        cfpassword.setCustomValidity('');
        cferror.textContent = "";
    }

    if (password_error.textContent !== '') {
        return false;
    }

    if (!isValidEmail(email.value)) {
        mailerror.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> Invalid email';
        return false;
    }

    mailerror.textContent = "";

    let xhttp = new XMLHttpRequest();
    return new Promise(function(resolve, reject) {
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                if (this.responseText === '<i class="fa-solid fa-circle-exclamation"></i> Email is not registered in this website') {
                    mailerror.innerHTML = this.responseText;
                    resolve(false);
                } else {
                    resolve(true);
                }
            }
        };
        xhttp.open("POST", "../controllers/CheckEmail.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("email=" + email.value);
    });
}
async function sha256(message) {
    const msgBuffer = new TextEncoder().encode(message);                    
    const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
    return hashHex;
}
password.addEventListener("input",validatePassword);
submitBtn.addEventListener("click", async function(event) {
    event.preventDefault(); 
    document.getElementById("loading").style.display = "flex";

    if (await validateForm()) {
        const formData = new FormData(document.querySelector("#form"));
        formData.delete('newpassword');
        formData.delete('confirmnewpassword');

        const hashedPassword = await sha256(password.value);
        formData.append('newpassword', hashedPassword);
        formData.append('confirmnewpassword', hashedPassword);
        formData.append('submitBtn', 'Submit');


        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'forgetpassword.php';
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
});


