/* function showAlert(alertMessage) {
    const alertBox = document.createElement("div");
    alertBox.classList.add("alert");
  
    const alertText = document.createTextNode(alertMessage);
    alertBox.appendChild(alertText);
  
    const closeBtn = document.createElement("span");
    closeBtn.classList.add("closebtn");
    closeBtn.innerHTML = "&times;";
    closeBtn.addEventListener("click", function() {
      alertBox.style.display = "none";
    });
    alertBox.appendChild(closeBtn);
  
    document.body.appendChild(alertBox);
} */

function validateForm() {
    const usernameInput = document.getElementById("username");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm-password");
    const agreeCheckbox = document.getElementById("privacy-policy");
  
    const emailPattern = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
    // one or more lowercase letters, digits, dots, underscores, percent signs, plus signs, or hyphens, representing the local part of the email address
    // "@" symbol
    // one or more lowercase letters, digits, dots, or hyphens, representing the domain name (excluding the top-level domain)
    // period after the domain name
    //  two or more lowercase letters, representing the top-level domain (e.g., "com", "org", "net", etc.)

    const usernamePattern = /^[a-zA-Z0-9_]{3,20}$/;
    //  user-Name must contain only letters, numbers, and underscores, and is between 3 and 20 characters long.

    const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+~\-=`{}[\]:";'<>?,.\/]).{8,20}$/;
    
    // password to have at least one digit, one lowercase letter, one uppercase letter, and one special character, and to be between 8 and 20 characters long.
  
    let isValid = true;
  
    if (!usernamePattern.test(usernameInput.value)) {
       alert("Username must be between 3 and 20 characters and contain only letters, numbers, and underscores.");
       isValid = false; // prevent form submission
    }
  
    if (!emailPattern.test(emailInput.value)) {
       alert("Invalid email address!");
       isValid = false; // prevent form submission
    }
  
    if (!passwordPattern.test(passwordInput.value)) {
       alert("Password must be between 8 and 20 characters and contain at least one digit, one lowercase letter, one uppercase letter, and one special character.");
       isValid = false; // prevent form submission
    }

    if (passwordInput.value !== confirmPasswordInput.value) {
        alert("Passwords do not match!");
        isValid = false; // prevent form submission
      }
  
    if (!agreeCheckbox.checked) {
        alert("Please agree to the terms and conditions");
        isValid = false; // prevent form submission
    }
  
    return isValid;
}
 // password toggle
const togglePassword = document.querySelector('#togglePassword1');
const password = document.querySelector('#password');

togglePassword.addEventListener('click', function () {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});


// confirm password toggle
const toggleConfirmPassword = document.querySelector('#togglePassword2');
const confirmPassword = document.querySelector('#confirm-password');

toggleConfirmPassword.addEventListener('click', function () {
    // toggle the type attribute
    const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmPassword.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});