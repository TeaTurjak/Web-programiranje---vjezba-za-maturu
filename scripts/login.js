var attempt = 3; // Variable to count number of attempts.
// Below function Executes on click of login button.
function validate(){
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    if ( username == "Tea" && password == "test123"){
        /*alert ("Prijava je uspješna!");*/
        window.location = "homepage.html"; // Redirecting to other page.
        return false;
    }
    else{
        attempt --;// Decrementing by one.
        alert("Imate još "+attempt+" pokušaja.");
        // Disabling fields after 3 attempts.
        if( attempt == 0){
            document.getElementById("username").disabled = true;
            document.getElementById("password").disabled = true;
            document.getElementById("Login_btn").disabled = true;
            return false;
        }
    }
}

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
        document.getElementById("error-Password").innerHTML=" ";
    }
}

