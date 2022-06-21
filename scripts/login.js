function validateEmailForm(){
    var name=document.getElementById("username").value;
    if(name == null || name == ""){
        document.getElementById("error-Username").innerHTML="E-mail polje mora biti upisano";
      
    }
    else{
        document.getElementById("error-Username").innerHTML="";
    }
   
}


function validatePasswordForm(){
    var password = document.getElementById("password").value;
    if(password == null || password == ""){
        document.getElementById("error-Password").innerHTML="Lozinka mora biti upisana";
    }
    else{
        document.getElementById("error-Password").innerHTML="";
    }
}

