let customOption = document.querySelector('#custom-amount');
let selectElement = document.querySelector('#amount-to-buy'); 
let inputAmount = document.querySelector('#input-custom-amount');
let tokenWrap = document.querySelector('.token-wrap');
let myInput = document.querySelector('.input');
let accountCharge = document.querySelector('#amoutCharged');
var selectedValue;
let availableTokens = document.querySelector('#avilable-tokens');

let accountBalance = document.querySelector('#accountBalance');

// expire date script
let expireDate = document.querySelector('#expireDate');
var d = new Date();
expireDate.innerHTML = d.getDate()+'/'+(parseInt(d.getMonth())+1)+'/'+ (parseInt(d.getFullYear())+1); // +1 on the month because getMonth() returns zero base index
// expire date script end

// when clicked custom amount from the drop down list, it should display custom amount input
function showCustom(e){
  selectedValue = selectElement.value;
    
  if(selectedValue === 'custome') {
          myInput.style.display = 'block';
          tokenWrap.style.height = '700px';
        } 
        else {
          myInput.style.display = 'none';
          tokenWrap.style.height = '620px';

          accountCharge.innerHTML = (parseInt(e.target.value)*7.5) + ' bir';
        }
}


// to change the style of account Charge, Token balance, Token expire date
function changeStyle(e){ 
  e.style.fontWeight = "300";
  e.style.fontSize = "13px"; 
  e.style.padding = "5px 8px";
}

changeStyle(accountCharge);
changeStyle(expireDate);
changeStyle(accountBalance);


// new token amount calculator
function newToken(e){
    let avilAmount = parseInt(availableTokens.textContent);
    accountBalance.innerHTML = (parseInt(e.target.value)+parseInt(avilAmount)) + ' Tokens';
}

window.onload =  function() {

  // inputAmount.value = "";

  selectElement.addEventListener('change', function(e) {
    showCustom(e); 

    newToken(e);
  });


  inputAmount.addEventListener('keyup',function(e){
    accountCharge.innerHTML = (parseInt(e.target.value)*7.5) + ' bir';
   
    newToken(e);
  })


} // on load end



