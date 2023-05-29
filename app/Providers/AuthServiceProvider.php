<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

/*
 * Definisce i meccanismi di autorizzazione
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Metodi di autorizzazione con i relativi Gate
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // gate per verificare se l'utente è un semplice cliente
        Gate::define('isUser', function ($user) {
            return $user->hasLevel('1');
        });

        // gate per verificare se l'utente fa parte dello staff
        Gate::define('isStaff', function ($user) {
            return $user->hasLevel('2');
        });

        // gate per verificare se l'utente è un membro dello staff che può gestire la creazione dei pacchetti
        Gate::define('isStaffPacchetti', function ($user) {
            return $user->isStaffPacchetti('2');
        });


        // gate per verificare se l'utente è l'admin del sito
        Gate::define('isAdmin', function ($user) {
            // $user è una tupla che identifica l'utente su cui si può richiamare il metodo hasRole()
            return $user->hasLevel('3');
        });

        Gate::define('isUserStaff', function ($user) {
            // $user è una tupla che identifica l'utente su cui si può richiamare il metodo hasRole()
            return $user->hasLevel('1') || $user->hasLevel('2');
        });

    }
}
