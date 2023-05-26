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
use Illuminate\Support\Facades\Log;

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


function showProfilo(){

     $user= Auth::user();
     $coupons = $this->ProfileUser->getCoupons($user->id);
     Log::info($coupons);
     return view('profilo')
        ->with('user', $user)
        ->with('coupons', $coupons);

}


    public function updateData(Request $request)
    {
        $username = $request->input('username');
        $nome = $request->input('nome');
        $cognome = $request->input('cognome');
        $email = $request->input('email');
        $telefono = $request->input('telefono');
        $eta = $request->input('eta');
        $genere = $request->input('genere');
        $citta = $request->input('citta');
        $via = $request->input('via');
        $ncivico = $request->input('numero_civico');



        if (!empty($username)) {
            $request->validate([
                'username' => ['required', 'string', 'min:8', 'max:50', 'unique:users'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->username = $username;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Username aggiornato con successo');
        } else if (!empty($nome)){
            $request->validate([
                'nome' => ['required', 'string', 'max:50'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->nome = $nome;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Nome aggiornato con successo');

        } else if (!empty($cognome)){
            $request->validate([
                'cognome' => ['required', 'string', 'max:50'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->cognome = $cognome;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Cognome aggiornato con successo');

        }else if (!empty($email)){
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->email = $email;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Email aggiornato con successo');

        }else if (!empty($telefono)){
            $request->validate([
                'telefono' => ['required', 'numeric', 'digits_between:10,20'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->telefono = $telefono;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Telefono aggiornato con successo');

        }else if (!empty($eta)){
            $request->validate([
                'eta' => ['required', 'int', 'min:1', 'max:99'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->eta = $eta;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Eta aggiornata con successo');

        }else if (!empty($genere)){
            $request->validate([
                'genere' => ['required', 'string', 'max:1'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->genere = $genere;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Genere aggiornato con successo');

        }else if (!empty($citta) && !empty($via) && !empty($ncivico)){
            $request->validate([
                'via' => ['required', 'string', 'max:100'],
                'numero_civico' => ['required', 'int'],
                'citta' => ['required', 'string', 'max:50'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->citta = $citta;
            $user->via = $via;
            $user->numero_civico = $ncivico;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Indirizzo aggiornato con successo');

        }

        return redirect()->route('profilo');
    }

    public function showCouponGenerato(Request $request) {

        // viene determinato il codice dell'offerta attraverso il valore 'codiceOfferta' inviato tramite form
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
