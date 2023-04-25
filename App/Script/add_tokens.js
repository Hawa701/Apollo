let customOption = document.querySelector('#custom-amount');
let selectElement = document.querySelector('#amount-to-buy'); 
let inputAmount = document.querySelector('#input-custom-amount');
let tokenWrap = document.querySelector('.token-wrap');
let myInput = document.querySelector('.input');
let accountCharge = document.querySelector('.account-charge display');
var selectedValue;

function showCustom(){
  selectedValue = selectElement.value;
    
  if(selectedValue === 'custome') {
          myInput.style.display = 'block';
          tokenWrap.style.height = '700px';
        } 
        else {
          myInput.style.display = 'none';
          tokenWrap.style.height = '620px';
        }
}


window.onload =  function() {

  selectElement.addEventListener('change', function() {
    showCustom();
});

  showCustom();
}


