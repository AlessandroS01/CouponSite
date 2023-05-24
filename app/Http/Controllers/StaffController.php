<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CatalogoAziende;
use App\Models\GestioneStaff;
use App\Models\Resources\Azienda;
use App\Models\Resources\Offerta;
use App\Models\Resources\Product;
use App\Http\Requests\NewProductRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class StaffController extends Controller {

    protected $gestioneStaff;
    protected $gestioneAziende;

    public function __construct()
    {
        $this->gestioneStaff = New GestioneStaff();
        $this->gestioneAziende = New CatalogoAziende();
    }

    public function showPannelloStaff() {
        return view('staff.pannello_staff');
    }

    /**
     * @return @View in cui lo staff può creare una nuova offerta.
     * Passa un parametro contenente tutte le aziende che quel determinato membro dello staff può gestire
     */
    public function showCreazioneOfferta()
    {
        return view('staff.gestione_offerte.creazione_offerta')
                ->with('aziende', $this->gestioneStaff->getNomeAziendeByStaff());
    }

    /**
     * Implementa la possibilità di creare una nuova offerta ad un membro dello staff su una determinata azienda
     * @param $request rappresenta la richiesta di tipo post inviata all'atto di invio della form
     */
    public function storeNewOfferta(Request $request)
    {

        // Prima verifica tutte le varie regole di validazione
        $request->validate([
            'oggetto_offerta' => ['required', 'string', 'max:100'],
            'data_scadenza' => ['required', 'date', 'after:today'],
            'luogo_fruizione' => ['required', 'string', 'max:50'],
            'modalita_fruizione' => ['required', 'string', 'max:50'],
            'percentuale_sconto' => ['required', 'int', 'min:1', 'max:99'],
            'prezzo_pieno' => ['required', 'numeric', 'min:1'],
            'categoria' => ['required', 'string', 'max:50'],
            'azienda' => ['required'],
            'descrizione' => ['required', 'string', 'max:100'],
        ]);

        // determina la lista di tutte le aziende che l'utente staff può gestire
        $listaAziende = $this->gestioneStaff->getNomeAziendeByStaff();
        // tra tutte quelle selezionate trova quella alla posizione selezionata all'interno della form
        $aziendaSelezionata = $listaAziende[$request->azienda];

        // trova la partita iva dell'azienda selezionata
        $partita_iva = Azienda::where('nome', $aziendaSelezionata)->pluck('partita_iva')->first();


        // crea la nuova tupla da aggiungere al database
        $offerta = Offerta::create([
            'oggetto_offerta' => $request->oggetto_offerta,
            'data_scadenza' => $request->data_scadenza,
            'luogo_fruizione' => $request->luogo_fruizione,
            'modalita_fruizione' => $request->modalita_fruizione,
            'percentuale_sconto' => $request->percentuale_sconto,
            'prezzo_pieno' => $request->prezzo_pieno,
            'categoria' => $request->categoria,
            'azienda' => $partita_iva,
            'descrizione' => $request->descrizione,
            'staff' => Auth::id(),
        ]);

        // registra la nuova offerta
        event(new Registered($offerta));

        // ritorna alla home
        return redirect('/');
    }

    /**
     * @return @View passandogli i parametri per visualizzare tutte le offerte, tutti gli oggetti delle singole offerte
     *  passate e la lista delle aziende.
     */
    public function showModificaOfferta()
    {
        $offerte = $this->gestioneStaff->getOfferteByStaff();
        $oggettoOfferte = $this->gestioneStaff->getNomeOfferteByStaff();
        $aziende = $this->gestioneAziende->getAllNoPaginate();

        return view('staff.gestione_offerte.modifica_offerta')
            ->with('offerte', $offerte)
            ->with('oggetto_offerte', $oggettoOfferte)
            ->with('aziende', $aziende);
    }



    /**
     * Implementa la possibilità di modificare un'offerta ad un membro dello staff
     * @param $request rappresenta la richiesta di tipo post inviata all'atto di invio della form
    */
    public function storeNewOffertaModificata(Request $request)
    {

        // Prima verifica tutte le varie regole di validazione
        $request->validate([
            'oggetto_offerta' => ['required', 'string', 'max:100'],
            'data_scadenza' => ['required', 'date', 'after:today'],
            'luogo_fruizione' => ['required', 'string', 'max:50'],
            'modalita_fruizione' => ['required', 'string', 'max:50'],
            'percentuale_sconto' => ['required', 'int', 'min:1', 'max:99'],
            'prezzo_pieno' => ['required', 'numeric', 'min:1'],
            'categoria' => ['required', 'string', 'max:50'],
            'azienda' => ['required'],
            'descrizione' => ['required', 'string', 'max:100'],
        ]);

        // trova qual'è l'offerta da modificare
        $offertaDaModificare = Offerta::find($request->codiceOfferta);

        // aggiorna tutti gli attributi dell'offerta ritrovata
        $offertaDaModificare->codice = $request->codiceOfferta;
        $offertaDaModificare->data_scadenza = $request->data_scadenza;
        $offertaDaModificare->luogo_fruizione = $request->luogo_fruizione;
        $offertaDaModificare->modalita_fruizione = $request->modalita_fruizione;
        $offertaDaModificare->percentuale_sconto = $request->percentuale_sconto;
        $offertaDaModificare->prezzo_pieno = $request->prezzo_pieno;
        $offertaDaModificare->oggetto_offerta = $request->oggetto_offerta;
        // determina il nome dell'azienda poichè con il submit della form viene inviata la partita_iva e non il nome
        $offertaDaModificare->azienda = Azienda::where('nome', 'like', '%'.$request->azienda.'%')->pluck('partita_iva')->first();
        // la modifica dell'offerta modifica anche lo staff che ha generato quell'offerta all'interno del db
        $offertaDaModificare->staff = Auth::id();
        $offertaDaModificare->categoria = $request->categoria;
        $offertaDaModificare->descrizione = $request->descrizione;

        // salva le informazioni dell'offerta modificata
        $offertaDaModificare->save();

        // ritorna alla home
        return redirect('/');
    }

}
