<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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


Route::delete('/reservation_delete', [DashboardController::class, 'destroy'])
->middleware(['auth'])
->name('destroy.reservation');
    