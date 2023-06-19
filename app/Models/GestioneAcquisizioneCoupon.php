<?php

namespace App\Models;

use App\Models\Resources\Acquisizione;
use Brick\Math\BigInteger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GestioneAcquisizioneCoupon extends Model {

    /**
     * funzione utilizzata per verificare che l'utente non abbia riscattato già l'offerta selezionata
     */
    public function checkClienteOfferta(Request $request){

        // prende l'id dell'utente autenticato
        $idUser = Auth::id();

        // determina il codice dell'offerta inviato tramite la submit della form
        $codiceOfferta = $request['codiceOfferta'];

        // tramite la variabile $contatore andiamo a verificare se l'offerta è già stata generata dall'utente.
        // viene passato alla query l'id dell'utente e il codice dell'offerta
        $contatore = Acquisizione::query()
                ->where('offerta', $codiceOfferta)
                ->where('cliente', $idUser)
                ->get()
                ->count();

        // nel caso il conteggio sia 0 allora ritorna true altrimenti false
        if ( $contatore == 0 ) return true;
            else return false;
    }

    /**
     * Metodo utilizzato per creare un nuovo record all'interno dell tabella Acquisizione.
     * @param Request $request rappresenta la richiesta inviata tramite metodo post a seguito dell'invio della form
     *      per generare un coupon
     * @return void
     */
    public function createCoupon(Request $request){

        // prende l'id dell'utente autenticato
        $userId = Auth::id();

        // determina il codice dell'offerta inviato tramite la submit della form
        $codiceOfferta = $request['codiceOfferta'];

        // genera una stringa di 20 caratteri randomici
        $codiceCoupon = Str::random(20);

        // finchè il valore di $codiceCoupon è presente all'interno della relazione Acquisizione,
        // $codiceCoupon viene sempre settato ad una nuova stringa random
        while ( Acquisizione::where('codice_coupon', $codiceCoupon )->get()->count() != 0 ){
            $codiceCoupon = Str::random(20);
        }

        // crea una nuova istanza per la relazione Acquisizione
        $acquisizione = new Acquisizione();

        // setta i parametri della relazione alla nuova istanza
        $acquisizione->codice_coupon = $codiceCoupon;
        $acquisizione->offerta = $codiceOfferta;
        $acquisizione->cliente = $userId;

        // salva sul db il nuovo record appena generato
        $acquisizione->save();

    }

    /**
     * @param Request $request inviata tramite form
     * @return @View coupon che ha come offerta il codice inviato tramite metodo POST e user id pari allo user che ha
     *  richiesto il coupon
     */
    public function getCoupon(Request $request){

        // prende l'id dell'utente autenticato
        $userId = Auth::id();

        // determina il codice dell'offerta inviato tramite la submit della form
        $codiceOfferta = $request['codiceOfferta'];

        // Restituisce il record della tabella acquisizione corrispondente ai paramentri imposti nella where
        return Acquisizione::query()
            ->where('offerta', $codiceOfferta)
            ->where('cliente', $userId)
            ->first();

    }




}
