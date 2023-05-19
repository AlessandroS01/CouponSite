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
    protected $fillable = [
        'name',
        'surname',
        'email',
        'username',
        'password',
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
     * @param $role passato durante l'attivazione
     * @return bool quando il ruolo associato a quell'utente è uguale al parametro che gli passo
     */
    public function hasRole($role) {
        // crea un array
        $role = (array)$role;
        // ricerca il valore di $role all'interno di un array
        return in_array($this->role, $role);
    }

}
