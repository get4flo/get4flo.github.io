
var fullDiv = document.getElementById('fullviewContainer');
var overlay = document.getElementById('overlay');

function fullview(e){
	var value = e.src
	value = value.substring(0, 32) + "/fullview/" + value.substring(44,value.length);
	fullDiv.src = value;
	overlay.style.display = "block";
}

function endFullview(){
	overlay.style.display = "none";
}

var pictures = document.querySelectorAll('.card-img-top');

for(i=0; i<pictures.length; i++){
	var e = pictures[i];
	e.addEventListener("click", function() {
		fullview(this);
	});
}

overlay.addEventListener("click", function(){
	endFullview();
	});

