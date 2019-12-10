//REGEX validering!
let mailreg = /^\w+[-+.\w]*@\w+[-\w]*[.]{1,1}[a-z]{2,4}$/;
let passreg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{5,50}$/;

// Registering 
function valreg(){
    let firstname = document.querySelector('#firstname');
    let lastname = document.querySelector('#lastname');
    let adresse = document.querySelector('#adresse');
    let phonenumber = document.querySelector('#phonenumber');
    let username = document.querySelector('#username');
    let email = document.querySelector('#email');
    let emailrepeat = document.querySelector('#emailrepeat');
    let password = document.querySelector('#password');
    let passwordrepeat = document.querySelector('#passwordrepeat');

    //Længde af navne
    let namelenght = false;
    let nametext = "";
    if(firstname.value.length >= 2 && firstname.value.length <= 255 && lastname.value.length >=2 && lastname.value.length <=255 && adresse.value.length >=2 && adresse.value.length <=255){
        namelenght = true;
    } else {
        nametext = "Firstname, lastname and adresse may only be between 2 and 255 characters. <br>";
    };

    //Telefonnummer længde
    let phonenumberlenght = false;
    let phonenumbertext = "";
    if(phonenumber.value.length >=5 && phonenumber.value.length <=15){
        phonenumberlenght = true;
    } else {
        phonenumbertext = "The phonenumber needs to be between 5 and 15 numbers. <br>";
    };

    //username længde
    let usernamelenght = false;
    let usernametext = "";
    if(username.value.length >= 1 && username.value.length <= 255){
        usernamelenght = true;
    } else {
        usernametext = "The username needs to be between 1 and 255 characters. <br>";
    }

    //Tjek emails er ens
    let emailmatch = false;
    let emailtext = "";
    if(email.value === emailrepeat.value){
        emailmatch = true;
    } else {
        emailtext = "Your email does not match. <br>";
    };

    //Tjek passwords er ens
    let passwordmatch = false;
    let passwordtext ="";
    if(password.value == passwordrepeat.value){
        passwordmatch = true;
    } else {
        passwordtext = "Your password does not match. <br>";
    };

    // REGEX validering email
    let mailresult = mailreg.test(email.value);
    if(mailresult == false){
        mailregtext = "The email is incorrect. <br>";
    }else{
        mailregtext = "";
    };

    // REGEX validering password
    let passresult = passreg.test(password.value);
    if(passresult == false){
        passregtext = "The password needs to have a lower and uppercase letters with numbers. <br>The password needs to be at least 5 characters. <br>";
    }else{
        passregtext = "";
    };

    //Stort forbokstav og resten småt
    firstname.value = firstname.value.charAt(0).toUpperCase() + firstname.value.slice(1).toLowerCase();
    lastname.value = lastname.value.charAt(0).toUpperCase() + lastname.value.slice(1).toLowerCase();
    
    //Fejl meddelselse 
    let errormsg = document.querySelector('#errormsg');
    //retunere
    if(passwordmatch == true && emailmatch == true && namelenght == true && phonenumberlenght == true && usernamelenght == true && mailresult == true && passresult == true){
        return true;
    } else {
        errormsg.innerHTML = "<span>" + emailtext + mailregtext + passwordtext + passregtext + nametext + phonenumbertext + usernametext + "</span>";
        return false;
    };
};


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//Ændring af password
function valchangepass(){
    let password = document.querySelector('#password');
    let passwordrepeat = document.querySelector('#passwordrepeat');

    //Tjek passwords er ens
    let passwordmatch = false;
    let passwordtext ="";
    if(password.value === passwordrepeat.value){
        passwordmatch = true;
    } else {
        passwordtext = "Your password does not match. <br>";
    };

    // REGEX validering password
    let passresult = passreg.test(password.value);
    if(passresult == false){
        passregtext = "The password needs to have a lower and uppercase letters with numbers. <br>The password needs to be at least 5 characters. <br>";
    }else{
        passregtext = "";
    };

    //Fejl meddelselse 
    let errormsg = document.querySelector('#errormsg');
    //retunere
    if(passwordmatch == true && passresult == true){
        return true;
    } else {
        errormsg.innerHTML = "<span>" + passwordtext + passregtext + "</span>";
        return false;
    };
};


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

//Ændring af profil informationer. 
function valchangeprofil(){
    let firstname = document.querySelector('#firstname');
    let lastname = document.querySelector('#lastname');
    let adresse = document.querySelector('#adresse');
    let phonenumber = document.querySelector('#phonenumber');
    let username = document.querySelector('#username');
    let email = document.querySelector('#email');

    //Længde af navne
    let namelenght = false;
    let nametext = "";
    if(firstname.value.length >= 2 && firstname.value.length <= 255 && lastname.value.length >=2 && lastname.value.length <=255 && adresse.value.length >=2 && adresse.value.length <=255){
        namelenght = true;
    } else {
        nametext = "Firstname, lastname and adresse may only be between 2 and 255 characters. <br>";
    };

    //Telefonnummer længde
    let phonenumberlenght = false;
    let phonenumbertext = "";
    if(phonenumber.value.length >=5 && phonenumber.value.length <=15){
        phonenumberlenght = true;
    } else {
        phonenumbertext = "The phonenumber needs to be between 5 and 15 numbers. <br>";
    };

    //username længde
    let usernamelenght = false;
    let usernametext = "";
    if(username.value.length >= 1 && username.value.length <= 255){
        usernamelenght = true;
    } else {
        usernametext = "The username needs to be between 1 and 255 characters. <br>";
    }

    // REGEX validering email
    let mailresult = mailreg.test(email.value);
    if(mailresult == false){
        mailregtext = "The email is incorrect. <br>";
    }else{
        mailregtext = "";
    };

    //Stort forbokstav og resten småt
    firstname.value = firstname.value.charAt(0).toUpperCase() + firstname.value.slice(1).toLowerCase();
    lastname.value = lastname.value.charAt(0).toUpperCase() + lastname.value.slice(1).toLowerCase();

    //Fejl meddelselse 
    let errormsg = document.querySelector('#errormsg');
    //retunere
    if(namelenght == true && phonenumberlenght == true && usernamelenght == true && mailresult == true){
        return true;
    } else {
        errormsg.innerHTML = "<span>" + nametext + phonenumbertext + usernametext + mailregtext + "</span>";
        return false;
    };
};
