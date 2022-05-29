const formStatus = {};
document.querySelector(".name input").addEventListener('blur',checkName);
document.querySelector(".surname input").addEventListener('blur',checkSurname);
document.querySelector(".email input").addEventListener('blur',checkEmail);
document.querySelector(".username input").addEventListener('blur',checkUser);
document.querySelector(".psw input").addEventListener('blur',checkPassword);
document.querySelector(".confirm input").addEventListener('blur',checkConfirm);
document.forms['submit'].addEventListener('submit',checkForm);


function checkName(event){
    const Nameinput=event.currentTarget;
    if(formStatus[Nameinput.name] = /^[a-zA-Z]+$/.test(Nameinput.value)){
        document.querySelector('.name span').textContent = "";
        formStatus.name = true;
    }else{
        document.querySelector('.name span').textContent = "Nome non valido"
        formStatus.name = false;
    }

}

function checkSurname(event){
        const Surnameinput=event.currentTarget;
        if(formStatus[Surnameinput.name] = /^[a-zA-Z _]+$/.test(Surnameinput.value)){
            document.querySelector('.surname span').textContent = ""
            formStatus.surname = true;
        }else{
            document.querySelector('.surname span').textContent = "Cognome non valido"
            formStatus.surname = false;
        }

    }

function checkEmail(event){
    const Emailinput=event.currentTarget;
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(Emailinput.value).toLowerCase())){
        document.querySelector('.email span').textContent = "Email non valida";
        formStatus.email = false;
    }else{
        fetch("check_email.php?q="+encodeURIComponent(String(Emailinput.value).toLowerCase())).then(fetchResponse).then(jsonCheckEmail);
    }
}

function fetchResponse(response) {
    if (!response.ok) return null;
    return response.json();
}

function jsonCheckEmail(json) {
    if (formStatus.email = !json.exists) {
        document.querySelector('.email span').textContent = "";
        formStatus.email = true;
    } else {
        document.querySelector('.email span').textContent = "Email già utilizzata";
        formStatus.email = false;
    }

}

function checkUser(event){
    const Userinput=event.currentTarget;
    if(!/^[a-zA-Z0-9_]{1,15}$/.test(Userinput.value)){
        document.querySelector('.username span').textContent = "Username non valido";
        formStatus.user = false;
    }else{
        fetch("check_user.php?q="+encodeURIComponent(String(Userinput.value).toLowerCase())).then(fetchResponse).then(jsonCheckUsername);
    }

}

function jsonCheckUsername(json) {
    if (formStatus.user = !json.exists) {
        document.querySelector('.username span').textContent = "";
        formStatus.user = true;
    }else {
        document.querySelector('.username span').textContent = "Username già utilizzato";
        formStatus.user = false;
    } 
}

function checkPassword(event){
    const passwordInput = event.currentTarget;
    if (passwordInput.value.length >= 8){
        document.querySelector('.psw span').textContent = "";
        formStatus.password = true;
    } else {
        document.querySelector('.psw span').textContent = "La password deve contenere almeno 8 caratteri";
        formStatus.password = false;
    }

}

function checkConfirm(event){
    const confirmInput = event.currentTarget;
    if(formStatus.password == true){
        if(confirmInput.value === document.querySelector('.psw input').value){
            document.querySelector('.confirm span').textContent = "";
            formStatus.confirm = true;
        }else{
            document.querySelector('.confirm span').textContent = "Le password non sono uguali";
            formStatus.confirm = false;
        }
    }else{
        document.querySelector('.confirm span').textContent = "Inserisci una password";
        formStatus.confirm = false;
    }
}

function checkForm(event){
    if(Object.keys(formStatus).length !== 6){
            document.querySelector('.submit span').textContent = "Compila tutti i campi";
            event.preventDefault();
        }else if(Object.values(formStatus).includes(false)){
            document.querySelector('.submit span').textContent = "Controlla che i campi siano corretti";
            event.preventDefault();
        }else{
        document.querySelector('.submit span').textContent = "";
        }
}