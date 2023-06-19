<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

/**
 * Model da usare per quanto riguarda l'utente.
 *
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * Attributi richiesti durante l'atto di registrazione
     *
     * @var array<int, string>
     */
    //agiungo i campi che lo user dovrà specificare per la registrazione
    protected $fillable = [
        'username',
        'password',
        'nome',
        'cognome',
        'genere',
        'eta',
        'email',
        'telefono',
        'via',
        'numero_civico',
        'citta',
        'livello',
        'flagPacchetti'
    ];

    /**
     * Protegge tutti questi valori durante l'atto di invio della form
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * funzione che mi permette di verificare il livello a cui l'utente appartiene
     * viene passato il livello e ricevo un valore di verità
     */
    public function hasLevel($livello) {
        // crea un array
        $livello = (array)$livello;
        // ricerca il valore di $livello all'interno di un array
        return in_array($this->livello, $livello);
    }

    /**
     * Metodo utilizzato per determinare se un membro dello staff può gestire o meno i pacchetti
     */
    public function isStaffPacchetti($livello) {

        if ( $livello == 2 ){
            if( Auth::user()->flagPacchetti ){
                return true;
            }
            return false;
        }
        return false;
    }


}
