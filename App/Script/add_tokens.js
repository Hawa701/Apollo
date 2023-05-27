let customOption = document.querySelector('#custom-amount');
let selectElement = document.querySelector('#amount-to-buy'); 
let inputAmount = document.querySelector('#input-custom-amount');
let tokenWrap = document.querySelector('.token-wrap');
let myInput = document.querySelector('.input');
let accountCharge = document.querySelector('#amoutCharged');
var selectedValue;

let accountBalance = document.querySelector('#accountBalance');
let expireDate = document.querySelector('#expireDate');

var d = new Date();
expireDate.innerHTML = d.getDate()+'/'+(parseInt(d.getMonth())+1)+'/'+ (parseInt(d.getFullYear())+1); // +1 on the month because getMonth() returns zero base index

function showCustom(e){
  selectedValue = selectElement.value;
    
  if(selectedValue === 'custome') {
          myInput.style.display = 'block';
          tokenWrap.style.height = '700px';
        } 
        else {
          myInput.style.display = 'none';
          tokenWrap.style.height = '620px';

          accountCharge.innerHTML = (parseInt(e.target.value)*7.5)+' bir';

        }
}


function changeStyle(e){ // to change the style of account Charge, Token balance, Token expire date
  e.style.fontWeight = "300";
  e.style.fontSize = "13px";
  e.style.padding = "5px 8px";
}


changeStyle(accountCharge);
changeStyle(expireDate);
changeStyle(accountBalance);


window.onload =  function() {

  // inputAmount.value = "";

  selectElement.addEventListener('change', function(e) {
    showCustom(e);
    
});

  inputAmount.addEventListener('keyup',function(e){
    accountCharge.innerHTML = (parseInt(e.target.value)*7.5) + ' bir';
  })

}


