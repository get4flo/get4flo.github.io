var requestButton = document.getElementById('requestButton');
var overlay = document.getElementById('request');
var clo = document.getElementById('close');

function fullview(){
	overlay.style.display = "block";
}

function endFullview(){
	overlay.style.display = "none";
}

requestButton.addEventListener("click", fullview);

clo.addEventListener("click", endFullview);
