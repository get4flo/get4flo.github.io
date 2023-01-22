
var currentDate = new Date().getTime();
var startDate = new Date('2023-01-22T23:59:59').getTime();

var diff = Math.floor((currentDate - startDate) / (1000 * 60 * 60 * 24)); //diff in days
const names = ["Jo", "Alex", "Flo"];
var offset = (2 + (diff % 7)) % 3;

document.getElementById("topPlace").innerHTML = names[offset];
document.getElementById("midPlace").innerHTML = names[((offset + 1) % 3)];
document.getElementById("lowPlace").innerHTML = names[((offset + 2) % 3)];