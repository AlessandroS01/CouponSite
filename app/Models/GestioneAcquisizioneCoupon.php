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
     * @param Request $request rappresenta la richiesta inviata tramite metodo post a seguito dell'invio della form
     *      per generare un coupon
     * @return boolean true quando l'user non ha mai riscattato l'offerta selezionata e false altrimenti
     */
    public function checkClienteOfferta(Request $request){
        // prende l'id dell'utente autenticato
        $idUser = Auth::id();
        // determina il codice dell'offerta inviato tramite la submit della form
        $codiceOfferta = $request['codiceOfferta'];

        // $contatore prende il valore pari al conteggio degli elementi della tabella Acquisizione
        // che hanno settati i parametri 'offerta' pari al valore dell'offerta di cui si richiede il coupon
        // e 'user' uguale all'id dell'utente autenticato
        $contatore = Acquisizione::query()
                ->where('offerta', $codiceOfferta)
                ->where('cliente', $idUser)
                ->get()
                ->count();

        // nel caso il conteggio sia pari a 0 allora ritorna true altrimenti false
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


    public function getCoupon(Request $request){

        // prende l'id dell'utente autenticato
        $userId = Auth::id();
        // determina il codice dell'offerta inviato tramite la submit della form
        $codiceOfferta = $request['codiceOfferta'];

        return Acquisizione::query()
            ->where('offerta', $codiceOfferta)
            ->where('cliente', $userId)
            ->first();

    }




}
