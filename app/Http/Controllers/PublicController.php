<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Faq;


class PublicController extends Controller
{
    // crea una varibile che contiene le faq
    protected $_faqs;

    public function __construct() {
        // inizializza il valore della variabile contenente le faq 
        $this->_faqs = new Faq;
    }

    public function showHome() {
        return view('home');  //passare alla view i prodotti da visualizzare nella home contenuti in Models/prodotti.php
    }
    
    public function showCatalogoOfferte() {
        return view('catalogo_offerte');
    }
    
    public function showCatalogoAziende() {
        return view('catalogo_aziende');
    }
    
    public function showContatti() {
        return view('contatti');
    }
    
    public function showFaq() {
        // passa alla vista l'insieme di tutte le faq 
        return view('faqs', ['faqs' => $this->_faqs->getFaqs()]);
    }

    public function showLogin() {
        return view('login');
    }

    public function showSignup() {
        return view('signup');
    }
    
    public function showClientHome() {
        return view('homeClient');
    }
    

    public function showOfferta() {
        return view('offerta');
    }
    
    public function showAzienda() {
        return view('azienda');
    }

}
