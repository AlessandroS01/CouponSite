<?php

namespace App\Models;

use App\Models\Resources\Acquisizione;
use App\Models\Resources\Azienda;
use App\Models\Resources\Gestione;
use App\Models\Resources\Offerta;
use Brick\Math\BigInteger;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GestioneStaff extends Model {

    /**
     * @return il nome delle aziende che un membro dello staff può gestire
     */
    public function getNomeAziendeByStaff(){
        $staffId = Auth::id();

        // il metodo pluck ritorna un array chiave valore in cui il primo valore è la posizione all'interno dell'array
        // e come valore i vari nomi delle aziende.
        $nomeAziende = Gestione::join('azienda', 'gestione.azienda', '=', 'azienda.partita_iva')
            ->where('gestione.staff', $staffId)
            ->pluck('azienda.nome')
            ->toArray();

        return $nomeAziende;
    }

    /**
     * @return tutte le offerte che lo staff può gestire
     */
    public function getOfferteByStaff(){
        $staffId = Auth::id();

        $offerte = Gestione::join('azienda', 'gestione.azienda', '=', 'azienda.partita_iva')
            ->join('offerta', 'offerta.azienda', '=', 'azienda.partita_iva')
            ->where('gestione.staff', $staffId)
            ->where('flagAttivo', '=', '1')
            ->select('offerta.*')
            ->get();

        return $offerte;
    }


    /**
     * @return i nomi di tutte le offerte che lo staff può gestire
     */
    public function getNomeOfferteByStaff(){
        $staffId = Auth::id();

        $oggettoOfferte = Gestione::join('azienda', 'gestione.azienda', '=', 'azienda.partita_iva')
            ->join('offerta', 'offerta.azienda', '=', 'azienda.partita_iva')
            ->where('gestione.staff', $staffId)
            ->where('flagAttivo', '=', '1')
            ->pluck('offerta.oggetto_offerta')
            ->toArray();

        return $oggettoOfferte;
    }


    public function createOfferta(Request $request, $aziendaSelezionata){

        // trova la partita iva dell'azienda selezionata
        $partita_iva = Azienda::where('nome', $aziendaSelezionata)->pluck('partita_iva')->first();


        // crea la nuova offerta da aggiungere al database
        $offerta = Offerta::create([
            'oggetto_offerta' => $request->oggetto_offerta,
            'data_scadenza' => $request->data_scadenza,
            'luogo_fruizione' => $request->luogo_fruizione,
            'modalita_fruizione' => $request->modalita_fruizione,
            'percentuale_sconto' => $request->percentuale_sconto,
            'prezzo_pieno' => $request->prezzo_pieno,
            'categoria' => $request->categoria,
            'azienda' => $partita_iva,
            'flagAttivo' => $request->flagAttivo,
            'descrizione' => $request->descrizione,
            'staff' => Auth::id(),
        ]);

        // registra la nuova offerta
        event(new Registered($offerta));
    }

    public function modificaOfferta(Request $request){

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
        $offertaDaModificare->flagAttivo = $request->flagAttivo;

        // salva le informazioni dell'offerta modificata
        $offertaDaModificare->save();
    }

    public function eliminaOfferta(Request $request){
        $offertaDaEliminare = Offerta::find($request->codiceOfferta);
        $offertaDaEliminare->flagAttivo = 0;
        $offertaDaEliminare->save();
    }










}
