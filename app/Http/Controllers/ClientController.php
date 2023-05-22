<?php

namespace App\Http\Controllers;

use App\Models\CatalogoAziende;
use App\Models\CatalogoOfferte;
use App\Models\GestioneAcquisizioneCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Faq;


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
        if($this->gestioneAcquisizioneCoupon->checkClienteOfferta($request))
            $this->gestioneAcquisizioneCoupon->createCoupon($request);

        return view('coupon')
                        ->with('offertaSelezionata', $offertaSelezionata)
                        ->with('gestoreOfferte', $this->catalogoOfferte);
    }



}
