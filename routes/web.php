<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\RevisorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontController::class, 'welcome'])->name('welcome');

Route::get('/categoria/{category}', [FrontController::class, 'categoryShow'])->name('categoryShow');

Route::get('/dettaglio/annuncio/{announcement}', [AnnouncementController::class, 'showAnnouncement'])
->name('announcements.show');

Route::get('/tutti/annunci', [FrontController::class, 'indexAnnouncement'])
->name('announcements.index');

Route::get('/rendi/revisore/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');

Route::post('/lingua/{lang}', [FrontController::class, 'setLanguage'])->name('setLanguage');

Route::middleware(['auth'])->group(function(){

    ///SEZIONE UTENTE LOGGATO
    Route::get('/nuovo/annuncio', [AnnouncementController::class, 'createAnnouncement'])
    ->name('announcements.create');

    Route::get('/richiesta/revisore', [RevisorController::class, 'becomeRevisor'])->name('become.revisor');

    Route::middleware(['isRevisor'])->group(function(){

        ///SEZIONE UTENTE REVISORE
        Route::get('/revisor/home', [RevisorController::class, 'index'])->name('revisor.index');

        Route::patch('/accetta/annuncio/{announcement}', [RevisorController::class, 'acceptAnnouncement'])
        ->name('revisor.accept_announcement');

        Route::patch('/rifiuta/annuncio/{announcement}', [RevisorController::class, 'rejectAnnouncement'])
        ->name('revisor.reject_announcement');

        Route::get('/annulla/revisione/{announcement}', [RevisorController::class, 'undoReview'])
        ->name('revisor.undo_review');
    });
});