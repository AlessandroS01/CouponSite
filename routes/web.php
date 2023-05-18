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

Route::get('/user', [UserController::class, 'index'])
        ->name('user')->middleware('can:isUser');


Route::view('/where', 'where')
        ->name('where');

Route::view('/who', 'who')
        ->name('who');










// rotta che riporta alla home
Route::get('/', [PublicController::class, 'showHome'])
        ->name('home');
       
// rotta che riporta alla pagina in cui sono contenute tutte le offerte
Route::get('/catalogo', [PublicController::class, 'showCatalogoOfferte'])
        ->name('catalogo offerte');
 
// rotta che riporta alla pagina in cui sono contenute tutte le aziende
Route::get('/aziende', [PublicController::class, 'showCatalogoAziende'])
        ->name('catalogo aziende');
 
// rotta che riporta alla pagina dei contatti        
Route::get('/contatti', [PublicController::class, 'showContatti'])
        ->name('contatti');
        
// rotta che riporta alla pagina della FAQ
Route::get('/faq', [PublicController::class, 'showFaq'])
        ->name('faqs');

// rotta che riporta alla pagina del login        
Route::get('/login', [PublicController::class, 'showLogin'])
        ->name('login');
        

// rotta che riporta alla pagina di registrazione
Route::get('/signup', [PublicController::class, 'showSignup'])
        ->name('signup');
        
// rotta per visualizzare un'offerta dopo il click su ottieni
Route::get('/offerta', [PublicController::class, 'showOfferta'])
        ->name('offerta');
        
// rotta per visualizzare un'azienda dopo il click su una di esse
Route::get('/azienda', [PublicController::class, 'showAzienda'])
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
require __DIR__.'/auth.php';
