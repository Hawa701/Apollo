var activelink = document.querySelector('#activelink');
var requestlink = document.querySelector('#requestlink');
var declinedlink = document.querySelector('#declinedlink');

var activepage = document.querySelector('#loweractive');
var requestpage = document.querySelector('#lowerrequested')
var declinedpage = document.querySelector('#lowerdeclined');



function Default(){
    activepage.style.display = 'flex';
    requestpage.style.display='none';
    declinedpage.style.display= 'none';
}


activelink.addEventListener('click',function (){

    activepage.style.display = 'flex';
    requestpage.style.display='none';
    declinedpage.style.display= 'none';
})

requestlink.addEventListener('click',function (){
    activepage.style.display = 'none';
    requestpage.style.display='flex';
    declinedpage.style.display= 'none';
})

declinedlink.addEventListener('click',function (){
    activepage.style.display = 'none';
    requestpage.style.display='none';
    declinedpage.style.display= 'flex';
})

window.onload = function(){
    Default()
}
