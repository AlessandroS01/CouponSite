<?php

namespace App\Http\Controllers;

use App\Models\CatalogoOfferte;
use Illuminate\Support\Facades\Log;
use App\Models\Faq;


class ClientController extends Controller
{

    protected $catalogoOfferte;

    public function __construct()
    {
        $this->catalogoOfferte = New CatalogoOfferte();
    }


    public function showCouponGenerato($idOfferta) {

        $offertaSelezionata = $this->catalogoOfferte->getOffertaByID($idOfferta);

        return view('coupon')
                        ->with('offertaSelezionata', $offertaSelezionata);
    }



}
