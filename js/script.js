var slideIndex = 1;
showSlides(slideIndex);
function plusSlides(n){
	showSlides(slideIndex += n);
}
function showSlides(n){
	var i;
	var slides = document.getElementsByClassName("item_slider");

	if(n > slides.length){
		slideIndex = 1
	}
	if(n<1){
		slideIndex = slides.length
	}
	for(i = 0; i < slides.length; i++){
		slides[i].style.display = "none";
	}

	slides[slideIndex-1].style.display = "block";
}
var var1 = setInterval(plusSlides, 5000, 1);

