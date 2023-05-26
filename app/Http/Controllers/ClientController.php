<?php

namespace App\Http\Controllers;


use App\Models\CatalogoAziende;
use App\Models\CatalogoOfferte;
use App\Models\GestioneAcquisizioneCoupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class ClientController extends Controller
{

    protected $catalogoOfferte;
    protected $gestioneAcquisizioneCoupon;
    protected $catalogoAziende;


    public function __construct()
    {
        $this->catalogoOfferte = New CatalogoOfferte();
        $this->gestioneAcquisizioneCoupon = New GestioneAcquisizioneCoupon();
        $this->catalogoAziende = New CatalogoAziende();
    }

    /**
     * @param Request $request rappresenta la richiesta che viene inviata a seguito del click sulla form contenente
     *      il bottone Ottieni per acquisire un coupon
     * @return @View 'coupon' in 2 modi diversi. Nel primo caso ritorna la vista con un parametro settato a false
     *      che permette di bloccare l'acquisizione del coupon all'utente quando la data di scadenza dell'offerta risulta
     *      già superata.
     *      Nell'altro caso invece ritorna la vista con annessi 5 parametri per far visualizzare il coupon all'utente
     *      che lo ha richiesto.
     */
    public function showCouponGenerato(Request $request) {

        // viene determinato il codice dell'offerta attraverso il valore 'codiceOfferta' inviato tramite form
        $codiceOfferta = $request['codiceOfferta'];
        // determina qual'è l'offerta di riferimento con il codice inviato
        $offertaSelezionata = $this->catalogoOfferte->getOffertaByID($codiceOfferta);

        // nel caso in cui la data di scadenza dell'offerta è antecedente alla data odierna ritorna alla vista
        // un valore booleano settato a false che permette, all'interno della vista stessa, di visualizzare
        // un messaggio di errore che blocca l'acquisizione del coupon
        if($offertaSelezionata->data_scadenza < date('Y-m-d') ){

            return view('coupon')
                ->with('validita_promozione', false);

        }
        // nel caso in cui invece, attraverso il metodo definito all'interno di GestioneAcquisizioneCoupon chiamato
        // checkClienteOfferta che come parametro assume la richiesta, il cliente non ha già richiesto quel coupon
        // viene prima creato il coupon e poi ripreso dal db settando un parametro $nuovoCoupon a true.
        // In questo modo all'interno della vista si determina se già il coupon era esistente o se è stato emesso in quel
        // momento.
        else if($this->gestioneAcquisizioneCoupon->checkClienteOfferta($request)){

            // viene generato un nuovo coupon
            $this->gestioneAcquisizioneCoupon->createCoupon($request);

            // viene ritornato il nuovo coupon creato
            $coupon = $this->gestioneAcquisizioneCoupon->getCoupon($request);

            // il parametro nuovoCoupon viene settato a true
            $nuovoCoupon = true;

        }
        // si attiva solo nel caso in cui il cliente ha già acquisito il coupon
        else{

            // viene ritornato il coupon corrispondente alla richiesta
            $coupon = $this->gestioneAcquisizioneCoupon->getCoupon($request);

            // il parametro nuovoCoupon viene settato a false
            $nuovoCoupon = false;

        }

        // determina qual'è l'user che ha fatto partire la richiesta
        $user = Auth::user();

        /**
         * viene ritornata la vista coupon con 5 parametri.
         *  offertaSelezionata => rappresenta l'offerta per cui si vuole emettere il coupon
         *  gestoreOfferte => viene passato per generare il logo dell'azienda dell'offerta selezionata
         *  coupon => rappresenta il coupon che viene generato o che era già presente
         *  user => rappresenta l'istanza di user che ha richiesto il coupon
         *  flagCoupon => se true significa che il coupon è stato creato per la prima volta mentre se false
         *                significa che il coupon era già stato emesso per quello user per quella determinata offerta
         */
        return view('coupon')
            ->with('offertaSelezionata', $offertaSelezionata)
            ->with('gestoreOfferte', $this->catalogoOfferte)
            ->with('coupon', $coupon)
            ->with('user', $user)
            ->with('flagCoupon', $nuovoCoupon);

    }



}
