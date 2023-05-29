<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CatalogoAziende;
use App\Models\GestioneAdmin;
use App\Models\Resources\Azienda;
use App\Models\Resources\Faq;
use App\Models\Resources\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
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

    public function showModificaAzienda() {

        $aziende = $this->catalogoAziende->getAllNoPaginate();

        $partitaIvaAziende = $this->catalogoAziende->getAllPartiteIvaAziende();

        return view('admin.gestione_aziende.modifica_azienda')
                ->with('aziende', $aziende)
                ->with('partitaIvaAziende', $partitaIvaAziende);

    }

    public function showAggiuntaFAQ() {

        return view('admin.gestione_faq.creazione_faq');
    }

    public function storeNewFAQ(Request $request){

        $request->validate([
            'domanda'=>['required', 'string', 'min:1'],
            'risposta' =>['required', 'string', 'min:1']
        ]);

        $this->gestioneAdmin->createFAQ($request);

        return redirect('/');

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

    public function storeNewCompany(Request $request)
    {
        // Prima verifica tutte le varie regole di validazione
        $request->validate([
            'partita_iva' => ['required', 'string', 'min:11', 'max:11', 'unique:azienda'],
            'nome' => ['required', 'string', 'max:50'],
            'localita' => ['required', 'string', 'max:50'],
            'tipologia' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:azienda'],
            'telefono' => ['required', 'numeric', 'digits:10'],
            'descrizione' => ['required', 'string', 'max:255'],
            'logo' => ['required', 'image'], // Regola di validazione per l'immagine
            'ragione_sociale' => ['required', 'string', 'max:50'],
        ]);

        $imageName = null;

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path('img');
            $image->move($destinationPath, $imageName);
        }

        $this->gestioneAdmin->createAzienda($request, $imageName);

        return redirect('/');
    }

    public function storeAziendaModificata(Request $request)
    {

        $azienda = Azienda::find($request->partita_iva);

        // Prima verifica tutte le varie regole di validazione
        $request->validate([
            'nome' => ['required', 'string', 'max:50'],
            'localita' => ['required', 'string', 'max:50'],
            'tipologia' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', Rule::unique('azienda')->ignore($azienda)],
            'telefono' => ['required', 'numeric', 'digits:10'],
            'descrizione' => ['required', 'string', 'max:255'],
            'logo' => ['image'], // Regola di validazione per l'immagine
            'ragione_sociale' => ['required', 'string', 'max:50'],
        ]);

        $imageName = $this->catalogoAziende->getLogoAzienda($request->partita_iva);
        $cambioPathImmagine = false;

        if ($request->hasFile('logo')) {
            $cambioPathImmagine = true;

            $imagePath = public_path($imageName);
            if (File::exists($imagePath)) {
                // Delete the image file
                File::delete($imagePath);
            }

            $image = $request->file('logo');
            $imageName = $image->getClientOriginalName();
            $imageNamePublic = 'img/'.$imageName;
            $destinationPath = public_path('img');
            $image->move($destinationPath, $imageName);
        }

        if($cambioPathImmagine){
            $this->gestioneAdmin->modificaAzienda($request, $imageNamePublic);
        }
        else{
            $this->gestioneAdmin->modificaAzienda($request, $imageName);
        }

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

    public function showModificaFaq(){
        $faq = $this->gestioneAdmin->getFaq();
        $faqdomanda = $this->gestioneAdmin->getFaqDomanda();


        return view('admin.gestione_faq.modifica_faq')
            ->with('faq',$faq)
            ->with('faqdomanda',$faqdomanda);
    }

    public function showEliminazioneFaq(){

        $faq = $this->gestioneAdmin->getFaq();
        $faqdomanda = $this->gestioneAdmin->getFaqDomanda();

        return view('admin.gestione_faq.elimina_faq')
            ->with('faq',$faq)
            ->with('faqdomanda',$faqdomanda);
    }


    public function deleteFaq(Request $request) {
        $faqDaEliminare = Faq::find($request->idfaq);
        Log::info('iuhpèij');
        $faqDaEliminare->delete();
        Log::info('iuhpèij');
        return redirect('/');
    }

    public function storeModificaFaq(Request $request){

        $this->gestioneAdmin->storeFaqModificato($request);

        return redirect('/');
    }

    public function storeModificaStaff(Request $request) {


        // Prima verifica tutte le varie regole di validazione
        $request->validate([
            'nome' => ['required', 'string', 'max:50'],
            'cognome' => ['required', 'string', 'max:50'],
            'genere' => ['required', 'string', 'max:1'],
            'eta' => ['required', 'int', 'min:1', 'max:99'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email,'.$request->staffId],
            'telefono' => ['required', 'numeric', 'digits_between:10,20'],
            'via' => ['required', 'string', 'max:100'],
            'numero_civico' => ['required', 'int'],
            'citta' => ['required', 'string', 'max:50'],
        ]);


        $this->gestioneAdmin->storeStaffModificato($request);

        return redirect('/');
    }

    public function showEliminazioneStaff() {

        $usernameUtentiStaff = $this->gestioneAdmin->getUsernameUtentiStaff();

        $staff = $this->gestioneAdmin->getUtentiStaff();


        return view('admin.gestione_staff.eliminazione_staff')
            ->with('staff', $staff)
            ->with('usernameUtentiStaff', $usernameUtentiStaff);
    }

    public function deleteStaff(Request $request) {
        $staffDaEliminare = User::find($request->staffId);
        $staffDaEliminare->delete();
        return redirect('/');
    }

    public function showEliminazioneUtente() {
        $usernameUtentiRegistrati = $this->gestioneAdmin->getUsernameUtentiRegistrati();

        $utente = $this->gestioneAdmin->getUtentiRegistrati();


        return view('admin.gestione_generale.eliminazione_utente')
            ->with('utente', $utente)
            ->with('usernameUtentiRegistrati', $usernameUtentiRegistrati);
    }

    public function deleteUtente(Request $request) {
        $utenteDaEliminare = User::find($request->utenteId);
        $utenteDaEliminare->delete();
        return redirect('/');
    }

    public function visualizzaStatistiche() {


        return view('admin.gestione_generale.visualizza_statistiche');
    }

}
