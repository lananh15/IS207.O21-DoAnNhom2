let username = document.getElementById("username");
let password = document.getElementById("password");
let cfpassword = document.getElementById("confirmpassword");

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
password.addEventListener("focus",function(){
    if(password.type==='text'){
        eyeSlash[0].style.display = 'none'
        eye[0].style.display='inline';
    }
    else{
        eyeSlash[0].style.display = 'inline';
        eye[0].style.display='none';
    } 
})
password.addEventListener("blur",function(){
    if(password.value===""){
        eyeSlash[0].style.display = 'none';
        eye[0].style.display = 'none';
    }  
})
cfpassword.addEventListener("focus",function(){
    if(cfpassword.type==='text'){
        eyeSlash[1].style.display = 'none';
        eye[1].style.display='inline';
    }
    else{
        eyeSlash[1].style.display = 'inline';
        eye[1].style.display='none';
    } 
})
cfpassword.addEventListener("blur",function(){
    if(cfpassword.value===""){
        eyeSlash[1].style.display = 'none';
        eye[1].style.display = 'none';
    }  
})


// Check error of form
// include: username, email, password is valid
let cferror = document.getElementById("confirmpassword-error");
let signupBtn = document.getElementById("signup-btn");
let mailerror = document.getElementById("mail-error");
let username_error = document.getElementById("username-error");
let password_error = document.getElementById("password-error");
let email = document.getElementById("email");

// Regex of email, username, password
function isValidEmail(email) {
    var emailRegex = /([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i;
    return emailRegex.test(email);
}
function isValidUsername(username) {
    var usernameRegex=/^(?=.*[a-zA-Z])(?=.*\d).{6,18}$/;
    return usernameRegex.test(username);
}
function isValidPassword(password) {
    var usernameRegex=/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,18}$/;
    return usernameRegex.test(password);
}


function validateUsername() {
    const isUsernameValid = isValidUsername(username.value);
    if (!isUsernameValid) {
        document.getElementById("loading").style.display = "none";
        username_error.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> Username must contain 6-18 characters and only letter and number';
        let labelUsername = document.getElementById("labelusername");
        labelUsername.style.top = "-5px";
        labelUsername.style.fontSize = "13px";
        return Promise.resolve(false);
    }

    username_error.textContent = "";

    let xhttp = new XMLHttpRequest();
    return new Promise((resolve, reject) => {
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                const isUsernameAvailable = this.responseText.trim() === '';
                if (isUsernameAvailable) {
                    resolve(true);
                } else {
                    document.getElementById("loading").style.display = "none";
                    document.getElementById("username-error").innerHTML = this.responseText;
                    resolve(false);
                }
            }
        };
        xhttp.open("POST", "/IS207.O21-DoAnNhom2/app/controllers/CheckUsername.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("username=" + username.value);
    });
}

function validateEmail() {
    const isEmailValid = isValidEmail(email.value);
    if (!isEmailValid) {
        document.getElementById("loading").style.display = "none";
        mailerror.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> Invalid Email';
        let labelMail = document.getElementById("labelmail");
        labelMail.style.top = "-5px";
        labelMail.style.fontSize = "13px";
        return Promise.resolve(false);
    }

    mailerror.textContent = "";

    let xhttp = new XMLHttpRequest();
    return new Promise((resolve, reject) => {
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                if (this.responseText === '<i class="fa-solid fa-circle-exclamation"></i> Email is not registered in this website') {
                    resolve(true);
                } else {
                    document.getElementById("loading").style.display = "none";
                    mailerror.innerHTML = this.responseText;
                    resolve(false);
                }
            }
        };
        xhttp.open("POST", "/IS207.O21-DoAnNhom2/app/controllers/CheckEmail.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("email=" + email.value);
    });
}

async function validateForm() {
    let isPasswordMatch = password.value === cfpassword.value;
    if (!isPasswordMatch) {
        document.getElementById("loading").style.display = "none";
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

    const [isUsernameValid, isEmailValid] = await Promise.all([validateUsername(), validateEmail()]);
    if (!isUsernameValid || !isEmailValid) {
        return false;
    }

    return true;
}
function validatePassword(){
    const isPasswordValid = isValidPassword(password.value);
    if (!isPasswordValid){
        password_error.innerHTML = 
            '<i class="fa-solid fa-circle-exclamation"></i> Password must be 8-18 characters with letter, number and symbol';
        let labelPassword = document.getElementById("labelpassword");
        labelPassword.style.top = "-5px";
        labelPassword.style.fontSize = "13px";
        return false;
    }
    password_error.textContent = "";
}

password.addEventListener("input",validatePassword);
async function sha256(message) {
    const msgBuffer = new TextEncoder().encode(message);                    
    const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
    return hashHex;
}
signupBtn.addEventListener("click", async function(event) {
    event.preventDefault();
    document.getElementById("loading").style.display = "flex";
    if (await validateForm()) {
        const formData = new FormData(document.querySelector("form"));
        formData.delete('password');
        formData.delete('confirmpassword');

        // Hash the password and confirmation password, then add them to FormData
        const hashedPassword = await sha256(password.value);
        const hashedConfirmPassword = await sha256(cfpassword.value);
        formData.append('password', hashedPassword);
        formData.append('confirmpassword', hashedConfirmPassword);
        formData.append('signup', 'SIGNUP');

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'signup.php';
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
    else{
        document.getElementById("loading").style.display = "none";
    }
});

