function validateForm() {   

    /* Input fields */
    const jobtitle = document.querySelector('#job-title');
    const jobposition = document.querySelector('#job-position');
    const jobDesc = document.querySelector('#job-desc');
    const jobpayment = document.querySelector('#job-payment');
    const jobpropsal = document.querySelector('#job-proposal');
    const jobdeadline = document.querySelector('#job-deadline');

    /*  */
    
    const title_alert = document.querySelector('#job-title-alert')
    const position_alert =document.querySelector('#job-position-alert')
    const desc_alert = document.querySelector('#job-desc-alert')
    const payment_alert = document.querySelector('#job-payment-alert')
    const proposal_alert = document.querySelector('#job-proposal-alert') 
    const deadline_alert = document.querySelector('#deadline-alert')
    

    /* Buttons  */
    const clearbtn = document.querySelector('.clear');
    const submitbtn = document.querySelector('.go')

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

    if(!(textonly).match(jobtitle.value)){
        // alert('Please input alphabet characters only');
        title_alert.style.display='flex';
        isValid = false;
    }
    if(!(textonly).match(jobposition.value)){
        // alert(a);
        position_alert.style.display='flex';
        isValid = false;
    }
    if(!(textwithnumber).match(jobDesc.value)){
        // alert('Please Enter a minimum of 50 letters');
        desc_alert.style.display='flex';
        isValid = false;
    }
    if(!(numberonly).match(jobpayment.value)){
        // alert(n);
        payment_alert.style.display='flex';
        isValid = false;
    }
    if(!(textonly).match(jobpropsal.value)){
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

