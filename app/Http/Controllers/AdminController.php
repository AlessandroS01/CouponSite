<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CatalogoAziende;
use App\Models\GestioneAdmin;
use App\Models\Resources\Azienda;
use App\Models\Resources\Faq;
use App\Models\Resources\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
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

    /**
     * Metodo che valida e crea una nuova faq
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeNewFAQ(Request $request){

        $request->validate([
            'domanda'=>['required', 'string', 'min:1'],
            'risposta' =>['required', 'string', 'min:1']
        ]);


        $this->gestioneAdmin->createFAQ($request);

        // serve per far visualizzare al client che la richiesta è stata correttemente validata dal server.
        // In questo modo con ajax si può entrare all'interno del blocco success per fare il redirect
        // alla rotta desiderata.
        // Senza il contenuto della risposta nella richiesta, il metodo $.ajax() genererebbe comunque un errore
        // nonostante lo stato della richiesta risulti 200.
        return response()->json(['message' => 'FAQ creata con successo'], 200);
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
            'nome' => ['required', 'string', 'max:50', 'unique:azienda'],
            'localita' => ['required', 'string', 'max:50'],
            'tipologia' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:azienda'],
            'telefono' => ['required', 'numeric', 'digits:10'],
            'descrizione' => ['required', 'string', 'max:255'],
            // in logo utilizziamo una function di callback che permette di esplicitare regole di validazione personalizzate
            'logo' => ['required', 'image', function ($attribute, $value, $fail) use ($request){
                //dentro fileName recuperiamo il nome originale del file, il valore di $attribute in questo caso è logo (ovvero il name del campo input file)
                $fileName = $request->file($attribute)->getClientOriginalName();
                // if che serve a controllare se il nome del file contiene caratteri speciali
                    if (preg_match('/[!@#$%^&*(),?":{}|<>]/', $fileName)) {
                        //Se il nome del file contiene uno di questi caratteri speciali, la validazione fallirà e verrà restituito un errore utilizzando la funzione $fail
                        $fail("Non può contenere caratteri speciali.");
                    }
                },
            ], // Regola di validazione per l'immagine
            'ragione_sociale' => ['required', 'string', 'max:20'],
        ]);

        $image = $request->file('logo');

        //imposto il percorso di destinazione dell'immagine, public/img
        $destinationPath = public_path('img');
        //crea il percorso relativo (rispetto alla cartella pubblica) in cui verrà salvata l'immagine
        $imagePathRelativo = 'img/'.$image->getClientOriginalName();

        $indiceImmagine = 1;

        //se esiste gia un percorso con lo stesso path relativo andiamo a gestire il path
        while(File::exists($imagePathRelativo)) {

            //modifichiamo il path relativo andando ad aggiungere prima del nome dell'immagine ($indiceImmagine)
            $imagePathRelativo = 'img/'.'('.$indiceImmagine.')'.$image->getClientOriginalName();
            $indiceImmagine ++;

        }
        // spostamento file dell'immagine dalla sua posizione temporanea alla cartella di destinazione specificata ($destinationPath) (vengono combinati i due path)
        $image->move($destinationPath, $imagePathRelativo);
        //passato come parametro imagePathRelativo da salvare nel db
        $this->gestioneAdmin->createAzienda($request, $imagePathRelativo);

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
            // in logo utilizziamo una function di callback che permette di esplicitare regole di validazione personalizzate
            'logo' => ['image', function ($attribute, $value, $fail) use ($request){
                //dentro fileName recuperiamo il nome originale del file, il valore di $attribute in questo caso è logo (ovvero il name del campo input file)
                $fileName = $request->file($attribute)->getClientOriginalName();
                // if che serve a controllare se il nome del file contiene caratteri speciali
                if (preg_match('/[!@#$%^&*(),?":{}|<>]/', $fileName)) {
                    //Se il nome del file contiene uno di questi caratteri speciali, la validazione fallirà e verrà restituito un errore utilizzando la funzione $fail
                    $fail("Non può contenere caratteri speciali.");
                }
            },
            ], // Regola di validazione per l'immagine
            'ragione_sociale' => ['required', 'string', 'max:20'],
        ]);
        //recupero il path relativo dell'immagine attuale dell'azienda
        $imageName = $this->catalogoAziende->getLogoAzienda($request->partita_iva);

        //caso in cui è stato modificato il logo
        if ($request->hasFile('logo')) {
            //recupero l'istanza dell'oggetto "UploadedFile"
            $image = $request->file('logo');
            //modifico il path relativo con il nome della nuova immagine
            $imageName = 'img/'.$image->getClientOriginalName();

            $indiceImmagine = 1;

            //se esiste gia un percorso con lo stesso path relativo andiamo a gestire il path
            while(File::exists($imageName)) {

                //modifichiamo il path relativo andando ad aggiungere prima del nome dell'immagine ($indiceImmagine)
                $imageName = 'img/'.'('.$indiceImmagine.')'.$image->getClientOriginalName();
                $indiceImmagine ++;

            }
            //recupero il path dell'immagine attuale dell'azienda
            $logoAziendaPreesistente = $this->catalogoAziende->getLogoAzienda($request->partita_iva);
            // eliminiamo il file dalla cartella img
            unlink($logoAziendaPreesistente);



            $destinationPath = public_path('img');
            //spostamento file dell'immagine dalla sua posizione temporanea alla cartella di destinazione specificata ($destinationPath)
            $image->move($destinationPath, $imageName);

        }

        $this->gestioneAdmin->modificaAzienda($request, $imageName);


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
        if($request->idfaq){
            $faqDaEliminare = Faq::find($request->idfaq);
            $faqDaEliminare->delete();
        }

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
        if ($request->staffId){
            $staffDaEliminare = User::find($request->staffId);
            $staffDaEliminare->delete();
        }
        return redirect('/');
    }

    public function showEliminazioneUtente() {
        //ritorna un array contenente gli username degli utenti di livello 1
        $usernameUtentiRegistrati = $this->gestioneAdmin->getUsernameUtentiRegistrati();

        $utente = $this->gestioneAdmin->getUtentiRegistrati();


        return view('admin.gestione_generale.eliminazione_utente')
            ->with('utente', $utente)
            ->with('usernameUtentiRegistrati', $usernameUtentiRegistrati);
    }

    public function deleteUtente(Request $request) {
        if($request->utenteId){
            $utenteDaEliminare = User::find($request->utenteId);
            $utenteDaEliminare->delete();
        }
        return redirect('/');
    }

    public function deleteAzienda(Request $request) {
        if($request->partita_iva){
            $aziendaDaEliminare = Azienda::find($request->partita_iva);
            $percorsoLogo = public_path($aziendaDaEliminare->logo);
            //unlink elimina il logo dell'azienda dalla cartella img
            unlink($percorsoLogo);
            $aziendaDaEliminare->delete();
        }

        return redirect('/');
    }

    public function showEliminazioneAzienda() {

        $aziende = $this->catalogoAziende->getAllNoPaginate();

        $partitaIvaAziende = $this->catalogoAziende->getAllPartiteIvaAziende();

        return view('admin.gestione_aziende.eliminazione_azienda')
            ->with('aziende', $aziende)
            ->with('partitaIvaAziende', $partitaIvaAziende);
    }

    public function visualizzaStatistiche() {

        $numeroCouponEmessi = $this->gestioneAdmin->getNumeroCouponEmessi();

        $listaCoupon = $this->gestioneAdmin->getAllCouponEmessi();


        $listaCouponPaginated = $this->paginate($listaCoupon, 5, null, ['path' => URL::full(), 'pageName' => 'page']);

        return view('admin.gestione_generale.visualizza_statistiche')
                ->with('couponTotali', $numeroCouponEmessi)
                ->with('listaCoupon', $listaCoupon)
                ->with('listaCouponPaginated', $listaCouponPaginated);
    }

    public function paginate($items, $perPage = 3, $page = null, $options = [])
    {
        // il valore della pagina, se non viene passato come input al richiamo del metodo, viene richiamato un metodo della
        // Facade Paginator per risolvere il problema della pagina corrente. Se non si riesce a stabilire il valore viene settato ad 1
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        // $items viene convertito in una collezione se al passaggio della funzione $items non è di per sè una collezione
        $items = $items instanceof Collection ? $items : Collection::make($items);

        // crea un nuovo oggetto di LengthAwarePaginator passandogli la collezione $items divisa per pagine, dove ad ogni pagina
        // si trovano 3 elementi della collezione, poi il totale degli elementi della collezione, il numero di elementi per
        // ogni pagina, il valore della pagina corrente e tutte le opzioni aggiuntive passate al richiamo del metodo.
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

}
