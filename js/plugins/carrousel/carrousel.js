$(document).ready(function(){
	$("#carrousel").each(function(){
		if(!carMs){var carMs = 7000;}
		if(!carMaxSlide){var carMaxSlide = 1;}

		var carrousel = $(this);
		var max = $(carrousel).children("img").length;
		

		if(carMaxSlide>1){
			setInterval(function(){
				$(carrousel).children("img:visible").fadeOut("fast",function(){
					carMaxSlide++;
					$("#carSlide"+carMaxSlide).fadeIn("fast",function(){
						if(carMaxSlide==max){carMaxSlide=0;}
					});
				});
			},carMs);
		}
	});
});