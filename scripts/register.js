function validateRegUserNameForm(){
    var name=document.getElementById("regname").value;
    if(name == null || name == ""){
        document.getElementById("error-Username").innerHTML="Korisničko ime mora biti upisano";
      
    }
   
}

function validateRegEmailForm(){
    var name=document.getElementById("regemail").value;
    if(name == null || name == ""){
        document.getElementById("error-Email").innerHTML="E-mail polje mora biti upisano";
      
    }
   
}

function validateRegPasswordForm(){
    var password = document.getElementById("regpass").value;
    if(password == null || password == ""){
        document.getElementById("error-Password").innerHTML="Lozinka mora biti upisana";
    }
}

function validateRegPasswordAgainForm(){
    var password = document.getElementById("regpassagain").value;
    if(password == null || password == ""){
        document.getElementById("error-PasswordAgain").innerHTML="Ponovljena lozinka mora biti upisana";
    }
}

