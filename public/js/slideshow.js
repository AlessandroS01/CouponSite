/*let slideIndex = 0;
    showSlides(slideIndex);

    function slidecount(n){
    showSlides(slideIndex += n)
    }

    function showSlides(n){
    
    let slide = document.getElementsByClassName("card");
    if (n >= slide.length) {slideIndex = 0}       
    if(n < 0) {slideIndex= slide.length-3}
    console.log(slideIndex + "prova");
    
    for (let i=0; i< slide.length; i++){
        if (i != slideIndex && i != slideIndex + 1 && i!= slideIndex +2)
        {
        slide[i].style.display = "none";
        }
        else slide[i].style.display = "block";
    }  
    }*/

    let slideIndex = 1;
    showSlides(slideIndex);
    
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }
    
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }
    
    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("slide");
      let dots = document.getElementsByClassName("dot");
      if (n > slides.length) {slideIndex = 1}    
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active-dot", "");
      }
      slides[slideIndex-1].style.display = "block";  
      dots[slideIndex-1].className += " active-dot";
    }