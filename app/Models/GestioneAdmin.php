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

class GestioneAdmin extends Model {

    public function getUtentiRegistrati(){

        $utenti = User::where('livello', 1)->get();
        return $utenti;
    }
    public function getUtentiStaff(){

        $utenti = User::where('livello', 2)->get();
        return $utenti;
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

                if( $request->aziende){
                    $aziende = $request->aziende;

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

            case '1': {
                $vecchioUserPacchetti = User::where('flagPacchetti', true)->first();
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


                if( $request->aziende){
                    $aziende = $request->aziende;

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

    public function storeStaffModificato(Request $request){

        $membroStaff = User::find($request->staffId);

        switch ($request->gestionePacchetti){
            case '0': {

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

            case '1': {

                $vecchioUserPacchetti = User::where('flagPacchetti', true)->first();
                if ($vecchioUserPacchetti) {
                    $vecchioUserPacchetti->flagPacchetti = false;
                    $vecchioUserPacchetti->save();
                }


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
            'logo' => $imageName ? 'img/'.$imageName : null
        ]);

        // Definisce l'evento della creazione di un nuovo utente registrato
        event(new Registered($azienda));
    }


}
