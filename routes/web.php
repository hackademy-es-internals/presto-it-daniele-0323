<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\FrontController;

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

Route::get('/nuovo/annuncio', [AnnouncementController::class, 'createAnnouncement'])
->middleware('auth')->name('announcements.create');

Route::get('/dettaglio/annuncio/{announcement}', [AnnouncementController::class, 'showAnnouncement'])
->name('announcements.show');

Route::get('/tutti/annunci', [FrontController::class, 'indexAnnouncement'])
->name('announcements.index');