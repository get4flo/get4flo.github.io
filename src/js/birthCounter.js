var myBirthday = new Date('2000-03-12T13:46:00').getTime();

function enDisableLifeExpectancy(){
	var element = document.getElementById("lifeExpectancyRow");
	if(element.classList.contains('d-none')){
		element.classList.remove('d-none');
	} else{
		element.classList.add('d-none');
	}
}
		
var x = setInterval( function() {
			
	var currentDate = new Date().getTime();
	var alter= currentDate - myBirthday;
			
    var years = alter / (1000 * 60 * 60 * 24 * 365.25); //Math.floor benutzen für Berechnung Tage, Studen ...
	var yearsFloored = Math.floor(years);
	var schaltjahre = Math.floor(years / 4);
	var seconds = Math.floor((alter / 1000) - (yearsFloored * 365 * 24 * 60 * 60)) - (schaltjahre * 24 * 60 * 60);
	var days = Math.floor(seconds / (60 * 60 * 24));
	var totalDays = Math.floor(alter / ( 1000 * 60 * 60 * 24));
	var lebenserwartung = totalDays / (81 * 365 + 20) * 100;
			
	document.getElementById("yearCounter").innerHTML = years.toFixed(10).replace(/\./g, ',') + " Jahre";
	document.getElementById("lifeExpectancy").innerHTML = lebenserwartung.toFixed(2).replace(/\./g, ',') + "% (Ø ~ 81 Jahre)";
	document.getElementById("secCounter").innerHTML = seconds.toLocaleString('de-DE') + " Sekunden";
	document.getElementById("dayCounter").innerHTML = days + " Tage";
	document.getElementById("totalDayCounter").innerHTML = totalDays.toLocaleString('de-DE') + " Tage";
}, 1000);
		