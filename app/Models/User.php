<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
    ];

    /**
     * Protegge tutti questi valori durante l'atto di invio della forma
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'username',
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
     * @param $role passato durante l'attivazione
     * @return bool true quando il ruolo associato a quell'utente è uguale al parametro che gli passo
     */
    public function hasLevel($livello) {
        // crea un array
        $livello = (array)$livello;
        // ricerca il valore di $livello all'interno di un array
        return in_array($this->livello, $livello);
    }

}
