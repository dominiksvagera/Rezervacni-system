<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
// zobrazení view stránek
Route::view('/', 'index');
Route::view('/onas', 'pages.onas');
Route::view('/kontakt', 'pages.kontakt');
Route::view('/nascvicak', 'pages.nascvicak');

//zobrazení přihlášení a registrace
Route::get('/login', [AuthController::class, 'show'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'register']);
Route::get('/rezervace', [AuthController::class, 'rezervace']);

// cesty pro odeslání dat při přihlášení a registraci
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/register', [AuthController::class, 'store']);

// dashboard i s middleware kontrlou, zda je uživatel přihlášený
Route::get('/dashboard', [DashboardController::class, 'show'])
    ->middleware(['auth'])
    ->name('dashboard');

// odeslání rezervace na vypsanou lekci v dahsboardu přihlášeného uživatele
Route::post('/dashboard', [DashboardController::class, 'store'])
    ->middleware(['auth'])
    ->name('store.reservation');

// to stejné ale na smazání rezervace
Route::post('/reservation_delete', [DashboardController::class, 'destroy'])
->middleware(['auth'])
->name('destroy.reservation');
// update rezervace
Route::post('/reservation_update', [DashboardController::class, 'update'])
->middleware(['auth'])
->name('update.reservation');

//propojení rezervace (view) s admincontrollerem
Route::get('rezervace', [AdminController::class, 'index'])->name('home');

//  akce dostupné pouze pro přihlášené uživatele
Route::middleware(['auth'])->group(function () {
    Route::post('/reservations', [AdminController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{title}', [AdminController::class, 'destroy'])->name('reservations.destroy');
});

Route::get('/reservations', [AdminController::class, 'index'])->name('reservations.index');
Route::get('/reservations/month/{month}', [AdminController::class, 'getReservationsByMonth']);
// akce pro lekce 
Route::get('/lessons', [AdminController::class, 'index'])->name('lessons.index');
Route::get('/lessons/create', [AdminController::class, 'create'])->name('lessons.create');
Route::post('/lessons', [AdminController::class, 'store'])->name('lessons.store');



