<?php

namespace App\Http\Controllers;

class StaffController extends Controller {

    //non ha nessuna funzione costruttrice, filtro e processo di autenticazione è spostato sulla rotta e quindi nel file web.php
    public function index() {
        return view('staff');
    }

}
