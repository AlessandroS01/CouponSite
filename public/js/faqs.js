// prende tutti gli elementi che hanno settata la classe uguale a "container-domanda"
var acc = document.getElementsByClassName("accordion");
var i;


for (i = 0; i < acc.length; i++) {
  // aggiunge la funzione per ogni elemento di acc
  acc[i].addEventListener("click", function() {
    // aggiunge ed elimina la classe active agli elementi della lista acc a seguito del click
    this.classList.toggle("active");
    // prende l'elemento immediatamente successivo nel codice html 
    var risposta = this.nextElementSibling;
    // controlla se il valore di maxHeight dell'elemento successivo è settato o meno.
      if (risposta.style.maxHeight) {
        // nel caso in cui è settato viene collassato
        risposta.style.maxHeight = null;
      } else {
        // altrimenti setta l'altezza massima uguale all'altezza del contenuto e ci aggiunge l'unità di misura
        risposta.style.maxHeight = risposta.scrollHeight + "px";
      } 
  });
}

document.getElementById("first-filter").click();
document.getElementById("second-filter").click();

