<?php

namespace App\Http\Controllers;


use App\Models\CatalogoOfferte;
use App\Models\GestioneAcquisizioneCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ClientController extends Controller
{

    protected $catalogoOfferte;
    protected $gestioneAcquisizioneCoupon;

    public function __construct()
    {
        $this->catalogoOfferte = New CatalogoOfferte();
        $this->gestioneAcquisizioneCoupon = New GestioneAcquisizioneCoupon();
    }


    public function showCouponGenerato(Request $request) {

        $codiceOfferta = $request['codiceOfferta'];

        $offertaSelezionata = $this->catalogoOfferte->getOffertaByID($codiceOfferta);

        if($offertaSelezionata->data_scadenza < date('Y-m-d') ){

            return view('coupon')
                ->with('validita_promozione', false);

        }
        else if($this->gestioneAcquisizioneCoupon->checkClienteOfferta($request)){

            $this->gestioneAcquisizioneCoupon->createCoupon($request);

            $coupon = $this->gestioneAcquisizioneCoupon->getCoupon($request);

            $nuovoCoupon = true;

        }
        else{

            $coupon = $this->gestioneAcquisizioneCoupon->getCoupon($request);

            $nuovoCoupon = false;

        }

        return view('coupon')
            ->with('offertaSelezionata', $offertaSelezionata)
            ->with('gestoreOfferte', $this->catalogoOfferte)
            ->with('coupon', $coupon)
            ->with('flagCoupon', $nuovoCoupon);

    }



}
