// prende tutti gli elementi che hanno settata la classe uguale a "accordion"
var acc = document.getElementsByClassName("accordion");
var i;

// Itera su tutti gli elementi "accordion"
for (i = 0; i < acc.length; i++) {

  // Aggiunge un listener di evento click a ciascun elemento "accordion"
  acc[i].addEventListener("click", function() {

    // Aggiunge o rimuove la classe "active-accordion" all'elemento cliccato
    this.classList.toggle("active-accordion");

    // Prende l'elemento immediatamente successivo nel codice html
    var risposta = this.nextElementSibling;

    // controlla se il valore di maxHeight dell'elemento successivo è impostato
    if (risposta.style.maxHeight) {

        // nel caso in cui è impostato rimuove l'altezza all'elemento facendolo collassare
        risposta.style.maxHeight = null;

      } else {

        // Altrimenti, imposta l'altezza massima uguale all'altezza del contenuto
        risposta.style.maxHeight = risposta.scrollHeight + "px";

      }
  });
}

// Simula il click sugli elementi con gli ID "first-filter" e "second-filter"
document.getElementById("first-filter").click();
document.getElementById("second-filter").click();

