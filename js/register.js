function setFormMessage (formElement, message) {
    var messageElement = formElement.querySelector("login-form-error-message");
    messageElement.textContent = message;
}
var loginForm = document.querySelector(".login-form");

loginForm.addEventListener("button", e => {
    e.preventDefault();
    
    
    
    setFormMessage(loginForm, "Invalid username/password");
})

