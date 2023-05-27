<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CatalogoAziende;
use App\Models\GestioneAdmin;
use App\Models\Resources\Product;
use Illuminate\Validation\Rules;
use App\Http\Requests\NewProductRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller {

    protected $gestioneAdmin;
    protected $catalogoAziende;

    public function __construct()
    {
        $this->gestioneAdmin = New GestioneAdmin();

        $this->catalogoAziende = New CatalogoAziende();
    }

    public function showPannelloAdmin() {
        return view('admin.pannello_admin');
    }

    public function showAggiuntaStaff() {

        $aziende = $this->catalogoAziende->getAllNoPaginate();

        return view('admin.gestione_staff.aggiunta_staff')
                ->with('aziende', $aziende);
    }

    public function showAggiuntaAzienda() {

        return view('admin.gestione_aziende.creazione_azienda');

    }

    public function showAggiuntaFAQ() {

        return view('admin.gestione_faq.creazione_faq');
    }


    public function storeNewStaff(Request $request) {

        // Prima verifica tutte le varie regole di validazione
        $request->validate([
            'username' => ['required', 'string', 'min:8', 'max:50', 'unique:users'],
            'password' => ['required', 'max:50', 'confirmed', Rules\Password::defaults()],
            'nome' => ['required', 'string', 'max:50'],
            'cognome' => ['required', 'string', 'max:50'],
            'genere' => ['required', 'string', 'max:1'],
            'eta' => ['required', 'int', 'min:1', 'max:99'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'telefono' => ['required', 'numeric', 'digits_between:10,20'],
            'via' => ['required', 'string', 'max:100'],
            'numero_civico' => ['required', 'int'],
            'citta' => ['required', 'string', 'max:50'],
        ]);


        $this->gestioneAdmin->createStaff($request);



        return redirect('/');
    }

    public function storeNewCompany(Request $request) {


        // Prima verifica tutte le varie regole di validazione
        $request->validate([
            'partita_iva' => ['required', 'string', 'min:8', 'max:50', 'unique:partita_iva'],
            'nome' => ['required', 'string', 'max:50'],
            'località' => ['required', 'string', 'max:50'],
            'tipologia' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'telefono' => ['required', 'numeric', 'digits_between:10,20'],
            'descrizione' => ['required', 'string', 'max:255'],
//            'logo' => ['', ''],
            'ragione_sociale' => ['required', 'string', 'max:50'],
        ]);

        $this->gestioneAdmin->createAzienda($request);



        return redirect('/');
    }



    public function showModificaStaff() {
        $usernameUtentiStaff = $this->gestioneAdmin->getUsernameUtentiStaff();

        $staff = $this->gestioneAdmin->getUtentiStaff();

        $aziende = $this->catalogoAziende->getAllNoPaginate();

        return view('admin.gestione_staff.modifica_staff')
                ->with('staff', $staff)
                ->with('usernameUtentiStaff', $usernameUtentiStaff)
                ->with('aziende', $aziende);
    }

}
