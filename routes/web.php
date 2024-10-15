<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

Route::view('/', 'index');
Route::view('/onas', 'pages.onas');
Route::view('/kontakt', 'pages.kontakt');
Route::view('/nascvicak', 'pages.nascvicak');


Route::get('/login', [AuthController::class, 'show'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'register']);


Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/register', [AuthController::class, 'store']);


Route::get('/rezervace', [AuthController::class, 'rezervace']);

Route::get('/dashboard', [DashboardController::class, 'show'])
    ->middleware(['auth'])
    ->name('dashboard');



Route::post('/dashboard', [DashboardController::class, 'store'])
    ->middleware(['auth'])
    ->name('store.reservation');


Route::post('/reservation_delete', [DashboardController::class, 'destroy'])
->middleware(['auth'])
->name('destroy.reservation');

Route::post('/reservation_update', [DashboardController::class, 'update'])
->middleware(['auth'])
->name('update.reservation');

Route::get('rezervace', [AdminController::class, 'index'])->name('home');

// Různé akce dostupné pouze pro přihlášené uživatele
Route::middleware(['auth'])->group(function () {
    Route::post('/reservations', [AdminController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations/{date}', [AdminController::class, 'destroy'])->name('reservations.destroy');
});

Route::get('/reservations', [AdminController::class, 'index'])->name('reservations.index');
Route::get('/reservations/month/{month}', [AdminController::class, 'getReservationsByMonth']);

Route::get('/lessons', [AdminController::class, 'index'])->name('lessons.index');
Route::get('/lessons/create', [AdminController::class, 'create'])->name('lessons.create');
Route::post('/lessons', [AdminController::class, 'store'])->name('lessons.store');



