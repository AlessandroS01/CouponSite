<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* Rotte del prof
Route::get('/', [PublicController::class, 'showCatalog1'])
        ->name('catalog1');

Route::get('/selTopCat/{topCatId}', [PublicController::class, 'showCatalog2'])
        ->name('catalog2');

Route::get('/selTopCat/{topCatId}/selCat/{catId}', [PublicController::class, 'showCatalog3'])
        ->name('catalog3');

Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin');

Route::get('/admin/newproduct', [AdminController::class, 'addProduct'])
        ->name('newproduct');

Route::post('/admin/newproduct', [AdminController::class, 'storeProduct'])
        ->name('newproduct.store');


// la rotta ha in coda il meccanismo di autorizzazione per gli user
Route::get('/user', [UserController::class, 'index'])
        ->name('user')->middleware('can:isUser');


Route::view('/where', 'where')
        ->name('where');

Route::view('/who', 'who')
        ->name('who');
*/

/**
 * rotta che riporta alla home del sito
 */
Route::get('/', [PublicController::class, 'showHome'])
        ->name('home');

/**
 * rotta che riporta alla pagina in cui è contenuto il catalogo delle offerte
 */
Route::get('/catalogo/offerte', [PublicController::class, 'showCatalogoOfferte'])
        ->name('catalogo offerte');

/**
 * rotta che permette di visualizzare le offerte cha "matchano" con i campi di ricerca inseriti nel catalogo
 */
Route::get('/catalogo/offerte/ricerca', [PublicController::class, 'searchOfferteRicerca'])
    ->name('catalogo offerte ricerca');

/**
 * rotta che riporta alla pagina in cui è contenuto il catalogo delle aziende
 */
Route::get('/catalogo/aziende', [PublicController::class, 'showCatalogoAziende'])
        ->name('catalogo aziende');

/**
 * rotta che permette di visualizzare le aziende cha "matchano" con i campi di ricerca inseriti nel catalogo
 */
Route::get('/catalogo/aziende/ricerca', [PublicController::class, 'searchAziendeRicerca'])
    ->name('catalogo aziende ricerca');

/**
 * rotta che riporta alla pagina dei contatti del sito
 */
Route::get('/contatti', [PublicController::class, 'showContatti'])
        ->name('contatti');

/**
 * rotta che riporta alla pagina della FAQ del sito
 */
Route::get('/faq', [PublicController::class, 'showFaq'])
        ->name('faqs');

/**
 * Rotta per visualizzare un'offerta dopo il click su ottieni.
 * {offertaId} rappresenta il parametro che viene passato direttamente dalla vista quando viene
 * richiamata la rotta.
 */
Route::get('/offerta/{offertaId}', [PublicController::class, 'showOfferta'])
        ->name('offerta');

/**
 * Rotta per visualizzare un'azienda specifica con tutte le sue offerte.
 * {partita_iva} rappresenta il parametro che viene passato direttamente dalla vista quando viene
 * richiamata la rotta.
 */
Route::get('/azienda/{partita_iva}', [PublicController::class, 'showAzienda'])
        ->name('azienda');

// rotta per accedere alla sezione del cliente
Route::get('/client', [PublicController::class, 'showClientHome'])
        ->name('homeClient');


/*  Rotte aggiunte da Breeze

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

*/

// aggiunge le rotte che si trovano all'interno di auth.php
require __DIR__.'/auth.php';




