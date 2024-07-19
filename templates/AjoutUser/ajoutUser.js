"use strict";

let inputUser = document.getElementById("user"),
    inputPassword = document.getElementById("password"),
    inputEmail = document.getElementById("email"),
    inputFonction = document.getElementById("fonction");

let msgUser = document.querySelector("input#user+span"),
    msgPassword = document.querySelector("input#password+span"),
    msgEmail = document.querySelector("input#email+span"),
    msgFonction = document.querySelector("input#fonction+span");

let patternMail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
    patternPassword = /^^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[@*%!\-_\+\$]).{6,}$/,
    patternUser = /^[A-Z][a-zéèàïâëêô]{2,29}$/,
    patternFonction =/^[A-Za-zéèàïâëêç]{3,30}|[A-Za-zéèàïâëêç]{3,30}[\s]*[A-Za-zéèàïâëêç]{3,30}$/;


    inputUser.addEventListener("input",()=>{

        if(!(patternUser.test(inputUser.value))){
            msgUser.classList.replace("valid","error");
            msgUser.classList.add("error");
            msgUser.innerHTML = "Veuillez mettre une majuscule et au moins 2 caractères";
        }
        else{
            msgUser.classList.replace("error","valid");
            msgUser.innerHTML = "Nom d'utilisateur valide";
        }
        
    });

    inputPassword.addEventListener("input",()=>{
        if(!(patternPassword.test(inputPassword.value))){
            msgPassword.classList.replace("valid","error");
            msgPassword.classList.add("error");
            msgPassword.innerHTML = "mot de passe invalide";
        }
        else{
            msgPassword.classList.replace("error","valid");
            msgPassword.innerHTML = "mot de passe valide";
        }
    });

    inputEmail.addEventListener("input",()=>{
        if(!(patternMail.test(inputEmail.value))){
            msgEmail.classList.replace("valid","error");
            msgEmail.classList.add("error");
            msgEmail.innerHTML = "email invalide";
        }
        else{
            msgEmail.classList.replace("error","valid");
            msgEmail.classList.add("valid");
            msgEmail.innerHTML = "email valide";
        }
    });

    inputFonction.addEventListener("input",()=>{
        if(!(patternFonction.test(inputFonction.value))){
            msgFonction.classList.replace("valid","error");
            msgFonction.classList.add("error");
            msgFonction.innerHTML = "fonction invalide";
        }
        else{
            msgFonction.classList.replace("error","valid");
            msgFonction.classList.add("valid");
            msgFonction.innerHTML = "fonction valide";
        }
    });

    




    