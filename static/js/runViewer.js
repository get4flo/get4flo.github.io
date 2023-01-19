
var fullDiv = document.getElementById('fullviewContainer');
var overlay = document.getElementById('overlay');

function fullview(e){
	var value = e.src
	var offset1 = value.includes("localhost") ? 32 : 45;
	var offset2 = value.includes("localhost") ? 44 : 57;
	value = value.substring(0, offset1) + "/fullview/" + value.substring(offset2, value.length);
	value = value.replace("jpg", "JPG")
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

