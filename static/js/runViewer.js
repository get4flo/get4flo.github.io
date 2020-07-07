
var fullDiv = document.getElementById('fullviewContainer');
var overlay = document.getElementById('overlay');

function fullview(e){
	fullDiv.src = e.src;
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

