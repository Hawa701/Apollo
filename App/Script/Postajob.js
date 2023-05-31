/* Input fields */

var jobtitle = document.querySelector('#job-title');
var jobposition = document.querySelector('#job-position');
var jobDesc = document.querySelector('#job-desc');
var jobpayment = document.querySelector('#job-payment');
var jobpropsal = document.querySelector('#job-proposal');
var jobdeadline = document.querySelector('#job-deadline');
var tokenrequired = document.querySelector('#job-token');
   /* Buttons  */
var clearbtn = document.querySelector('.clear');
var submitbtn = document.querySelector('.go');


function validateForm() {   
 
    const title_alert = document.querySelector('#job-title-alert');
    const position_alert =document.querySelector('#job-position-alert');
    const desc_alert = document.querySelector('#job-desc-alert');
    const payment_alert = document.querySelector('#job-payment-alert');
    const proposal_alert = document.querySelector('#job-proposal-alert'); 
    const deadline_alert = document.querySelector('#deadline-alert');
    

 
    /* Patterns */
    const textonly = /^[a-zA-Z]{1,50}$/; // Both small & capital letters  {1 -50} digit  
    const numberonly = /^[0-9]{3}$/; // only numbers 
    const textwithnumber=/^[0-9a-zA-Z]+$/ // both number or capital letters or numbers  
    let currDate = new Date()
    /* Messages */
    a = 'Please input alphabet characters only'
    n = 'Please Enter Numeric Inputs only'
    an = 'Please input alphanumeric characters only'
    let isValid = true

    if(!(textonly).test(jobtitle.value)){
        // alert('Please input alphabet characters only');
        title_alert.style.display='flex';
        isValid = false;
    }
    if(!(textonly).test(jobposition.value)){
        // alert(a);
        position_alert.style.display='flex';
        isValid = false;
    }
    if(!(textwithnumber).test(jobDesc.value)){
        // alert('Please Enter a minimum of 50 letters');
        desc_alert.style.display='flex';
        isValid = false;
    }
    if(!(numberonly).test(jobpayment.value)){
        // alert(n);
        payment_alert.style.display='flex';
        isValid = false;
    }
    if(!(numberonly).test(tokenrequired.value)){

    }
    if(!(textonly).test(jobpropsal.value)){
        // alert(n);
        proposal_alert.style.display='flex';
        isValid = false;
    }
    if(!(currDate)>=(jobdeadline.value)){
        // alert('The day You Entered Can not be the deadline');
        deadline_alert.style.display='flex';
        isValid = false;
    }
    
    return isValid
    
}

clearbtn.addEventListener('click',function(){
    jobtitle.value = ''   
     jobtitle.value = ''
     jobposition.value = '' 
     jobDesc.value = ''
     jobpayment.value = '' 
     jobpropsal.value = ''
     jobdeadline.value = '' 
     tokenrequired.value = '' 
    
})
