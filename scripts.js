document.addEventListener("DOMContentLoaded", function(event) { 
	
	var slideIndex = 0;
	var timer = null;
	showSlides();
	
	var dots = document.getElementsByClassName("dot");
	var slides = document.getElementsByClassName("big-pic");
	
	for (var x = 0; x < dots.length; x++) {
		var theDot = dots[x];
		theDot.addEventListener("click", function(evt) {
			clearTimeout(timer);
			slideIndex = this.id;
			showSlides();
		});
	}
	
	
function showSlides() {
	
	var slides = document.getElementsByClassName("big-pic");
	var dots = document.getElementsByClassName("dot");
	
	for (var i=0; i<slides.length; i++) {
		   slides[i].style.display = "none";
		   dots[i].className = dots[i].className.replace(" active", "");
	}	
	
	   slideIndex++;
	   
	   if (slideIndex > slides.length) {
		  slideIndex = 1;
	   }
	   
	   slides[slideIndex-1].style.display = "block";
	   dots[slideIndex-1].className += " active";
	   timer = setTimeout(showSlides, 8000);
}


	
	


});
