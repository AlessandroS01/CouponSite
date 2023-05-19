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

        Gate::define('isAdmin', function ($user) {
            // $user è una tupla che identifica l'utente su cui si può richiamare il metodo hasRole()
            return $user->hasLevel('3');
        });

        Gate::define('isStaff', function ($user) {
            return $user->hasLevel('2');
        });

        Gate::define('isUser', function ($user) {
            return $user->hasLevel('1');
        });


//        Gate::define('show-discount', function ($user) {
//            return $user->hasLevel(['user', 'admin']);
//        });
    }
}
