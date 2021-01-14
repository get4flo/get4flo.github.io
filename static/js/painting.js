var requestButton = document.getElementById('requestButton');
var overlay = document.getElementById('request');
var clo = document.getElementById('close');
var form = document.getElementById('requestForm');

function validateForm(){
	var firstname = document.forms["myForm"]["firstname"].value;
	var lastname = document.forms["myForm"]["surname"].value;
	var email = document.forms["myForm"]["email"].value;
	var errorLabel = document.getElementById('formError');

	if(firstname.length == 0 || lastname.length == 0) {
		errorLabel.style.display = "block";
		return false;
	}
	return true;
}

function fullview(){
	overlay.style.display = "block";
}

function endFullview(){
	overlay.style.display = "none";
}

requestButton.addEventListener("click", fullview);

clo.addEventListener("click", endFullview);
