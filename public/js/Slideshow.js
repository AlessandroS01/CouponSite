    // Variabile per tenere traccia dell'indice della slide corrente
    let slideIndex = 1;

    // Mostra la slide corrente all'avvio dello script
    showSlides(slideIndex);

    // Funzione per spostarsi alle slide successive o precedenti
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    // Funzione per spostarsi alla slide specificata
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    // Funzione principale per mostrare le slide
    function showSlides(n) {
      let i;
      // ottengo le variabili slides e dots tramite il metodo del DOM document.getElementsByClassName
      let slides = document.getElementsByClassName("slide");
      let dots = document.getElementsByClassName("dot");

      // Se l'indice della slide supera il numero totale di slide, torna alla prima slide
      if (n > slides.length) {slideIndex = 1}

      // Se l'indice della slide è inferiore a 1, imposta il valore dell'indice
      // come valore più alto
      if (n < 1) {slideIndex = slides.length}

      // Nascondi tutte le slide, in seguito viene fatta apparire solo la slide corrente
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }

      // Viene rimossa la classe active-dot al puntino tramite la funzione replace()
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active-dot", "");
      }

      // Mostra la slide corrente e aggiungi la classe "active-dot" al puntino corrispondente
      // per fargli cambiare colore se viene visualizzata la slide associata al puntino
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active-dot";
    }
