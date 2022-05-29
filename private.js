document.querySelector('#pencil_email').addEventListener('click',changeEmail);
document.querySelector('#pencil_username').addEventListener('click',changeUsername);
document.querySelector('#new_email img').addEventListener('click',closeEmail);
document.querySelector('#new_username img').addEventListener('click',closeUsername);

const form_mail = document.querySelector('#new_email');
const form_username = document.querySelector('#new_username');

function changeEmail(event){
    form_mail.classList.remove('hidden');
}

function changeUsername(event){
    form_username.classList.remove('hidden');
}

function closeEmail(event){
    form_mail.classList.add('hidden');
}

function closeUsername(event){
    form_username.classList.add('hidden');
}

document.querySelector("#new_username input").addEventListener('blur',checkNewUser);
document.querySelector("#new_email input").addEventListener('blur',checkNewEmail);

function checkNewEmail(event){
    const Emailinput =event.currentTarget;
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(Emailinput.value).toLowerCase())){
        document.querySelector('#new_email span').textContent = "Email non valida";
        event.preventDefault();
    }else{
        document.querySelector('#new_email span').textContent = "";
    }
}

function checkNewUser(event){
    const Userinput=event.currentTarget;
    if(!/^[a-zA-Z0-9_]{1,15}$/.test(Userinput.value)){
        document.querySelector('#new_username span').textContent = "Username non valido";
        event.preventDefault();
    }else{
        document.querySelector('#new_username span').textContent = "";
    }
}