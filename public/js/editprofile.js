const btnAvt = document.getElementById("btnAvt");
const input = document.getElementById("changeAvt");
let formAvt=document.getElementById("formAvt");

btnAvt.addEventListener("click", function(event) {
    event.preventDefault();
    input.click();
});
input.addEventListener("change", function() {
  if (input.files.length > 0) {
    formAvt.submit();
  }
});


const icons = document.querySelectorAll('.inputbox i');
const inputs = document.querySelectorAll('.inputbox input');
let inputbox=document.querySelectorAll('.inputbox');
inputs.forEach(input => {
    input.addEventListener('focus', function() {
        let parentBox = this.closest('.inputbox');
        if (parentBox) {
            parentBox.style.border = "1px solid #94bdff";
        }
    });

    input.addEventListener('blur', function() {
        let parentBox = this.closest('.inputbox');
        if (parentBox) {
            parentBox.style.border = "1px solid white"; 
        }
    });
});

icons.forEach(icon => {
    icon.addEventListener('click', function() {
        const input = this.previousElementSibling;
        if (input && input.focus) {
            input.focus();
        }
    });
});

// Show/Hide password
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


// Check error of form
let username=document.getElementById("username");

let username_error = document.getElementById("username-error");
let password_error = document.getElementById("password-error");

function validateInput(input){
    const inputValue = input.value.replace(/\s/g, '');
    input.value = inputValue;
    const valueLength = input.value.length;
    input.setSelectionRange(valueLength, valueLength);
}

function isValidUsername(username) {
    var usernameRegex=/^(?=.*[a-zA-Z])(?=.*\d).{6,18}$/;
    return usernameRegex.test(username);
}
function isValidPassword(password) {
    var usernameRegex=/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,18}$/;
    return usernameRegex.test(password);
}

function validateUsername(){
    const isUsernameValid = isValidUsername(username.value);
    if (!isUsernameValid) {
        document.getElementById("loading").style.display = "none";
        username_error.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> Username must contain 6-18 characters and only letter and number';
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

function validatePassword(){
    const isPasswordValid = isValidPassword(password.value);
    if (!isPasswordValid){
        password_error.innerHTML = 
            '<i class="fa-solid fa-circle-exclamation"></i> Must be 8-18 characters with letter, number and symbol @$!%*?&';
        return false;
    }
    password_error.textContent = "";
}
let originalUsername = username.value;
async function validateForm() {
    if (password_error.textContent !== '' && password.value !== '') {
        return false;
    }

    const isUsernameUnchanged = username.value === originalUsername;
    const isPasswordUnchanged = password.value === '';

    if (isUsernameUnchanged && isPasswordUnchanged) {
        return false; // Không cho phép gửi form nếu không thay đổi cả tên người dùng và mật khẩu
    }

    const [isUsernameValid] = await Promise.all([validateUsername()]);

    if (isUsernameUnchanged || isUsernameValid) {
        return true;
    }

    return false;
}
async function sha256(message) {
    const msgBuffer = new TextEncoder().encode(message);                    
    const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
    return hashHex;
}

let submitBtn=document.getElementById("submitBtn");
submitBtn.addEventListener("click", async function(event) {
    event.preventDefault();
    document.getElementById("loading").style.display = "flex";
    if (await validateForm()) {
        const formData = new FormData(document.getElementById("profileform"));
        formData.delete('password');

        // Hash the password and confirmation password, then add them to FormData
        const hashedPassword = await sha256(password.value);
        formData.append('password', hashedPassword);
        formData.append('submitBtn', 'SUBMIT');

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'editprofile.php';
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

password.addEventListener("input",validatePassword);
password.addEventListener("focus",validatePassword);