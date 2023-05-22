<?php

namespace App\Http\Controllers;

use App\Models\CatalogoAziende;
use App\Models\CatalogoOfferte;
use App\Models\GestioneAcquisizioneCoupon;
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


    public function showCouponGenerato($idOfferta) {

        $offertaSelezionata = $this->catalogoOfferte->getOffertaByID($idOfferta);
        $this->gestioneAcquisizioneCoupon->createCoupon($offertaSelezionata);

        return view('coupon')
                        ->with('offertaSelezionata', $offertaSelezionata)
                        ->with('gestoreOfferte', $this->catalogoOfferte);
    }



}
