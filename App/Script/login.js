function validateForm(){
    const texts = document.getElementById("texts");
    const passwordInput = document.getElementById("password");
    const alerts = document.querySelector('.alert');
    const passwordAlert = document.querySelector('#passwordAlert');
    
    let isValid=true
    if (texts.value == ''){
        UEAlert.style.display = "flex"
        UEAlert.style.display = "none"
    }

         
    if (passwordInput.value == ''){
        passwordAlert.style.display = "flex"
         passwordAlert.style.display = "none"
    }
    return isValid
}

 // password toggle
 const icon = document.querySelector('#togglePassword');
 const password = document.querySelector('#password');
 
 icon.addEventListener('click', function () {
    if (password.getAttribute('type') === 'password'){
        password.setAttribute('type', 'text');
        icon.style.color='#000'   
    }
    else{
        password.setAttribute('type', 'password');
        icon.style.color='#737373'
    } 
    
/*     const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
     password.setAttribute('type', type);
     this.classList.toggle('fa-eye-slash');
 */ });