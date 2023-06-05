<?php

namespace App\Http\Middleware;

use App\Models\Resources\Offerta;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class Scadenze
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $now = Carbon::today(); // Ottieni la data corrente senza l'ora
        Offerta::where('data_scadenza', '<' , $now)
            ->update(['flagAttivo' => 0]);
        return $next($request);
    }
}
