function makeTimer() {
	console.log('hi')
    var segment1 = $("#segment1").val();
	if(segment1 == 'coming-soon'){
		var countdowntime = "31 December 2024 00:00:00";
	}else{
		var countdowntime = $("#event_countdowntime").val();
	}
	var endTime = new Date(countdowntime);
	endTime = (Date.parse(endTime) / 1000);

	var now = new Date();
	now = (Date.parse(now) / 1000);
	if(now < endTime){
			
		var timeLeft = endTime - now;

		var days = Math.floor(timeLeft / 86400);
		var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
		var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
		var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

		if (hours < "10") {
			hours = "0" + hours;
		}
		if (minutes < "10") {
			minutes = "0" + minutes;
		}
		if (seconds < "10") {
			seconds = "0" + seconds;
		}

		$("#days").html(days + "<p class='timeText fs-6 mb-0'>Days</p>");
		$("#hours").html(hours + "<p class='timeText fs-6 mb-0'>Hours</p>");
		$("#minutes").html(minutes + "<p class='timeText fs-6 mb-0'>Mins</p>");
		if(days == '0' && hours == '00' && minutes == '00' &&  seconds == '01'){
			$("#seconds").html("00" + "<p class='timeText fs-6 mb-0'>Sec</p>");
		}else{
			$("#seconds").html(seconds + "<p class='timeText fs-6 mb-0'>Sec</p>");
		}
	}

}

setInterval(function () {
	makeTimer();
	console.log('this');
}, 1000);
