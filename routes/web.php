<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
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
Route::post('/coupon', [UserController::class, 'showCouponGenerato'])
        ->name('generazione coupon');

Route::get('/profilo', [UserController::class, 'showProfilo'])
        ->name('profilo');

Route::post('/profilo', [UserController::class, 'updateData'])
    ->name('profilo');

Route::get('/pannello/staff', [StaffController::class, 'showPannelloStaff'])
    ->name('pannello staff')
    ->middleware(['auth', 'can:isStaff']);

Route::get('/creazione/offerta', [StaffController::class, 'showCreazioneOfferta'])
    ->name('creazione offerta')
    ->middleware(['auth', 'can:isStaff']);

Route::post('/creazione/offerta', [StaffController::class, 'storeNewOfferta'])
    ->name('creazione offerta')
    ->middleware(['auth', 'can:isStaff']);

Route::get('/modifica/offerta', [StaffController::class, 'showModificaOfferta'])
    ->name('modifica offerta')
    ->middleware(['auth', 'can:isStaff']);

Route::post('/modifica/offerta', [StaffController::class, 'storeNewOffertaModificata'])
    ->name('modifica offerta')
    ->middleware(['auth', 'can:isStaff']);

Route::get('/eliminazione/offerta', [StaffController::class, 'showEliminaOfferta'])
    ->name('eliminazione offerta')
    ->middleware(['auth', 'can:isStaff']);

Route::post('/eliminazione/offerta', [StaffController::class, 'disattivaOfferta'])
    ->name('eliminazione offerta')
    ->middleware(['auth', 'can:isStaff']);

Route::get('/pannello_admin', [AdminController::class, 'showPannelloAdmin'])
    ->name('pannello_admin')
    ->middleware(['auth', 'can:isAdmin']);

Route::get('/aggiunta/staff', [AdminController::class, 'showAggiuntaStaff'])
    ->name('aggiunta staff')
    ->middleware(['auth', 'can:isAdmin']);

Route::post('/aggiunta/staff', [AdminController::class, 'storeNewStaff'])
    ->name('aggiunta staff')
    ->middleware(['auth', 'can:isAdmin']);

Route::get('/modifica/staff', [AdminController::class, 'showModificaStaff'])
    ->name('modifica staff')
    ->middleware(['auth', 'can:isAdmin']);

Route::post('/modifica/staff', [AdminController::class, 'storeModifiedStaff'])
    ->name('modifica staff')
    ->middleware(['auth', 'can:isAdmin']);



// aggiunge le rotte che si trovano all'interno di auth.php
require __DIR__.'/auth.php';




