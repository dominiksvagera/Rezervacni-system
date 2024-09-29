<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::view('/', 'index');


Route::get('/login', [AuthController::class, 'show']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'store']);

Route::get('/onas', [AuthController::class, 'onas']);
Route::get('/kontakt', [AuthController::class, 'kontakt']);
Route::get('/nascvicak', [AuthController::class, 'nascvicak']);
Route::get('/rezervace', [AuthController::class, 'rezervace']);
