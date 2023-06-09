<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CatalogoAziende;
use App\Models\CatalogoOfferte;
use App\Models\GestioneAcquisizioneCoupon;
use App\Models\ProfileUser;
use App\Models\Resources\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserController extends Controller {


    protected $ProfileUser;
    protected $CatalogoOfferte;
    protected $gestioneAcquisizioneCoupon;
    protected $CatalogoAziende;

    public function __construct()
    {
        $this->gestioneAcquisizioneCoupon = New GestioneAcquisizioneCoupon();
        $this->ProfileUser = new ProfileUser();
        $this->CatalogoOfferte=new CatalogoOfferte();
        $this->CatalogoAziende= new CatalogoAziende();
    }

    /**
     * Metodo che permette di ritornare la view per visualizzare i dati dell'utente loggato
     */
    function showProfilo(){

         $user= Auth::user();

         // prende tutti i coupon generati dall'utente che ha un id uguale a quello dell'utente autenticato
         $coupons = $this->ProfileUser->getCoupons($user->id);

         return view('updateProfile.profilo_visualizza_dati')
            ->with('user', $user)
            ->with('coupons', $coupons);

    }

    /**
     * Metodo che permette di ritornare la view per modifica i propri dati.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function ShowModificaDati(){

        $user= Auth::user();
        return view('updateProfile.profilo_modifica_dati')
            ->with('user', $user);

    }

    /**
     * Metodo che permette di ritornare la view per modificare la propria password.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function ShowModificaPassword(){

        $user= Auth::user();
        return view('updateProfile.profilo_modifica_password')
            ->with('user', $user);

    }

    /**
     * Metodo che permette di validare i nuovi dati immessi nella form
     * ed in seguito di salvarli all'interno del database
     */
    public function updateData(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'username' => ['required', 'string', 'min:8', 'max:50', Rule::unique('users')->ignore($user),],
            'nome' => ['required', 'string', 'max:50'],
            'cognome' => ['required', 'string', 'max:50'],
            'genere' => ['string', 'max:1'],
            'eta' => ['required', 'int', 'min:1', 'max:99'],
            'email' => ['required', 'string', 'email', 'max:50', Rule::unique('users')->ignore($user),],
            'telefono' => ['required', 'numeric', 'digits_between:10,20'],
            'via' => ['required', 'string', 'max:100'],
            'numero_civico' => ['required', 'int'],
            'citta' => ['required', 'string', 'max:50'],
        ]);

        // se l'utente autenticato risulta un utente di livello 1 entra dentro l'if
        if( $request->genere){
            $user->nome = $request->nome;
            $user->cognome = $request->cognome;
            $user->genere = $request->genere;
            $user->eta = $request->eta;
            $user->email = $request->email;
            $user->telefono = $request->telefono;
            $user->via = $request->via;
            $user->numero_civico = $request->numero_civico;
            $user->citta = $request->citta;
        }
        // entra solo se l'utente fa parte dello staff
        else{
            $user->nome = $request->nome;
            $user->cognome = $request->cognome;
            $user->eta = $request->eta;
            $user->email = $request->email;
            $user->telefono = $request->telefono;
            $user->via = $request->via;
            $user->numero_civico = $request->numero_civico;
            $user->citta = $request->citta;
        }
        $user->save();

        return redirect()->route('profilo')
            ->with('message', "Dati modificati con successo");

    }

    /**
     * Metodo che permette di modificare la password di un utente
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::id());

        // effettua il confronto tra la password immessa all'interno del campo 'oldpassword' e quella esistente su
        // db tramite il metodo Hash::check.
        // Infatti Hash::check effettua il confronto tra la password immessa, in formato di stringa, e la password
        // codificata del db. Ritorna true solo se i due le stringhe corrispondono
        if(Hash::check($request->oldpassword, $user->password)){

            $request->validate([
                'password' => ['required', 'max:50', 'confirmed', Rules\Password::defaults()]
            ]);

            $user->password = Hash::make($request->password);

            $user->save();

            return redirect()->route('profilo')
                ->with('message', "Password modificata con successo");
        }else{

            return redirect()->route('profilo-modifica-password')
                ->with('message', "Vecchia password incorretta");
        }


    }

    public function showCouponGenerato(Request $request) {

        // viene determinato il codice dell'offerta attraverso il valore 'codiceOfferta' inviato tramite un campo hidden
        // nella form che contiene il tasto ottieni
        $codiceOfferta = $request['codiceOfferta'];

        // determina qual'è l'offerta di riferimento con il codice inviato
        $offertaSelezionata = $this->CatalogoOfferte->getOffertaByID($codiceOfferta);

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
            ->with('gestoreOfferte', $this->CatalogoOfferte)
            ->with('coupon', $coupon)
            ->with('user', $user)
            ->with('flagCoupon', $nuovoCoupon);

    }






}
