var myHeading = document.querySelector('h1');
var myButton = document.querySelector('button');

myButton.onclick = function(){
    setUserName();
}

if(!localStorage.getItem('name')){
    setUserName();
} else {
    var stored = localStorage.getItem('name');
    myHeading.innerHTML = "Mozilla is coll, " + stored;
}


function setUserName() {
    var name = prompt('Please enter your name.');
    localStorage.setItem('name', name);
    myHeading.innerHTML = 'Mozzila is cool, ' + name;
}