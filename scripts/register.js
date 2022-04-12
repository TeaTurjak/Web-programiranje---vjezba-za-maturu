function validateRegUserNameForm(){
    var name=document.getElementById("regname").value;
    if(name == null || name == ""){
        document.getElementById("error-Username").innerHTML="Name cannot be empty";
      
    }
   
}

function validateRegEmailForm(){
    var name=document.getElementById("regemail").value;
    if(name == null || name == ""){
        document.getElementById("error-Email").innerHTML="E-mail cannot be empty";
      
    }
   
}

function validateRegPasswordForm(){
    var password = document.getElementById("regpass").value;
    if(password == null || password == ""){
        document.getElementById("error-Password").innerHTML="Password cannot be empty";
    }
}

function validateRegPasswordAgainForm(){
    var password = document.getElementById("regpassagain").value;
    if(password == null || password == ""){
        document.getElementById("error-PasswordAgain").innerHTML="Password cannot be empty";
    }
}

