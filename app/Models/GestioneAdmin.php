<?php

namespace App\Models;

use App\Models\Resources\Acquisizione;
use App\Models\Resources\Azienda;
use App\Models\Resources\Faq;
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

class GestioneAdmin extends Model {


    public function getNumeroCouponEmessi(){

        $couponTotali = Acquisizione::all()->count();
        return $couponTotali;
    }

    public function getAllCouponEmessi(){

        $listaCoupon = Acquisizione::join('offerta', 'acquisizione.offerta', '=', 'offerta.codice')
            ->leftJoin('users', 'users.id', '=', 'acquisizione.cliente')
            ->select('acquisizione.offerta as id_offerta', 'offerta.oggetto_offerta as nome_offerta', 'users.nome as nome_cliente', 'users.id as id_cliente', 'users.cognome as cognome_cliente', 'acquisizione.codice_coupon as codice', 'acquisizione.created_at as data')
            ->orderBy('offerta.codice', 'asc')
            ->get();

        return $listaCoupon;
    }
    public function getUtentiRegistrati(){

        $utenti = User::where('livello', 1)->get();
        return $utenti;
    }
    public function getUtentiStaff(){

        $utenti = User::where('livello', 2)->get();
        return $utenti;
    }

    public function getFaq(){

        $faq = Faq::all();
        return $faq;
    }
    public function getFaqDomanda(){

        $faqdomanda = Faq::pluck('domanda')->toArray();
        return $faqdomanda;
    }

    public function getUsernameUtentiStaff(){

        $utenti = User::where('livello', 2)->pluck('username')->toArray();
        return $utenti;
    }

    public function getUsernameUtentiRegistrati(){

        $utenti = User::where('livello', 1)->pluck('username')->toArray();
        return $utenti;
    }


    public function createStaff(Request $request){

        switch ($request->gestionePacchetti){
            //caso in cui lo staff non gestisce i pacchetti
            case '0': {

                // crea la nuova tupla da aggiungere al database
                $user = User::create([
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'nome' => $request->nome,
                    'cognome' => $request->cognome,
                    'genere'=>$request->genere,
                    'eta'=>$request->eta,
                    'email' => $request->email,
                    'telefono' => $request->telefono,
                    'via' => $request->via,
                    'numero_civico' => $request->numero_civico,
                    'citta' => $request->citta,
                    'livello' => '2',
                ]);

                // definisce l'evento della creazione di un nuovo utente registrato
                event(new Registered($user));

                //controllo se sono state selezionate delle checkbox
                if( $request->aziende){
                    //salvo il valore delle checkbox selezionate (partita iva)
                    $aziende = $request->aziende;

                    //creo un record in gestione per ogni azienda selezionata
                    foreach ($aziende as $azienda){
                        $nuovaGestione = Gestione::create([
                            'staff' => $user->id,
                            'azienda' => $azienda
                        ]);

                        event(new Registered($nuovaGestione));
                    }
                }

                break;
            }
            //caso in cui lo staff che creo gestisce i pacchetti
            case '1': {
                //recupero il vecchio staff che gestisce i pacchetti
                $vecchioUserPacchetti = User::where('flagPacchetti', true)->first();

                //se esiste lo staff che gestisce i pacchetti
                if ($vecchioUserPacchetti) {
                    $vecchioUserPacchetti->flagPacchetti = false;
                    $vecchioUserPacchetti->save();
                }

                // crea la nuova tupla da aggiungere al database
                $user = User::create([
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'nome' => $request->nome,
                    'cognome' => $request->cognome,
                    'genere'=>$request->genere,
                    'eta'=>$request->eta,
                    'email' => $request->email,
                    'telefono' => $request->telefono,
                    'via' => $request->via,
                    'numero_civico' => $request->numero_civico,
                    'citta' => $request->citta,
                    'livello' => '2',
                    'flagPacchetti' => true
                ]);

                // definisce l'evento della creazione di un nuovo utente registrato
                event(new Registered($user));

                //controllo se sono state selezionate delle checkbox
                if( $request->aziende){
                    $aziende = $request->aziende;

                    //creo nuovi record nella tabella Gestione per ogni azienda presente (lo staff puo gestire tutte le aziende in questo caso)
                    foreach ($aziende as $azienda){
                        $nuovaGestione = Gestione::create([
                            'staff' => $user->id,
                            'azienda' => $azienda
                        ]);

                        event(new Registered($nuovaGestione));
                    }
                }

                break;
            }

        }
    }

    public function storeFaqModificato(Request $request)
    {
        $faq = Faq::find($request->idFaq);

        if ($faq) {
            $faq->domanda = $request->domanda;
            $faq->risposta = $request->risposta;
            $faq->save();
        }

    }


    public function storeStaffModificato(Request $request){

        $membroStaff = User::find($request->staffId);

        switch ($request->gestionePacchetti){
            //caso in cui lo staff modificato non potrà gestire i pacchetti
            case '0': {
                //elimino inzialmente tutte le tuple della tabella gestione che si riferiscono allo staff modificato
                Gestione::where('staff', $request->staffId)->delete();

                // effettua l'update della tupla di user
                $membroStaff->nome = $request->nome;
                $membroStaff->cognome = $request->cognome;
                $membroStaff->email = $request->email;
                $membroStaff->genere = $request->genere;
                $membroStaff->eta = $request->eta;
                $membroStaff->telefono = $request->telefono;
                $membroStaff->via = $request->via;
                $membroStaff->numero_civico = $request->numero_civico;
                $membroStaff->citta = $request->citta;
                $membroStaff->flagPacchetti = $request->gestionePacchetti;

                $membroStaff->save();
                //creo le tuple nella tabella gestione per le checkbox selezionate
                if( $request->aziende){
                    $aziende = $request->aziende;

                    foreach ($aziende as $azienda){
                        $nuovaGestione = Gestione::create([
                            'staff' => $membroStaff->id,
                            'azienda' => $azienda
                        ]);

                        event(new Registered($nuovaGestione));
                    }
                }

                break;
            }
            // caso in cui lo staff modificato potrà gestire i pacchetti
            case '1': {
                //recupero lo staff che gestiva i pacchetti precedentemente
                $vecchioUserPacchetti = User::where('flagPacchetti', true)->first();
                if ($vecchioUserPacchetti) {
                    $vecchioUserPacchetti->flagPacchetti = false;
                    $vecchioUserPacchetti->save();
                }

                //elimino tutte le tuple di Gestione per lo staff modificato
                Gestione::where('staff', $request->staffId)->delete();

                // effettua l'update della tupla di user
                $membroStaff->nome = $request->nome;
                $membroStaff->cognome = $request->cognome;
                $membroStaff->email = $request->email;
                $membroStaff->genere = $request->genere;
                $membroStaff->eta = $request->eta;
                $membroStaff->telefono = $request->telefono;
                $membroStaff->via = $request->via;
                $membroStaff->numero_civico = $request->numero_civico;
                $membroStaff->citta = $request->citta;
                $membroStaff->flagPacchetti = $request->gestionePacchetti;

                $membroStaff->save();
                //creo nuove tuple in Gestione per ogni azienda presente associate allo staff modificato
                if( $request->aziende){
                    $aziende = $request->aziende;

                    foreach ($aziende as $azienda){
                        $nuovaGestione = Gestione::create([
                            'staff' => $membroStaff->id,
                            'azienda' => $azienda
                        ]);

                        event(new Registered($nuovaGestione));
                    }
                }
                break;
            }

        }

    }

    public function createAzienda(Request $request, $imageName)
    {
        // Crea la nuova tupla da aggiungere al database
        $azienda = Azienda::create([
            'partita_iva' => $request->partita_iva,
            'nome' => $request->nome,
            'email' => $request->email,
            'localita' => $request->localita,
            'tipologia' => $request->tipologia,
            'telefono' => $request->telefono,
            'descrizione' => $request->descrizione,
            'ragione_sociale' => $request->ragione_sociale,
            'logo' => $imageName
        ]);

        // Definisce l'evento della creazione di un nuovo utente registrato
        event(new Registered($azienda));

        $staffGestionePacchetti = User::where('flagPacchetti', true)->first();

        //controllo se esiste uno staff che puo gestire i pacchetti, in caso esista associo l'azienda allo staff nella tabella Gestione
        if($staffGestionePacchetti){
            $nuovaGestione = Gestione::create([
                'staff' => $staffGestionePacchetti->id,
                'azienda' => $request->partita_iva
            ]);

            event(new Registered($nuovaGestione));
        }

    }

    public function modificaAzienda(Request $request, $imageName)
    {

        $azienda = Azienda::find($request->partita_iva);

        $azienda->nome = $request->nome;
        $azienda->localita = $request->localita;
        $azienda->email = $request->email;
        $azienda->telefono = $request->telefono;
        $azienda->logo = $imageName;
        $azienda->tipologia = $request->tipologia;
        $azienda->ragione_sociale = $request->ragione_sociale;
        $azienda->descrizione = $request->descrizione;

        $azienda->save();

    }

    public function createFAQ(Request $request){

        $faq = Faq::create([
            'domanda'=>$request->domanda,
            'risposta' =>$request->risposta

        ]);

        event(new Registered($faq));
    }


}
