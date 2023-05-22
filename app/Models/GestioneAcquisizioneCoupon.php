<?php

namespace App\Models;

use App\Models\Resources\Acquisizione;
use App\Models\Resources\Azienda;
use App\Models\Resources\Offerta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class GestioneAcquisizioneCoupon extends Model {

    public function checkClienteOfferta($usernameUser, $offertaSelezionata){

        $contatore = Acquisizione::query()
                ->where('offerta', $offertaSelezionata->codice)
                ->where('cliente', $usernameUser)
                ->get()
                ->count();

        if ( $contatore == 0 ) return true;
            else return false;


    }

    public function createCoupon($offertaSelezionata){
        $userId = Auth::id();

        if( $this->checkClienteOfferta($userId, $offertaSelezionata) ) {
            $acquisizione = new Acquisizione();
            log::info("A");
            $acquisizione->offerta = $offertaSelezionata->codice;
            log::info("B");
            $acquisizione->cliente = $userId;
            log::info("C");


            $codiceCoupon = Str::random(20);
            $acquisizione->codice_coupon = $codiceCoupon;

            while ( Acquisizione::where('codice_coupon', $codiceCoupon )->get()->count() != 0 ){
                $codiceCoupon = Str::random(20);
                $acquisizione->codice_coupon = $codiceCoupon;
            }

            $acquisizione->save();


            return true;

        }
        else return false;

    }





}
