
function isBlank(inputField){
    if(inputField.value == ""){
        return true;
    }
    else {
        return false;
    }
}
function makeRed(inputField){
    inputField.style.border = " 1px solid #AA0000";
}
function cleanBorder(inputField){
    inputField.style.border = "1px solid #FFFFFF";
}

function checkPasswordMatch(e){

     var passwordField = document.getElementById("password-register");
     var passwordCheckField = document.getElementById("passwordCheck-register");

     var password = passwordField.value;
     var passwordCheck = passwordCheckField.value;

     var err = false;

     if(password != passwordCheck){
          err = true;
     }

     if(err == true){
      makeRed(passwordField);
      makeRed(passwordCheckField);
      window.alert("Passwords do not match! Please try again");
      e.preventDefault();
     }
     else {
      console.log("Matching check valid");
     }
  }

document.getElementById("register-form").onsubmit = function(e){
    var required = document.querySelectorAll(".register-required");
    var error = false;

    for(var i = 0; i < required.length; i++){
        if(isBlank(required[i]) == true){
           error = true
           makeRed(required[i]);
        }
        else {
           cleanBorder(required[i]);
        }

    }
    if(error == true){
        e.preventDefault()
    }
    else {
        checkPasswordMatch(e);
    }
}

document.getElementById("login-form").onsubmit = function(e){
    var required = document.querySelectorAll(".login-required");
    var error = false;

    for(var i = 0; i < required.length; i++){
        if(isBlank(required[i]) == true){
            error = true
            makeRed(required[i]);
        }
        else {
            cleanBorder(required[i]);
        }
    }
    if(error == true){
        e.preventDefault()
    }
    else {
        //Login in
    }
}