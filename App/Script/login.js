





    const texts = document.querySelector('#texts');
    const password = document.querySelector('#password');
    const loginbtn = document.querySelector('#loginbtn');
    let emailpattern = new RegExp('[a-zA-Z0-9]+@[a-z]+\.[a-z]{2,3}');// email pattern that uses small & capital letter & . & @
    
    
/*     
loginbtn.addEventListener('click', function(e) {
        if(!emailpattern.test(texts.value) || texts.value == ''){
            alert ('Incorrect email ')
            e.preventDefault();
        }
        if(password.value == ''){
            alert ('Incorrect password')
            e.preventDefault();
        }
        
})   
 */    




 // password toggle
 const icon = document.querySelector('#togglePassword');
 
 icon.addEventListener('click', function () {
    if (password.getAttribute('type') === 'password'){
        password.setAttribute('type', 'text');
        icon.style.color='#000'   
    }
    else{
        password.setAttribute('type', 'password');
        icon.style.color='#737373'
    } 
    
});